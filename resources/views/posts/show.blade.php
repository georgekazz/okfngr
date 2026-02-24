<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} - Open Knowledge Greece</title>
    <meta name="description" content="{{ Str::limit($post->excerpt, 160) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cyan-brand': '#00d1ff',
                        'mint': '#adffed',
                        'purple-brand': '#7b2fff',
                        'text-primary': '#1a1a2e',
                        'text-secondary': '#6b7280',
                        'lighter': '#f9fafb',
                        'light': '#f3f4f6',
                        'border-color': '#e5e7eb',
                    },
                    fontFamily: {
                        'roboto': ['Roboto', 'sans-serif'],
                    },
                    backgroundImage: {
                        'gradient-cyber': 'linear-gradient(135deg, #00d1ff, #adffed)',
                    },
                }
            }
        }
    </script>
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        /* Gradient cyber button */
        .btn-cyber {
            background: linear-gradient(135deg, #00d1ff, #adffed);
        }

        /* Post content prose styles */
        .post-content p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
            text-align: justify;
            text-justify: inter-word;
        }

        .post-content h1,
        .post-content h2,
        .post-content h3,
        .post-content h4,
        .post-content h5,
        .post-content h6 {
            font-weight: 700;
            color: #1a1a2e;
            line-height: 1.3;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
            word-wrap: break-word;
            overflow-wrap: break-word;
            text-align: left;
        }

        .post-content h1 {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
        }

        .post-content h2 {
            font-size: clamp(1.5rem, 3.5vw, 2rem);
        }

        .post-content h3 {
            font-size: clamp(1.25rem, 3vw, 1.5rem);
        }

        .post-content h4 {
            font-size: clamp(1.125rem, 2.5vw, 1.25rem);
        }

        .post-content h5,
        .post-content h6 {
            font-size: clamp(1rem, 2vw, 1.125rem);
        }

        .post-content strong,
        .post-content b {
            font-weight: 700;
            color: #1a1a2e;
        }

        .post-content em,
        .post-content i {
            font-style: italic;
        }

        .post-content ul {
            list-style-type: disc;
            margin: 1.5rem 0;
            padding-left: 2rem;
            text-align: left;
        }

        .post-content ol {
            list-style-type: decimal;
            margin: 1.5rem 0;
            padding-left: 2rem;
            text-align: left;
        }

        .post-content li {
            margin-bottom: 0.75rem;
            line-height: 1.7;
            text-align: justify;
        }

        .post-content li>ul,
        .post-content li>ol {
            margin-top: 0.75rem;
        }

        .post-content a {
            color: #00d1ff;
            text-decoration: underline;
            word-wrap: break-word;
            overflow-wrap: break-word;
            transition: color 0.3s;
        }

        .post-content a:hover {
            color: #7b2fff;
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 2rem auto;
            display: block;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .post-content figure {
            margin: 2rem 0;
            text-align: center;
        }

        .post-content figure img {
            margin: 0 auto;
        }

        .post-content figcaption {
            margin-top: 0.75rem;
            font-size: 0.9em;
            color: #6b7280;
            font-style: italic;
            text-align: center;
        }

        .post-content blockquote {
            border-left: 4px solid #00d1ff;
            padding-left: 2rem;
            margin: 2rem 0;
            font-style: italic;
            color: #6b7280;
            font-size: clamp(1rem, 1.8vw, 1.1rem);
            text-align: left;
        }

        .post-content pre {
            background: #f3f4f6;
            padding: 1.5rem;
            border-radius: 8px;
            overflow-x: auto;
            margin: 1.5rem 0;
            text-align: left;
        }

        .post-content code {
            background: #f3f4f6;
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-size: 0.9em;
            font-family: "Courier New", monospace;
        }

        .post-content pre code {
            background: none;
            padding: 0;
        }

        .post-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            overflow-x: auto;
            display: block;
        }

        .post-content table th,
        .post-content table td {
            border: 1px solid #e5e7eb;
            padding: 0.75rem;
            text-align: left;
        }

        .post-content table th {
            background: #f3f4f6;
            font-weight: 700;
        }

        .post-content::after {
            content: "";
            display: table;
            clear: both;
        }

        .post-content .alignleft {
            float: left;
            margin: 0.5rem 1.5rem 1rem 0;
            max-width: 50%;
        }

        .post-content .alignright {
            float: right;
            margin: 0.5rem 0 1rem 1.5rem;
            max-width: 50%;
        }

        .post-content .aligncenter {
            display: block;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        .post-content .size-full {
            width: 100%;
            height: auto;
        }

        .post-content .size-large {
            max-width: 100%;
            height: auto;
        }

        .post-content .size-medium {
            max-width: 75%;
            height: auto;
        }

        .post-content .size-thumbnail {
            max-width: 150px;
            height: auto;
        }

        @media (max-width: 640px) {

            .post-content p,
            .post-content li {
                text-align: left;
            }

            .post-content .alignleft,
            .post-content .alignright {
                float: none;
                max-width: 100%;
                margin: 1rem 0;
            }
        }

        /* Nav dropdown */
        .nav-item:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu {
            display: none;
        }

        /* Mobile nav */
        @media (max-width: 768px) {
            .desktop-nav {
                display: none;
            }

            .desktop-nav.open {
                display: flex;
            }
        }
    </style>
</head>

<body class="bg-lighter text-text-primary">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo -->
                <a href="../" class="flex-shrink-0">
                    <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="Open Knowledge Greece"
                        class="h-8 lg:h-10 w-auto">
                </a>

                <!-- Mobile toggle -->
                <button class="md:hidden text-2xl text-gray-600 hover:text-cyan-brand transition-colors"
                    id="mobileMenuToggle">☰</button>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center gap-1 desktop-nav" id="desktopNav">
                    <!-- About -->
                    <div class="nav-item relative group">
                        <a href="#"
                            class="flex items-center gap-1 px-3 py-2 text-sm font-500 text-text-secondary hover:text-cyan-brand transition-colors">
                            {{ __('home.nav.about') }} <span class="text-xs opacity-60">▼</span>
                        </a>
                        <div
                            class="dropdown-menu absolute top-full left-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <a href="{{ route('about', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.our_mission') }}</a>
                            <a href="{{ route('vision-and-values', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.who_we_are') }}</a>
                            <a href="{{ route('our-impact', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.our_impact') }}</a>
                        </div>
                    </div>

                    <!-- Who We Are -->
                    <div class="nav-item relative group">
                        <a href="#"
                            class="flex items-center gap-1 px-3 py-2 text-sm font-500 text-text-secondary hover:text-cyan-brand transition-colors">
                            {{ __('home.nav.who_we_are2') }} <span class="text-xs opacity-60">▼</span>
                        </a>
                        <div
                            class="dropdown-menu absolute top-full left-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <a href="{{ route('our-team', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.team') }}</a>
                            <a href="{{ route('board-of-directors', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.board') }}</a>
                            <a href="{{ route('governance', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.governance') }}</a>
                        </div>
                    </div>

                    <!-- What We Do -->
                    <div class="nav-item relative group">
                        <a href="#"
                            class="flex items-center gap-1 px-3 py-2 text-sm font-500 text-text-secondary hover:text-cyan-brand transition-colors">
                            {{ __('home.nav.what_we_do') }} <span class="text-xs opacity-60">▼</span>
                        </a>
                        <div
                            class="dropdown-menu absolute top-full left-0 mt-1 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <a href="{{ route('researchProjects', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.projects') }}</a>
                            <a href="{{ route('applications', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.apps') }}</a>
                            <a href="{{ route('oldProjects', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.old_apps') }}</a>
                            <a href="{{ route('media', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.media') }}</a>
                            <a href="{{ route('editions', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.editions') }}</a>
                        </div>
                    </div>

                    <!-- Open Data -->
                    <div class="nav-item relative group">
                        <a href="#"
                            class="flex items-center gap-1 px-3 py-2 text-sm font-500 text-text-secondary hover:text-cyan-brand transition-colors">
                            {{ __('home.nav.open_data') }} <span class="text-xs opacity-60">▼</span>
                        </a>
                        <div
                            class="dropdown-menu absolute top-full left-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <a href="{{ route('openData', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.open_data') }}</a>
                            <a href="{{ route('howTo', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.how_to') }}</a>
                            <a href="{{ route('whyOpen', ['locale' => app()->getLocale()]) }}"
                                class="block px-4 py-2 text-sm text-text-secondary hover:text-cyan-brand hover:bg-gray-50 transition-colors">{{ __('home.nav.why_open') }}</a>
                        </div>
                    </div>
                </nav>

                <!-- Right actions -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('posts.index', ['locale' => app()->getLocale()]) }}"
                        class="px-4 py-2 rounded-full text-sm font-700 text-white btn-cyber hover:-translate-y-0.5 transition-transform shadow-sm">
                        {{ __('home.nav.blog') }}
                    </a>

                    <div class="flex items-center gap-2 ml-2">
                        @php
                            $currentRoute = Route::currentRouteName();
                            $params = Route::current()->parameters();
                            unset($params['locale']);
                        @endphp
                        <a href="{{ route($currentRoute, array_merge(['locale' => 'en'], $params)) }}"
                            class="flex items-center gap-1 px-2 py-1 rounded-lg text-xs font-600 transition-colors {{ app()->getLocale() == 'en' ? 'text-cyan-brand bg-cyan-50' : 'text-text-secondary hover:text-cyan-brand' }}">
                            <img src="{{ asset('img/uk-flag.png') }}" alt="English"
                                class="w-4 h-4 rounded-sm object-cover">
                            EN
                        </a>
                        <a href="{{ route($currentRoute, array_merge(['locale' => 'el'], $params)) }}"
                            class="flex items-center gap-1 px-2 py-1 rounded-lg text-xs font-600 transition-colors {{ app()->getLocale() == 'el' ? 'text-cyan-brand bg-cyan-50' : 'text-text-secondary hover:text-cyan-brand' }}">
                            <img src="{{ asset('img/gr-flag.png') }}" alt="Ελληνικά"
                                class="w-4 h-4 rounded-sm object-cover">
                            EL
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Article -->
    <article class="bg-lighter">
        <div class="max-w-[900px] mx-auto px-4 sm:px-8 lg:px-12 py-10 lg:py-16">

            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('posts.index', ['locale' => app()->getLocale()]) }}"
                    class="inline-flex items-center gap-2 text-text-secondary font-600 text-sm hover:text-cyan-brand transition-all hover:gap-3 group">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" class="flex-shrink-0">
                        <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    {{ __('post.back_to_blog') }}
                </a>
            </div>

            <!-- Post Header: Categories → Title → Meta -->
            <header class="mb-10">

                {{-- Categories --}}
                @if($post->categories->count() > 0)
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($post->categories as $category)
                            <a href="{{ route('posts.index', ['locale' => app()->getLocale(), 'category' => $category->slug]) }}"
                                class="px-4 py-1.5 bg-white text-cyan-brand border-2 border-cyan-brand/30 rounded-lg text-xs font-600 uppercase tracking-wide no-underline transition-all hover:-translate-y-0.5 hover:bg-cyan-brand hover:text-white hover:border-cyan-brand shadow-sm whitespace-nowrap">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- Title --}}
                <h1 class="text-4xl lg:text-5xl font-black leading-tight text-text-primary mb-6 tracking-tight break-words text-left"
                    style="font-size: clamp(1.75rem, 5vw, 3rem);">
                    {{ $post->title }}
                </h1>

                {{-- Meta: Date · Author · Views --}}
                <div class="flex flex-wrap items-center gap-4 sm:gap-6">
                    <div class="flex items-center gap-2 text-text-secondary text-sm">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="none"
                            class="text-cyan-brand flex-shrink-0">
                            <path
                                d="M15.8333 3.33334H4.16667C3.24619 3.33334 2.5 4.07954 2.5 5.00001V16.6667C2.5 17.5871 3.24619 18.3333 4.16667 18.3333H15.8333C16.7538 18.3333 17.5 17.5871 17.5 16.6667V5.00001C17.5 4.07954 16.7538 3.33334 15.8333 3.33334Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M13.3333 1.66666V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M6.66666 1.66666V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M2.5 8.33334H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span>{{ ($post->published_at ?? $post->created_at)->locale(app()->getLocale())->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-text-secondary text-sm">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="none"
                            class="text-cyan-brand flex-shrink-0">
                            <path
                                d="M16.6667 17.5V15.8333C16.6667 14.9493 16.3155 14.1014 15.6904 13.4763C15.0652 12.8512 14.2174 12.5 13.3333 12.5H6.66667C5.78261 12.5 4.93476 12.8512 4.30964 13.4763C3.68452 14.1014 3.33333 14.9493 3.33333 15.8333V17.5"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M10 9.16667C11.8409 9.16667 13.3333 7.67428 13.3333 5.83333C13.3333 3.99238 11.8409 2.5 10 2.5C8.15905 2.5 6.66667 3.99238 6.66667 5.83333C6.66667 7.67428 8.15905 9.16667 10 9.16667Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span>{{ $post->user->name }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-text-secondary text-sm">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="none"
                            class="text-cyan-brand flex-shrink-0">
                            <path
                                d="M10 18.3333C14.6024 18.3333 18.3333 14.6024 18.3333 10C18.3333 5.39763 14.6024 1.66667 10 1.66667C5.39763 1.66667 1.66667 5.39763 1.66667 10C1.66667 14.6024 5.39763 18.3333 10 18.3333Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M10 5V10L13.3333 11.6667" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>{{ $post->views_count }} {{ __('post.views') }}</span>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            @if($post->featured_image)
                @php
                    $filename = basename($post->featured_image);
                @endphp
                @if(!str_contains($post->content, $filename))
                    <div class="mb-10 rounded-2xl overflow-hidden shadow-xl w-full">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" 
                            alt="{{ $post->title }}"
                            class="w-full h-auto block object-cover max-h-[500px]"
                            onerror="this.parentElement.style.display='none'">
                    </div>
                @endif
            @endif

            <!-- Post Content -->
            <div
                class="post-content text-base lg:text-[1.05rem] leading-relaxed text-text-primary mb-10 word-break overflow-hidden">
                {!! $post->content !!}
            </div>

            <!-- Tags -->
            @if($post->tags->count() > 0)
                <div class="mb-10 rounded-2xl border-2 p-6 lg:p-8"
                    style="background: linear-gradient(135deg, rgba(0,209,255,0.05), rgba(173,255,237,0.05)); border-color: rgba(0,209,255,0.15);">
                    <div class="flex items-center gap-3 mb-5 pb-4 border-b" style="border-color: rgba(0,209,255,0.2);">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" class="text-cyan-brand flex-shrink-0">
                            <path d="M17.5 10.4167L10.4167 17.5L2.5 9.58333V2.5H9.58333L17.5 10.4167Z" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.25 6.25H6.25833" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span
                            class="text-sm font-700 text-text-primary uppercase tracking-widest">{{ __('post.tags') }}</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->tags as $tag)
                            <a href="{{ route('posts.index', ['locale' => app()->getLocale(), 'tag' => $tag->slug]) }}"
                                class="inline-flex items-center px-5 py-2 bg-white border-2 border-cyan-brand/30 rounded-full text-cyan-brand text-sm font-600 no-underline transition-all hover:bg-cyan-brand hover:text-white hover:border-cyan-brand hover:-translate-y-0.5 shadow-sm whitespace-nowrap">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Share Buttons -->
            <div class="mb-10 lg:mb-16">
                <h3 class="text-lg font-700 mb-4 text-text-primary">{{ __('post.share_article') }}</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                        target="_blank"
                        class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full text-white font-600 text-sm no-underline transition-all hover:-translate-y-0.5 hover:shadow-lg whitespace-nowrap sm:w-auto w-full justify-center"
                        style="background:#1877f2;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                        Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                        target="_blank"
                        class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full text-white font-600 text-sm no-underline transition-all hover:-translate-y-0.5 hover:shadow-lg whitespace-nowrap sm:w-auto w-full justify-center"
                        style="background:#1da1f2;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0">
                            <path
                                d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                        </svg>
                        Twitter
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}"
                        target="_blank"
                        class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full text-white font-600 text-sm no-underline transition-all hover:-translate-y-0.5 hover:shadow-lg whitespace-nowrap sm:w-auto w-full justify-center"
                        style="background:#0a66c2;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0">
                            <path
                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                        </svg>
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <section class="py-10 lg:py-16 bg-lighter border-t border-gray-100">
            <div class="max-w-[900px] mx-auto px-4 sm:px-8 lg:px-12">
                <h2 class="text-2xl lg:text-3xl font-700 mb-8 text-text-primary">
                    {{ __('post.comments') }} ({{ $post->comments()->where('status', 'approved')->count() }})
                </h2>

                <!-- Comment Form -->
                <div class="bg-light rounded-2xl p-6 lg:p-10 mb-10 shadow-sm">
                    <h3 class="text-xl font-700 mb-6 text-text-primary">{{ __('post.leave_comment') }}</h3>

                    @if(session('success'))
                        <div class="p-4 rounded-xl mb-6 text-sm font-500 border"
                            style="background: rgba(173,255,237,0.2); border-color: #adffed; color: #0a6640;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form
                        action="{{ route('posts.comments.store', ['locale' => app()->getLocale(), 'post' => $post->id]) }}"
                        method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6 mb-4">
                            <div>
                                <label for="author_name" class="block text-sm font-600 text-text-primary mb-2">
                                    {{ __('post.your_name') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="author_name" name="author_name" value="{{ old('author_name') }}"
                                    required
                                    class="w-full px-4 py-2.5 border-2 rounded-lg text-sm font-400 transition-colors focus:outline-none focus:border-cyan-brand {{ $errors->has('author_name') ? 'border-red-400' : 'border-border-color' }}">
                                @error('author_name')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="author_email" class="block text-sm font-600 text-text-primary mb-2">
                                    {{ __('post.your_email') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="author_email" name="author_email"
                                    value="{{ old('author_email') }}" required
                                    class="w-full px-4 py-2.5 border-2 rounded-lg text-sm font-400 transition-colors focus:outline-none focus:border-cyan-brand {{ $errors->has('author_email') ? 'border-red-400' : 'border-border-color' }}">
                                @error('author_email')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-600 text-text-primary mb-2">
                                {{ __('post.your_comment') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea id="content" name="content" rows="5" required
                                class="w-full px-4 py-2.5 border-2 rounded-lg text-sm font-400 transition-colors focus:outline-none focus:border-cyan-brand resize-none {{ $errors->has('content') ? 'border-red-400' : 'border-border-color' }}">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit"
                            class="px-10 py-3 btn-cyber text-white rounded-full text-sm font-700 border-0 cursor-pointer transition-all hover:-translate-y-0.5 hover:shadow-lg">
                            {{ __('post.submit_comment') }}
                        </button>
                    </form>
                </div>

                <!-- Comments List -->
                @if($post->comments()->where('status', 'approved')->where('parent_id', null)->count() > 0)
                    <div class="space-y-4">
                        @foreach($post->comments()->where('status', 'approved')->where('parent_id', null)->get() as $comment)
                            @include('partials.comment', ['comment' => $comment])
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-text-secondary py-8 text-sm">{{ __('post.no_comments') }}</p>
                @endif
            </div>
        </section>
    </article>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center gap-6">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="h-10 w-auto">

                <div class="flex items-center gap-5">
                    <a href="https://facebook.com/okfngreece" class="opacity-70 hover:opacity-100 transition-opacity"
                        target="_blank" rel="noopener">
                        <img src="{{ asset('img/social/facebook.png') }}" alt="Facebook" class="w-6 h-6 object-contain">
                    </a>
                    <a href="https://twitter.com/okfngr" class="opacity-70 hover:opacity-100 transition-opacity"
                        target="_blank" rel="noopener">
                        <img src="{{ asset('img/social/twitter.png') }}" alt="Twitter" class="w-6 h-6 object-contain">
                    </a>
                    <a href="https://github.com/okgreece" class="opacity-70 hover:opacity-100 transition-opacity"
                        target="_blank" rel="noopener">
                        <img src="{{ asset('img/social/github.png') }}" alt="GitHub" class="w-6 h-6 object-contain">
                    </a>
                    <a href="https://instagram.com/okgreece" class="opacity-70 hover:opacity-100 transition-opacity"
                        target="_blank" rel="noopener">
                        <img src="{{ asset('img/social/instagram.png') }}" alt="Instagram"
                            class="w-6 h-6 object-contain">
                    </a>
                </div>

                <div class="text-center text-sm text-text-secondary max-w-2xl leading-relaxed">
                    <p>{!! __('home.footer.content', ['okfn_greece' => '<a href="https://okfn.gr/" class="text-cyan-brand hover:underline">' . __('home.footer.okfn_greece') . '</a>', 'okfn_international' => '<a href="https://okfn.org/" class="text-cyan-brand hover:underline">' . __('home.footer.okfn_international') . '</a>', 'license' => '<a href="https://creativecommons.org/licenses/by/4.0/" class="text-cyan-brand hover:underline">' . __('home.footer.license') . '</a>']) !!}
                    </p>
                    <p class="mt-3">{{ __('home.footer.copyright', ['year' => date('Y')]) }}</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const toggle = document.getElementById('mobileMenuToggle');
        const nav = document.getElementById('desktopNav');
        if (toggle && nav) {
            toggle.addEventListener('click', () => {
                nav.classList.toggle('hidden');
                nav.classList.toggle('flex');
                nav.classList.toggle('flex-col');
                nav.classList.toggle('absolute');
                nav.classList.toggle('top-16');
                nav.classList.toggle('left-0');
                nav.classList.toggle('right-0');
                nav.classList.toggle('bg-white');
                nav.classList.toggle('shadow-lg');
                nav.classList.toggle('px-4');
                nav.classList.toggle('py-4');
                nav.classList.toggle('z-50');
            });
        }

        // Language switcher (kept from original)
        function switchLanguage(locale) {
            fetch(`/language/${locale}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(r => r.json()).then(d => {
                if (d.success) window.location.reload();
            }).catch(e => console.error('Error:', e));
        }
    </script>
</body>

</html>