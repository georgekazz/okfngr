<?php

namespace App\Http\Controllers;

use App\Models\DayOff;
use App\Models\TeamLink;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    public function dashboard($locale)
    {
        $user = auth()->user();

        // Get user's day offs
        $myDayOffs = DayOff::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Get all day offs for calendar
        $allDayOffs = DayOff::with('user')
            ->whereYear('start_date', Carbon::now()->year)
            ->get();

        // Statistics
        $stats = [
            'my_total_days' => DayOff::where('user_id', $user->id)
                ->whereYear('start_date', Carbon::now()->year)
                ->sum('total_days'),
            'my_upcoming' => DayOff::where('user_id', $user->id)
                ->where('start_date', '>=', Carbon::today())
                ->count(),
            'team_total_days' => DayOff::whereYear('start_date', Carbon::now()->year)
                ->sum('total_days'),
            'team_members' => User::where('role', 'user')->count(),
        ];

        return view('user.dashboard', compact('myDayOffs', 'allDayOffs', 'stats'));
    }

    public function dayOffs($locale)
    {
        $dayOffs = DayOff::where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('user.day-offs.index', compact('dayOffs'));
    }

    public function createDayOff($locale)
    {
        $dayOff = new DayOff(); // or your model name
        return view('user.day-offs.create', compact('dayOff'));
    }

    public function storeDayOff(Request $request, $locale)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|in:vacation,sick,personal,other',
            'reason' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ]);

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        DayOff::create([
            'user_id' => auth()->id(),
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_days' => $totalDays,
            'type' => $validated['type'],
            'reason' => $validated['reason'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('user.day-offs.index', ['locale' => $locale])
            ->with('success', 'Η άδεια καταχωρήθηκε επιτυχώς!');
    }

    public function editDayOff($locale, $id)
    {
        $dayOff = DayOff::findOrFail($id);

        // Only allow editing own day offs
        if ($dayOff->user_id !== auth()->id()) {
            return back()->with('error', 'Δεν μπορείτε να επεξεργαστείτε αυτή την άδεια.');
        }

        return view('user.day-offs.edit', compact('dayOff'));
    }

    public function updateDayOff(Request $request, $locale, $id)
    {
        $dayOff = DayOff::findOrFail($id);

        // Only allow editing own day offs
        if ($dayOff->user_id !== auth()->id()) {
            return back()->with('error', 'Δεν μπορείτε να επεξεργαστείτε αυτή την άδεια.');
        }

        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|in:vacation,sick,personal,other',
            'reason' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ]);

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        $dayOff->update([
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_days' => $totalDays,
            'type' => $validated['type'],
            'reason' => $validated['reason'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('user.day-offs.index', ['locale' => $locale])
            ->with('success', 'Η άδεια ενημερώθηκε επιτυχώς!');
    }

    public function destroyDayOff($locale, $id)
    {
        $dayOff = DayOff::findOrFail($id);

        // Only allow deleting own day offs
        if ($dayOff->user_id !== auth()->id()) {
            return back()->with('error', 'Δεν μπορείτε να διαγράψετε αυτή την άδεια.');
        }

        $dayOff->delete();

        return back()->with('success', 'Η άδεια διαγράφηκε επιτυχώς!');
    }

    public function salaryCalculator($locale)
    {
        return view('user.salary-calculator');
    }

    public function calendar($locale)
    {
        $dayOffs = DayOff::with('user')
            ->whereYear('start_date', Carbon::now()->year)
            ->get();

        return view('user.calendar', compact('dayOffs'));
    }

    public function teamLinks($locale)
    {
        $links = TeamLink::where('is_active', true)
            ->orderBy('order')
            ->orderBy('category')
            ->get()
            ->groupBy('category');

        return view('user.team-links', compact('links'));
    }

    public function statistics($locale)
    {
        // Get all users with their total days for current year
        $users = User::where('role', 'user')
            ->withSum(['dayOffs as total_days' => function ($query) {
                $query->whereYear('start_date', Carbon::now()->year);
            }], 'total_days')
            ->get()
            ->map(function ($user) {
                $user->total_days = $user->total_days ?? 0;
                return $user;
            });

        // Monthly statistics
        $monthlyStats = DayOff::whereYear('start_date', Carbon::now()->year)
            ->selectRaw('MONTH(start_date) as month, SUM(total_days) as total')
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        // Type statistics
        $typeStats = DayOff::whereYear('start_date', Carbon::now()->year)
            ->selectRaw('type, SUM(total_days) as total')
            ->groupBy('type')
            ->get()
            ->keyBy('type');

        // Prepare type data for chart
        $typeData = [
            'vacation' => $typeStats->get('vacation')->total ?? 0,
            'sick' => $typeStats->get('sick')->total ?? 0,
            'personal' => $typeStats->get('personal')->total ?? 0,
            'other' => $typeStats->get('other')->total ?? 0,
        ];

        return view('user.statistics', compact('users', 'monthlyStats', 'typeData'));
    }
}
