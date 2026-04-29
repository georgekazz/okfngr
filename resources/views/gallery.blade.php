<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('gallery.title') }} - Open Knowledge Greece</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <header>
        <div class="header-container">
            <a href="./" class="logo">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="Open Knowledge Greece" class="logo-img">
            </a>
            <button class="mobile-menu-toggle">☰</button>
            <nav>
                <div class="nav-item has-dropdown">
                    <a href="#" class="nav-link">{{ __('home.nav.about') }} <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('about', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.our_mission') }}</a>
                        <a href="{{ route('vision-and-values', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.who_we_are') }}</a>
                    </div>
                </div>
                <div class="nav-item has-dropdown">
                    <a href="#" class="nav-link">{{ __('home.nav.who_we_are2') }} <span
                            class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('our-team', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.team') }}</a>
                        <a href="{{ route('board-of-directors', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.board') }}</a>
                        <a href="{{ route('governance', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.governance') }}</a>
                        <a href="{{ route('our-impact', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.our_impact') }}</a>
                        <a href="{{ route('gallery', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.gallery') }}</a>
                    </div>
                </div>
                <div class="nav-item has-dropdown">
                    <a href="#" class="nav-link">{{ __('home.nav.what_we_do') }} <span
                            class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('researchProjects', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.projects') }}</a>
                        <a href="{{ route('applications', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.apps') }}</a>
                        <a href="{{ route('oldProjects', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.old_apps') }}</a>
                        <a href="{{ route('media', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.media') }}</a>
                        <a href="{{ route('editions', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.editions') }}</a>
                    </div>
                </div>
                <div class="nav-item has-dropdown">
                    <a href="#" class="nav-link">{{ __('home.nav.open_data') }} <span
                            class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('openData', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.open_data') }}</a>
                        <a href="{{ route('howTo', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.how_to') }}</a>
                        <a href="{{ route('whyOpen', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.why_open') }}</a>
                    </div>
                </div>
            </nav>
            <div class="nav-actions">
                <a href="{{ route('posts.index', ['locale' => app()->getLocale()]) }}" class="blog-btn">
                    <span>{{ __('home.nav.blog') }}</span>
                </a>
                <div class="lang-switcher">
                    <a href="{{ route('gallery', ['locale' => 'en']) }}"
                        class="lang-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        <img src="{{ asset('img/uk-flag.png') }}" alt="English" class="flag-icon"> EN
                    </a>
                    <a href="{{ route('gallery', ['locale' => 'el']) }}"
                        class="lang-link {{ app()->getLocale() == 'el' ? 'active' : '' }}">
                        <img src="{{ asset('img/gr-flag.png') }}" alt="Ελληνικά" class="flag-icon"> EL
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="gallery-hero">
        <div class="hero-background">
            <div class="hero-shape shape-1"></div>
            <div class="hero-shape shape-2"></div>
            <div class="hero-shape shape-3"></div>
        </div>
        <div class="hero-content">
            <div class="hero-badge">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" />
                    <circle cx="8.5" cy="8.5" r="1.5" />
                    <polyline points="21 15 16 10 5 21" />
                </svg>
                <span>{{ __('gallery.badge') }}</span>
            </div>
            <h1>{{ __('gallery.hero_title') }}</h1>
            <p class="hero-lead">{{ __('gallery.hero_subtitle') }}</p>
        </div>
    </section>

    <!-- Search & Filters -->
    <div class="gallery-controls" id="galleryControls">
        <div class="controls-container">
            <div class="search-wrap">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" />
                </svg>
                <input type="text" id="gallerySearch" placeholder="{{ __('gallery.search_placeholder') }}"
                    autocomplete="off">
            </div>
            <div class="filter-chips" id="filterChips">
                <button class="chip active" data-year="all">{{ __('gallery.filter_all') }}</button>
                @foreach($years as $year)
                    <button class="chip" data-year="{{ $year }}">{{ $year }}</button>
                @endforeach
            </div>
            <div class="results-count" id="resultsCount">
                <span id="countNum">{{ $groups->count() }}</span> {{ __('gallery.events') }}
            </div>
        </div>
    </div>

    <!-- Timeline -->
    <section class="gallery-section">
        <div class="gallery-container">

            @if($groups->isEmpty())
                <div class="gallery-empty">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                        <rect x="3" y="3" width="18" height="18" rx="2" />
                        <circle cx="8.5" cy="8.5" r="1.5" />
                        <polyline points="21 15 16 10 5 21" />
                    </svg>
                    <h3>{{ __('gallery.no_photos') }}</h3>
                    <p>{{ __('gallery.no_photos_text') }}</p>
                </div>
            @else
                <div class="timeline" id="galleryTimeline">

                    @foreach($groups as $group)
                        @php
                            $photoCount = $group->photos->count();
                            $hasMany    = $photoCount > 3;
                            $preview    = $group->photos->take(3);
                            $rest       = $group->photos->skip(3);
                        @endphp

                        <div class="timeline-entry" data-year="{{ $group->date->format('Y') }}"
                            data-title="{{ strtolower($group->title) }}">

                            <!-- Date marker -->
                            <div class="timeline-marker">
                                <div class="marker-dot"></div>
                                <div class="marker-date">
                                    <span class="marker-day">{{ $group->date->format('d') }}</span>
                                    <span class="marker-month">{{ $group->date->translatedFormat('M') }}</span>
                                    <span class="marker-year">{{ $group->date->format('Y') }}</span>
                                </div>
                            </div>

                            <!-- Content card -->
                            <div class="timeline-card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $group->title }}</h3>
                                    @if($group->description)
                                        <p class="card-desc">{{ $group->description }}</p>
                                    @endif
                                    <span class="photo-count">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <rect x="3" y="3" width="18" height="18" rx="2" />
                                            <circle cx="8.5" cy="8.5" r="1.5" />
                                            <polyline points="21 15 16 10 5 21" />
                                        </svg>
                                        {{ $photoCount }} {{ $photoCount == 1 ? __('gallery.photo') : __('gallery.photos') }}
                                    </span>
                                </div>

                                <!-- Photo grid preview (first 3) -->
                                <div class="photo-grid photo-grid-{{ min($photoCount, 3) }}">
                                    {{-- Preview photos (first 3) --}}
                                    @foreach($preview as $photo)
                                        <div class="photo-thumb"
                                            onclick="openLightbox('{{ asset('storage/' . $photo->path) }}', '{{ addslashes($group->title) }}')">
                                            <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $group->title }}"
                                                loading="lazy" onerror="this.parentElement.style.display='none'">
                                            <div class="photo-overlay">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <circle cx="11" cy="11" r="8" />
                                                    <path d="M21 21l-4.35-4.35" />
                                                    <line x1="11" y1="8" x2="11" y2="14" />
                                                    <line x1="8" y1="11" x2="14" y2="11" />
                                                </svg>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if($hasMany)
                                        <div class="extra-photos" id="extra-{{ $loop->index }}" style="display:none;">
                                            <div class="photo-grid photo-grid-3">
                                                @foreach($rest as $photo)
                                                    <div class="photo-thumb"
                                                        onclick="openLightbox('{{ asset('storage/' . $photo->path) }}', '{{ addslashes($group->title) }}')">
                                                        <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $group->title }}"
                                                            loading="lazy" onerror="this.parentElement.style.display='none'">
                                                        <div class="photo-overlay">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2">
                                                                <circle cx="11" cy="11" r="8" />
                                                                <path d="M21 21l-4.35-4.35" />
                                                                <line x1="11" y1="8" x2="11" y2="14" />
                                                                <line x1="8" y1="11" x2="14" y2="11" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <button class="expand-btn" onclick="togglePhotos({{ $loop->index }}, this)">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2.5" class="expand-icon">
                                                <polyline points="6 9 12 15 18 9" />
                                            </svg>
                                            <span
                                                class="expand-label">{{ __('gallery.show_more', ['count' => $rest->count()]) }}</span>
                                        </button>
                                    @endif
                                </div>

                            </div>
                    @endforeach

                    </div>

                    <!-- No results message -->
                    <div class="no-results" id="noResults" style="display:none;">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.2">
                            <circle cx="11" cy="11" r="8" />
                            <path d="M21 21l-4.35-4.35" />
                        </svg>
                        <h3>{{ __('gallery.no_results') }}</h3>
                        <p>{{ __('gallery.no_results_text') }}</p>
                    </div>
            @endif

            </div>
    </section>

    <!-- Lightbox -->
    <div class="lightbox-overlay" id="lightboxOverlay" onclick="closeLightbox(event)">
        <button class="lightbox-close" onclick="closeLightbox()">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
        <div class="lightbox-inner">
            <img id="lightboxImg" src="" alt="">
            <p id="lightboxCaption"></p>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-logos">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="footer-logo">
            </div>
            <div class="footer-social">
                <a href="https://facebook.com/okfngreece" class="social-link" target="_blank" rel="noopener">
                    <img src="{{ asset('img/social/facebook.png') }}" alt="Facebook" class="social-icon">
                </a>
                <a href="https://twitter.com/okfngr" class="social-link" target="_blank" rel="noopener">
                    <img src="{{ asset('img/social/twitter.png') }}" alt="Twitter" class="social-icon">
                </a>
                <a href="https://github.com/okgreece" class="social-link" target="_blank" rel="noopener">
                    <img src="{{ asset('img/social/github.png') }}" alt="GitHub" class="social-icon">
                </a>
                <a href="https://instagram.com/okgreece" class="social-link" target="_blank" rel="noopener">
                    <img src="{{ asset('img/social/instagram.png') }}" alt="Instagram" class="social-icon">
                </a>
            </div>
            <div class="footer-text">
                <p>{!! __('home.footer.content', [
    'okfn_greece' => '<a href="https://okfn.gr/">' . __('home.footer.okfn_greece') . '</a>',
    'okfn_international' => '<a href="https://okfn.org/">' . __('home.footer.okfn_international') .
        '</a>',
    'license' => '<a href="https://creativecommons.org/licenses/by/4.0/">' . __('home.footer.license') .
        '</a>'
]) !!}</p>
                <p style="margin-top:1rem;">{{ __('home.footer.copyright', ['year' => date('Y')]) }}</p>
            </div>
        </div>
    </footer>

    <script>
        // ── Lightbox ──────────────────────────────────────────
        function openLightbox(src, caption) {
            document.getElementById('lightboxImg').src = src;
            document.getElementById('lightboxCaption').textContent = caption;
            document.getElementById('lightboxOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox(e) {
            if (e && e.target !== document.getElementById('lightboxOverlay') && !e.target.closest('.lightbox-close')) return;
            document.getElementById('lightboxOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                document.getElementById('lightboxOverlay').classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // ── Expand / Collapse extra photos ───────────────────
        function togglePhotos(index, btn) {
            const extra = document.getElementById('extra-' + index);
            const icon = btn.querySelector('.expand-icon');
            const label = btn.querySelector('.expand-label');
            const isOpen = extra.style.display !== 'none';

            extra.style.display = isOpen ? 'none' : 'block';
            icon.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
            label.textContent = isOpen
                ? btn.dataset.more
                : btn.dataset.less;
        }

        // Store labels on buttons after DOM loads
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.expand-btn').forEach(btn => {
                btn.dataset.more = btn.querySelector('.expand-label').textContent;
                btn.dataset.less = '{{ __("gallery.show_less") }}';
            });
        });

        // ── Search & Filter ───────────────────────────────────
        const searchInput = document.getElementById('gallerySearch');
        const chips = document.querySelectorAll('.chip');
        const entries = document.querySelectorAll('.timeline-entry');
        const noResults = document.getElementById('noResults');
        const countNum = document.getElementById('countNum');
        let activeYear = 'all';

        function applyFilters() {
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            let visible = 0;

            entries.forEach(entry => {
                const year = entry.dataset.year;
                const title = entry.dataset.title;

                const matchYear = activeYear === 'all' || year === activeYear;
                const matchQuery = !query || title.includes(query);

                if (matchYear && matchQuery) {
                    entry.style.display = '';
                    visible++;
                } else {
                    entry.style.display = 'none';
                }
            });

            if (countNum) countNum.textContent = visible;
            if (noResults) noResults.style.display = visible === 0 ? 'flex' : 'none';
        }

        chips.forEach(chip => {
            chip.addEventListener('click', () => {
                chips.forEach(c => c.classList.remove('active'));
                chip.classList.add('active');
                activeYear = chip.dataset.year;
                applyFilters();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', applyFilters);
        }

        // ── Sticky controls ───────────────────────────────────
        const controls = document.getElementById('galleryControls');
        if (controls) {
            window.addEventListener('scroll', () => {
                controls.classList.toggle('sticky', window.scrollY > 80);
            });
        }

        // ── Mobile menu ───────────────────────────────────────
        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.querySelector('.mobile-menu-toggle');
            const nav = document.querySelector('nav');
            if (toggle) toggle.addEventListener('click', () => nav.classList.toggle('active'));

            document.querySelectorAll('.nav-item.has-dropdown > .nav-link').forEach(link => {
                link.addEventListener('click', e => {
                    if (window.innerWidth <= 1024) {
                        e.preventDefault();
                        const parent = link.closest('.nav-item');
                        document.querySelectorAll('.nav-item.has-dropdown').forEach(i => {
                            if (i !== parent) i.classList.remove('active');
                        });
                        parent.classList.toggle('active');
                    }
                });
            });
        });
    </script>
</body>

</html>