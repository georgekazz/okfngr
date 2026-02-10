<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with recent posts.
     */
    public function index()
    {
        // Fetch the 6 most recent published posts
        $recentPosts = Post::published()
            ->with(['user', 'categories', 'tags'])
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('welcome', compact('recentPosts'));
    }

    public function about($locale)
    {
        return view('about');
    }

    public function whoWeAre($locale)
    {
        return view('who-we-are');
    }
}
