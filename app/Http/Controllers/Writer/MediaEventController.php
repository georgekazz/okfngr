<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\MediaEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaEventController extends Controller
{
    public function index()
    {
        $events = MediaEvent::where('user_id', Auth::id())
            ->orderByEventDate()
            ->paginate(10);

        return view('writer.media-events.index', compact('events'));
    }

    public function create()
    {
        return view('writer.media-events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'links.*' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $validated['user_id'] = Auth::id();

        // Handle links
        if ($request->has('links')) {
            $links = array_filter($request->links, function($link) {
                return !empty($link);
            });
            $validated['links'] = array_values($links);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('media-events', 'public');
            $validated['image'] = $path;
        }

        MediaEvent::create($validated);

        return redirect()
            ->route('writer.media-events.index', ['locale' => app()->getLocale()])
            ->with('success', 'Η εκδήλωση δημιουργήθηκε επιτυχώς!');
    }

    public function edit($locale, MediaEvent $mediaEvent)
    {
        // Check if user owns this event
        if ($mediaEvent->user_id !== Auth::id()) {
            abort(403);
        }

        return view('writer.media-events.edit', compact('mediaEvent'));
    }

    public function update(Request $request, MediaEvent $mediaEvent)
    {
        // Check if user owns this event
        if ($mediaEvent->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'links.*' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        // Handle links
        if ($request->has('links')) {
            $links = array_filter($request->links, function($link) {
                return !empty($link);
            });
            $validated['links'] = array_values($links);
        } else {
            $validated['links'] = [];
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($mediaEvent->image) {
                Storage::disk('public')->delete($mediaEvent->image);
            }
            $path = $request->file('image')->store('media-events', 'public');
            $validated['image'] = $path;
        }

        $mediaEvent->update($validated);

        return redirect()
            ->route('writer.media-events.index', ['locale' => app()->getLocale()])
            ->with('success', 'Η εκδήλωση ενημερώθηκε επιτυχώς!');
    }

    public function destroy(MediaEvent $mediaEvent)
    {
        // Check if user owns this event
        if ($mediaEvent->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete image if exists
        if ($mediaEvent->image) {
            Storage::disk('public')->delete($mediaEvent->image);
        }

        $mediaEvent->delete();

        return redirect()
            ->route('writer.media-events.index', ['locale' => app()->getLocale()])
            ->with('success', 'Η εκδήλωση διαγράφηκε επιτυχώς!');
    }
}