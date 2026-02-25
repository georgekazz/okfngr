<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\MediaEvent;
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

        $importantEvent = MediaEvent::where('is_important', 1)
            ->where('status', 'published')
            ->latest('event_date')
            ->first();

        return view('welcome', compact('recentPosts','importantEvent'));
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

    public function researchProjects($locale)
    {
        return view('research-projects');
    }

    public function applications($locale)
    {
        return view('applications');
    }

    public function oldProjects($locale)
    {
        return view('old-projects');
    }

    public function ourActions($locale)
    {
        return view('our-actions');
    }

    public function media($locale)
    {
        $events = \App\Models\MediaEvent::published()
            ->orderByEventDate('desc')
            ->get();

        return view('media', compact('events'));
    }

    public function editions($locale)
    {
        return view('editions');
    }

    public function openData($locale)
    {
        return view('open-data');
    }

    public function howTo($locale)
    {
        return view('how-to');
    }

    public function whyOpen($locale)
    {
        return view('why-open');
    }
}
