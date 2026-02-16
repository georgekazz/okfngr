<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard($locale)
    {
        $stats = [
            'total_users' => User::count(),
            'total_writers' => User::where('role', 'writer')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_posts' => Post::count(),
            'published_posts' => Post::where('status', 'published')->count(),
            'draft_posts' => Post::where('status', 'draft')->count(),
            'total_comments' => Comment::count(),
            'pending_comments' => Comment::where('status', 'pending')->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentPosts = Post::with('user')->latest()->take(5)->get();
        $recentComments = Comment::with(['post', 'post.user'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentPosts', 'recentComments'));
    }

    // Users Management
    public function users($locale)
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function createUser($locale)
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request, $locale)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,writer,user',
            'bio' => 'nullable|string',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'bio' => $validated['bio'],
            'is_active' => true,
        ]);

        return redirect()->route('admin.users.index', ['locale' => $locale])
            ->with('success', 'Ο χρήστης δημιουργήθηκε επιτυχώς!');
    }

    public function editUser($locale, User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $locale, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,writer,user',
            'bio' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index', ['locale' => $locale])
            ->with('success', 'Ο χρήστης ενημερώθηκε επιτυχώς!');
    }

    public function resetPassword($locale, User $user)
    {
        return view('admin.users.reset-password', compact('user'));
    }

    public function updatePassword(Request $request, $locale, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index', ['locale' => $locale])
            ->with('success', 'Ο κωδικός ενημερώθηκε επιτυχώς!');
    }

    public function destroyUser($locale, User $user)
    {
        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Δεν μπορείτε να διαγράψετε τον εαυτό σας!');
        }

        // Force delete (permanent removal from database)
        $user->forceDelete();

        return redirect()->route('admin.users.index', ['locale' => $locale])
            ->with('success', 'Ο χρήστης διαγράφηκε επιτυχώς!');
    }

    // Posts Management
    public function posts($locale)
    {
        $posts = Post::with(['user', 'categories'])->latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function editPost($locale, Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function destroyPost($locale, Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('admin.posts', ['locale' => $locale])
            ->with('success', 'Το άρθρο διαγράφηκε επιτυχώς!');
    }

    // Comments Management
    public function comments(Request $request, $locale)
    {
        $query = Comment::with(['post'])->latest();

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $comments = $query->paginate(20);

        return view('admin.comments.index', compact('comments'));
    }

    public function approveComment($locale, Comment $comment)
    {
        $comment->update(['status' => 'approved']);

        return back()->with('success', 'Το σχόλιο εγκρίθηκε!');
    }

    public function rejectComment($locale, Comment $comment)
    {
        $comment->update(['status' => 'rejected']);

        return back()->with('success', 'Το σχόλιο απορρίφθηκε!');
    }

    public function destroyComment($locale, Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Το σχόλιο διαγράφηκε!');
    }
}
