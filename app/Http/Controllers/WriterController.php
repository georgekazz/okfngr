<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WriterController extends Controller
{

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/el/writer/dashboard');
        }
        return view('writer.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Το email είναι υποχρεωτικό.',
            'email.email' => 'Παρακαλώ εισάγετε έγκυρο email.',
            'password.required' => 'Ο κωδικός είναι υποχρεωτικός.',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->role !== 'writer' && Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Δεν έχετε δικαίωμα πρόσβασης.',
                ]);
            }

            return redirect('/el/writer/dashboard');
        }

        return back()->withErrors([
            'email' => 'Λάθος στοιχεία σύνδεσης.',
        ])->withInput($request->only('email'));
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/el');
    }


    public function dashboard()
    {
        $user = Auth::user();

        $postsQuery = Post::where('user_id', $user->id);

        $publishedCount = (clone $postsQuery)->where('status', 'published')->count();
        $draftCount = (clone $postsQuery)->where('status', 'draft')->count();
        $totalPosts = $postsQuery->count();

        $posts = Post::where('user_id', $user->id)
            ->with(['categories', 'tags'])
            ->latest()
            ->paginate(10);

        return view('writer.dashboard', compact(
            'publishedCount',
            'draftCount',
            'totalPosts',
            'posts'
        ));
    }

    public function index()
    {
        $posts = Post::where('user_id', Auth::id())
            ->with(['categories', 'tags'])
            ->latest()
            ->paginate(15);

        return view('writer.posts.index', compact('posts'));
    }


    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('writer.posts.editor', compact('categories', 'tags'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|max:5120',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ], [
            'title.required' => 'Ο τίτλος είναι υποχρεωτικός.',
            'content.required' => 'Το περιεχόμενο είναι υποχρεωτικό.',
            'featured_image.image' => 'Το αρχείο πρέπει να είναι εικόνα.',
            'featured_image.max' => 'Η εικόνα δεν πρέπει να υπερβαίνει τα 5MB.',
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $count = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('posts', 'public');
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'status' => $validated['status'],
            'featured_image' => $imagePath,
            'published_at' => $validated['status'] === 'published' ? now() : null,
        ]);

        if (!empty($validated['categories'])) {
            $post->categories()->attach($validated['categories']);
        }

        if (!empty($validated['tags'])) {
            $post->tags()->attach($validated['tags']);
        }

        return redirect('/el/writer/dashboard')
            ->with('success', 'Το άρθρο δημιουργήθηκε επιτυχώς!');
    }


    public function edit($locale, Post $post)  // Added $locale as first parameter
    {
        if ($post->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('writer.posts.editor', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, $locale, Post $post)
    {
        if ($post->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|max:5120',
            'remove_image' => 'nullable|boolean',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($post->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $originalSlug = $slug;
            $count = 1;

            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $post->slug = $slug;
        }

        if ($request->filled('remove_image') && $post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
            $post->featured_image = null;
        }

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $post->featured_image = $request->file('featured_image')->store('posts', 'public');
        }

        $post->title = $validated['title'];
        $post->excerpt = $validated['excerpt'];
        $post->content = $validated['content'];
        $post->status = $validated['status'];

        if ($validated['status'] === 'published' && !$post->published_at) {
            $post->published_at = now();
        }

        $post->save();

        $post->categories()->sync($validated['categories'] ?? []);
        $post->tags()->sync($validated['tags'] ?? []);

        return redirect('/el/writer/dashboard')
            ->with('success', 'Το άρθρο ενημερώθηκε επιτυχώς!');
    }

    public function destroy($locale, Post $post)  // Added $locale parameter
    {
        if ($post->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect("/$locale/writer/dashboard")
            ->with('success', 'Το άρθρο διαγράφηκε επιτυχώς!');
    }
}
