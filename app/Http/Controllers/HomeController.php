<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\MediaEvent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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

        return view('welcome', compact('recentPosts', 'importantEvent'));
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
        $events = MediaEvent::published()
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

    public function search(Request $request, $locale)
    {
        $query = trim($request->get('q', ''));

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];
        $q = '%' . $query . '%';

        $posts = Post::where('status', 'published')
            ->where(function ($builder) use ($q) {
                $builder->where('title', 'like', $q)
                    ->orWhere('excerpt', 'like', $q)
                    ->orWhere('content', 'like', $q);
            })
            ->select('id', 'title', 'slug', 'excerpt', 'featured_image')
            ->limit(5)
            ->get();

        foreach ($posts as $post) {
            $results[] = [
                'type' => 'post',
                'label' => __('home.search.type_post'),
                'title' => $post->title,
                'excerpt' => \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?? $post->content), 80),
                'url' => route('posts.show', ['locale' => $locale, 'post' => $post->id]),
                'image' => $post->featured_image ? asset('storage/' . $post->featured_image) : null,
                'icon' => 'post',
            ];
        }

        $events = MediaEvent::where('status', 'published')
            ->where(function ($builder) use ($q) {
                $builder->where('title', 'like', $q)
                    ->orWhere('description', 'like', $q);
            })
            ->select('id', 'title', 'description', 'event_date')
            ->limit(3)
            ->get();

        foreach ($events as $event) {
            $results[] = [
                'type' => 'event',
                'label' => __('home.search.type_event'),
                'title' => $event->title,
                'excerpt' => \Illuminate\Support\Str::limit($event->description ?? '', 80),
                'url' => route('media', ['locale' => $locale]) . '#event-' . $event->id,
                'image' => null,
                'icon' => 'event',
            ];
        }

        $staticPages = [
            ['key' => 'about', 'route' => 'about'],
            ['key' => 'vision-and-values', 'route' => 'vision-and-values'],
            ['key' => 'our-impact', 'route' => 'our-impact'],
            ['key' => 'our-team', 'route' => 'our-team'],
            ['key' => 'governance', 'route' => 'governance'],
            ['key' => 'board-of-directors', 'route' => 'board-of-directors'],
            ['key' => 'open-data', 'route' => 'openData'],
            ['key' => 'how-to', 'route' => 'howTo'],
            ['key' => 'why-open', 'route' => 'whyOpen'],
            ['key' => 'gallery', 'route' => 'gallery'],
            ['key' => 'media', 'route' => 'media'],
            ['key' => 'applications', 'route' => 'applications'],
            ['key' => 'research-projects', 'route' => 'researchProjects'],
        ];

        foreach ($staticPages as $page) {
            $title = __('home.nav.' . str_replace('-', '_', $page['key']));
            if (stripos($title, $query) !== false) {
                $results[] = [
                    'type' => 'page',
                    'label' => __('home.search.type_page'),
                    'title' => $title,
                    'excerpt' => '',
                    'url' => route($page['route'], ['locale' => $locale]),
                    'image' => null,
                    'icon' => 'page',
                ];
            }
        }

        return response()->json($results);
    }
}