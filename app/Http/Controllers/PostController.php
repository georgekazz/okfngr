<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of published posts.
     */
    public function index(Request $request)
    {
        $query = Post::published()
            ->with(['user', 'categories', 'tags']);

        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by tag
        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        $posts = $query->latest('published_at')->paginate(6);
        
        // Get all categories for filter
        $categories = Category::has('posts')->withCount('posts')->get();

        return view('posts.index', compact('posts', 'categories'));
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        // Check if post is published
        if (!$post->isPublished()) {
            abort(404);
        }

        // Increment view count
        $post->incrementViews();

        // Load relationships
        $post->load([
            'user',
            'categories',
            'tags',
            'approvedComments' => function ($query) {
                $query->whereNull('parent_id')->with('approvedReplies');
            }
        ]);

        // Get related posts
        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->whereHas('categories', function ($query) use ($post) {
                $query->whereIn('categories.id', $post->categories->pluck('id'));
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    /**
     * Store a comment on a post.
     */
    public function storeComment(Request $request, Post $post)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'author_website' => 'nullable|url|max:255',
            'content' => 'required|string|max:5000',
            'parent_id' => 'nullable|exists:comments,id',
        ], [
            'author_name.required' => 'Το όνομά σας είναι υποχρεωτικό.',
            'author_email.required' => 'Το email σας είναι υποχρεωτικό.',
            'author_email.email' => 'Παρακαλώ εισάγετε ένα έγκυρο email.',
            'content.required' => 'Το σχόλιο δεν μπορεί να είναι κενό.',
            'content.max' => 'Το σχόλιο δεν μπορεί να υπερβαίνει τους 5000 χαρακτήρες.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the comment
        $comment = Comment::create([
            'post_id' => $post->id,
            'parent_id' => $request->parent_id,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'author_website' => $request->author_website,
            'content' => $request->content,
            'status' => 'pending', // Default to pending for moderation
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Το σχόλιό σας υποβλήθηκε επιτυχώς και αναμένει έγκριση.');
    }
}