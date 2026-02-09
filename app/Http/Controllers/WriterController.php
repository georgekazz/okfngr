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
    /**
     * Show writer login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('writer.dashboard');
        }
        return view('writer.login');
    }

    /**
     * Handle writer login
     */
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

            // Check if user is writer or admin
            if (Auth::user()->role !== 'writer' && Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Δεν έχετε δικαίωμα πρόσβασης.',
                ]);
            }

            return redirect()->intended(route('writer.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Λάθος στοιχεία σύνδεσης.',
        ])->withInput($request->only('email'));
    }

    /**
     * Handle writer logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }

    /**
     * Show writer dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get user's posts
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

    /**
     * Show all posts
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())
            ->with(['categories', 'tags'])
            ->latest()
            ->paginate(15);

        return view('writer.posts.index', compact('posts'));
    }

    /**
     * Show create post form
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('writer.posts.editor', compact('categories', 'tags'));
    }

    /**
     * Store new post
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|max:5120', // 5MB max
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

        // Generate slug
        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $count = 1;
        
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('posts', 'public');
        }

        // Create post
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

        // Attach categories and tags
        if (!empty($validated['categories'])) {
            $post->categories()->attach($validated['categories']);
        }
        
        if (!empty($validated['tags'])) {
            $post->tags()->attach($validated['tags']);
        }

        return redirect()->route('writer.dashboard')
            ->with('success', 'Το άρθρο δημιουργήθηκε επιτυχώς!');
    }

    /**
     * Show edit post form
     */
    public function edit(Post $post)
    {
        // Check ownership
        if ($post->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $categories = Category::all();
        $tags = Tag::all();
        
        return view('writer.posts.editor', compact('post', 'categories', 'tags'));
    }

    /**
     * Update post
     */
    public function update(Request $request, Post $post)
    {
        // Check ownership
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

        // Update slug if title changed
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

        // Handle image removal
        if ($request->filled('remove_image') && $post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
            $post->featured_image = null;
        }

        // Handle new image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $post->featured_image = $request->file('featured_image')->store('posts', 'public');
        }

        // Update post
        $post->title = $validated['title'];
        $post->excerpt = $validated['excerpt'];
        $post->content = $validated['content'];
        $post->status = $validated['status'];
        
        // Set published_at if publishing for first time
        if ($validated['status'] === 'published' && !$post->published_at) {
            $post->published_at = now();
        }
        
        $post->save();

        // Sync categories and tags
        $post->categories()->sync($validated['categories'] ?? []);
        $post->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('writer.dashboard')
            ->with('success', 'Το άρθρο ενημερώθηκε επιτυχώς!');
    }

    /**
     * Delete post
     */
    public function destroy(Post $post)
    {
        // Check ownership
        if ($post->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Delete featured image
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('writer.dashboard')
            ->with('success', 'Το άρθρο διαγράφηκε επιτυχώς!');
    }
}