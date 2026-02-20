<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $query = Post::published()
            ->with(['user', 'categories', 'tags']);

        if ($request->has('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        $posts = $query->latest('published_at')->paginate(6);

        $categories = Category::has('posts')->withCount('posts')->get();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show($locale, $id)
    {
        $post = Post::where('id', $id)
            ->where('status', 'published')
            ->with(['user', 'categories', 'tags'])
            ->firstOrFail();

        $post->increment('views_count');

        $post->load([
            'comments' => function ($query) {
                $query->where('status', 'approved')
                    ->whereNull('parent_id')
                    ->with([
                        'replies' => function ($q) {
                            $q->where('status', 'approved');
                        }
                    ]);
            }
        ]);

        // Get related posts based on shared categories
        $categoryIds = $post->categories->pluck('id');

        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    public function storeComment($locale, Request $request, Post $post)
    {

        // Check if post is published
        if (!$post->isPublished()) {
            abort(404);
        }

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

        $comment = Comment::create([
            'post_id' => $post->id,
            'parent_id' => $request->parent_id,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'author_website' => $request->author_website,
            'content' => $request->content,
            'status' => 'pending',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);


        return redirect()
            ->back()
            ->with('success', 'Το σχόλιό σας υποβλήθηκε επιτυχώς και αναμένει έγκριση.');
    }
}
