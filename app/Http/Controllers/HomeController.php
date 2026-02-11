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
        return view('vision-and-values');
    }

    public function ourImpact($locale)
    {
        return view('our-impact');
    }

    public function ourTeam($locale)
    {
        return view('our-team');
    }
    
    public function inMemory($locale)
    {
        return view('in-memory');
    }

    public function boardOfDirectors($locale)
    {
        return view('board-of-directors');
    }

    public function governance($locale)
    {
        return view('governance');
    }
}
