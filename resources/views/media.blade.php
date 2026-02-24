<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('media.title') }} - Open Knowledge Greece</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-timeline.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="logo">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="Open Knowledge Greece" class="logo-img">
            </a>
            <button class="mobile-menu-toggle">☰</button>
            <nav>
                <div class="nav-item has-dropdown">
                    <a href="#" class="nav-link">{{ __('home.nav.about') }} <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.our_mission') }}</a>
                        <a href="{{ route('vision-and-values', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.who_we_are') }}</a>
                        <a href="{{ route('our-impact', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.our_impact') }}</a>
                    </div>
                </div>
                <div class="nav-item has-dropdown">
                    <a href="#" class="nav-link">{{ __('home.nav.who_we_are2') }} <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('our-team', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.team') }}</a>
                        <a href="{{ route('board-of-directors', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.board') }}</a>
                        <a href="{{ route('governance', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.governance') }}</a>
                    </div>
                </div>
                <div class="nav-item has-dropdown">
                    <a href="#" class="nav-link">{{ __('home.nav.what_we_do') }} <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('researchProjects', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.projects') }}</a>
                        <a href="{{ route('applications', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.apps') }}</a>
                        <a href="{{ route('oldProjects', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.old_apps') }}</a>
                        <a href="{{ route('media', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.media') }}</a>
                        <a href="{{ route('editions', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.editions') }}</a>
                    </div>
                </div>
                <div class="nav-item has-dropdown">
                    <a href="#" class="nav-link">{{ __('home.nav.open_data') }} <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('openData', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.open_data') }}</a>
                        <a href="{{ route('howTo', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.how_to') }}</a>
                        <a href="{{ route('whyOpen', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.why_open') }}</a>
                    </div>
                </div>
            </nav>
            <div class="nav-actions">
                <a href="{{ route('posts.index', ['locale' => app()->getLocale()]) }}" class="blog-btn">
                    <span>{{ __('home.nav.blog') }}</span>
                </a>
                <div class="lang-switcher">
                    <a href="{{ route('media', ['locale' => 'en']) }}" class="lang-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        <img src="{{ asset('img/uk-flag.png') }}" alt="English" class="flag-icon"> EN
                    </a>
                    <a href="{{ route('media', ['locale' => 'el']) }}" class="lang-link {{ app()->getLocale() == 'el' ? 'active' : '' }}">
                        <img src="{{ asset('img/gr-flag.png') }}" alt="Ελληνικά" class="flag-icon"> EL
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="media-hero">
        <div class="hero-background">
            <div class="hero-shape shape-1"></div>
            <div class="hero-shape shape-2"></div>
            <div class="hero-shape shape-3"></div>
        </div>
        <div class="hero-content">
            <div class="hero-badge">
                <img src="{{ asset('img/icons/campagne.svg') }}" alt="Media">
                <span>{{ __('media.hero.badge') }}</span>
            </div>
            <h1>{{ __('media.hero.title') }}</h1>
            <p class="hero-lead">{{ __('media.hero.subtitle') }}</p>
        </div>
    </section>

    <!-- Ruler Timeline Section -->
    <section class="ruler-section">

        @if($events->count() > 0)

            <div class="ruler-track-wrapper">
                <div class="ruler-line"></div>
                <div class="ruler-track" id="rulerTrack">

                    @foreach($events as $index => $event)
                    <div class="ruler-event" data-index="{{ $index }}" onclick="openPopup({{ $index }})">

                        <div class="ruler-card">
                            @if($event->image)
                                <img class="ruler-card-img"
                                     src="{{ asset('storage/' . $event->image) }}"
                                     alt="{{ $event->title }}"
                                     onerror="this.style.display='none'">
                            @else
                                <div class="ruler-card-img-placeholder">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <polyline points="21 15 16 10 5 21"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="ruler-card-body">
                                <div class="ruler-card-title">{{ $event->title }}</div>
                                @if($event->location)
                                    <div class="ruler-card-loc">
                                        <svg width="12" height="12" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M10 17.5C10 17.5 3.33333 11.1548 3.33333 8.33333C3.33333 4.65143 6.3181 1.66667 10 1.66667C13.6819 1.66667 16.6667 4.65143 16.6667 8.33333C16.6667 11.1548 10 17.5 10 17.5Z"/>
                                            <circle cx="10" cy="8.33333" r="2.5"/>
                                        </svg>
                                        {{ Str::limit($event->location, 22) }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="ruler-tick-wrap">
                            <div class="ruler-tick"></div>
                            <div class="ruler-dot"></div>
                        </div>

                        <div class="ruler-date-badge">
                            <span class="day">{{ $event->event_date->format('d') }}</span>
                            <span class="month">{{ $event->event_date->translatedFormat('M') }}</span>
                            <span class="year">{{ $event->event_date->format('Y') }}</span>
                        </div>

                    </div>
                    @endforeach

                </div>
            </div>

            <div class="ruler-nav">
                <button class="ruler-nav-btn" id="prevBtn" onclick="navigate(-1)" aria-label="Previous">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                </button>
                <button class="ruler-nav-btn" id="nextBtn" onclick="navigate(1)" aria-label="Next">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </button>
            </div>

            <div class="ruler-progress" id="rulerProgress">
                @foreach($events as $index => $event)
                    <div class="ruler-progress-dot {{ $index === 0 ? 'active' : '' }}"
                         onclick="goTo({{ $index }})"
                         aria-label="Event {{ $index + 1 }}"></div>
                @endforeach
            </div>

        @else
            <div class="ruler-empty">
                <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <h3>{{ __('media.no_events') }}</h3>
                <p>{{ __('media.no_events_text') }}</p>
            </div>
        @endif

    </section>

    <!-- Popup Modal -->
    <div class="event-popup-overlay" id="eventPopupOverlay" onclick="handleOverlayClick(event)">
        <div class="event-popup" id="eventPopup">
            <button class="popup-close" onclick="closePopup()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
            <div id="popupContent"></div>
        </div>
    </div>

    <!-- Footer -->
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
                    'okfn_international' => '<a href="https://okfn.org/">' . __('home.footer.okfn_international') . '</a>',
                    'license' => '<a href="https://creativecommons.org/licenses/by/4.0/">' . __('home.footer.license') . '</a>'
                ]) !!}</p>
                <p style="margin-top: 1rem;">{{ __('home.footer.copyright', ['year' => date('Y')]) }}</p>
            </div>
        </div>
    </footer>
 @php
        $eventsJson = $events->map(function($e) {
            return [
                'title'       => $e->title,
                'date'        => $e->event_date->translatedFormat('d F Y'),
                'location'    => $e->location,
                'description' => $e->description,
                'image'       => $e->image ? asset('storage/' . $e->image) : null,
                'links'       => $e->links ?? [],
            ];
        });
    @endphp
    <script>
   
    const eventsData = {!! json_encode($eventsJson) !!};

    // ── Ruler navigation ──────────────────────────────────────
    const track   = document.getElementById('rulerTrack');
    const cards   = track ? track.querySelectorAll('.ruler-event') : [];
    const dots    = document.querySelectorAll('.ruler-progress-dot');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    let current   = 0;
    const total   = cards.length;

    function getEventWidth() {
        return cards[0] ? cards[0].offsetWidth : 240;
    }

    function updateTrack() {
        if (!track || total === 0) return;
        const eventW = getEventWidth();
        const center = window.innerWidth / 2;
        const offset = center - (current * eventW) - (eventW / 2);
        track.style.transform = 'translateX(' + offset + 'px)';

        cards.forEach(function(el, i) { el.classList.toggle('active', i === current); });
        dots.forEach(function(d, i)  { d.classList.toggle('active', i === current); });

        if (prevBtn) prevBtn.disabled = current === 0;
        if (nextBtn) nextBtn.disabled = current === total - 1;
    }

    function navigate(dir) {
        current = Math.max(0, Math.min(total - 1, current + dir));
        updateTrack();
    }

    function goTo(index) {
        current = index;
        updateTrack();
    }

    window.addEventListener('load', updateTrack);
    window.addEventListener('resize', updateTrack);

    // Drag support
    let isDragging = false, startX = 0, startCurrent = 0;

    if (track) {
        track.addEventListener('mousedown', function(e) {
            isDragging = true;
            startX = e.clientX;
            startCurrent = current;
        });

        track.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            startCurrent = current;
        }, { passive: true });

        track.addEventListener('touchend', function(e) {
            var diff = startX - e.changedTouches[0].clientX;
            if (diff > 60) current = Math.min(total - 1, startCurrent + 1);
            else if (diff < -60) current = Math.max(0, startCurrent - 1);
            updateTrack();
        });
    }

    window.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        var diff = startX - e.clientX;
        var threshold = getEventWidth() / 3;
        if (diff > threshold) current = Math.min(total - 1, startCurrent + 1);
        else if (diff < -threshold) current = Math.max(0, startCurrent - 1);
        updateTrack();
    });

    window.addEventListener('mouseup', function() { isDragging = false; });

    // Keyboard
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft')  navigate(-1);
        if (e.key === 'ArrowRight') navigate(1);
        if (e.key === 'Escape')     closePopup();
    });

    // ── Popup ─────────────────────────────────────────────────
    function openPopup(index) {
        var e = eventsData[index];
        if (!e) return;

        goTo(index);

        var imageHtml = e.image
            ? '<div class="popup-image"><img src="' + e.image + '" alt="' + e.title + '" onerror="this.parentElement.style.display=\'none\'"></div>'
            : '<div class="popup-image-placeholder"><svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>';

        var locationHtml = e.location
            ? '<div class="popup-meta-item"><svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M10 17.5C10 17.5 3.33 11.15 3.33 8.33C3.33 4.65 6.32 1.67 10 1.67C13.68 1.67 16.67 4.65 16.67 8.33C16.67 11.15 10 17.5 10 17.5Z"/><circle cx="10" cy="8.33" r="2.5"/></svg>' + e.location + '</div>'
            : '';

        var linksHtml = '';
        if (e.links && e.links.length) {
            linksHtml = '<div class="popup-links">';
            for (var i = 0; i < e.links.length; i++) {
                var l = e.links[i];
                linksHtml += '<a href="' + l.url + '" target="_blank" rel="noopener" class="popup-link">' + (l.label || l.url) + '</a>';
            }
            linksHtml += '</div>';
        }

        document.getElementById('popupContent').innerHTML =
            imageHtml +
            '<div class="popup-body">' +
                '<div class="popup-date-tag">' + e.date + '</div>' +
                '<h2 class="popup-title">' + e.title + '</h2>' +
                '<div class="popup-meta">' + locationHtml + '</div>' +
                '<div class="popup-description">' + (e.description || '') + '</div>' +
                linksHtml +
            '</div>';

        document.getElementById('eventPopupOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closePopup() {
        document.getElementById('eventPopupOverlay').classList.remove('active');
        document.body.style.overflow = '';
    }

    function handleOverlayClick(e) {
        if (e.target === document.getElementById('eventPopupOverlay')) closePopup();
    }

    // Mobile menu
    document.addEventListener('DOMContentLoaded', function() {
        var toggle = document.querySelector('.mobile-menu-toggle');
        var nav    = document.querySelector('nav');
        if (toggle) {
            toggle.addEventListener('click', function() {
                nav.classList.toggle('active');
            });
        }
    });
    </script>
</body>
</html>