<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\GalleryGroup;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WriterGalleryController extends Controller
{
    // LIST
    public function index($locale)
    {
        $groups = GalleryGroup::with('photos')
            ->orderByDesc('date')
            ->paginate(12);

        return view('writer.gallery.index', compact('groups'));
    }

    // CREATE FORM
    public function create($locale)
    {
        return view('writer.gallery.create');
    }

    // STORE
    public function store(Request $request, $locale)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'photos' => 'required|array|min:1',
            'photos.*' => 'image|max:5120',
        ]);

        $group = GalleryGroup::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        $order = 1;
        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('gallery', 'public');
            GalleryPhoto::create([
                'group_id' => $group->id,
                'path' => $path,
                'order' => $order++,
            ]);
        }

        return redirect()
            ->route('writer.gallery.index', ['locale' => $locale])
            ->with('success', 'Η ομάδα φωτογραφιών δημιουργήθηκε επιτυχώς!');
    }

    // EDIT FORM
    public function edit($locale, $id)
    {
        $group = GalleryGroup::with('photos')->findOrFail($id);
        return view('writer.gallery.edit', compact('group'));
    }

    // UPDATE
    public function update(Request $request, $locale, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'new_photos' => 'nullable|array',
            'new_photos.*' => 'image|max:5120',
        ]);

        $group = GalleryGroup::findOrFail($id);

        $group->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        // Add new photos if uploaded
        if ($request->hasFile('new_photos')) {
            $order = $group->photos()->max('order') + 1;
            foreach ($request->file('new_photos') as $photo) {
                $path = $photo->store('gallery', 'public');
                GalleryPhoto::create([
                    'group_id' => $group->id,
                    'path' => $path,
                    'order' => $order++,
                ]);
            }
        }

        return redirect()
            ->route('writer.gallery.edit', ['locale' => $locale, 'id' => $group->id])
            ->with('success', 'Οι αλλαγές αποθηκεύτηκαν επιτυχώς!');
    }

    // DELETE GROUP
    public function destroy($locale, $id)
    {
        $group = GalleryGroup::with('photos')->findOrFail($id);

        // Delete all photos from storage
        foreach ($group->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
        }

        $group->delete();

        return redirect()
            ->route('writer.gallery.index', ['locale' => $locale])
            ->with('success', 'Η ομάδα διαγράφηκε επιτυχώς!');
    }

    // DELETE SINGLE PHOTO (AJAX)
    public function deletePhoto($locale, $photoId)
    {
        $photo = GalleryPhoto::findOrFail($photoId);
        Storage::disk('public')->delete($photo->path);
        $photo->delete();

        return response()->json(['success' => true]);
    }
}
