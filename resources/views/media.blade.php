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
                        <a href="{{ route('about', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.our_mission') }}</a>
                        <a href="{{ route('vision-and-values', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.who_we_are') }}</a>
                        <a href="{{ route('our-impact', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.our_impact') }}</a>
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
                        <a href="{{ route('ourActions', ['locale' => app()->getLocale()]) }}"
                            class="dropdown-item">{{ __('home.nav.our_actions') }}</a>
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
                <a href="{{ route('posts.index', ['locale' => app()->getLocale()]) }}"
                    class="blog-btn">{{ __('home.nav.blog') }}</a>
                <div class="lang-switcher">
                    <a href="{{ route('media', ['locale' => 'en']) }}"
                        class="lang-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        <img src="{{ asset('img/uk-flag.png') }}" alt="English" class="flag-icon">
                        EN
                    </a>
                    <a href="{{ route('media', ['locale' => 'el']) }}"
                        class="lang-link {{ app()->getLocale() == 'el' ? 'active' : '' }}">
                        <img src="{{ asset('img/gr-flag.png') }}" alt="Ελληνικά" class="flag-icon">
                        EL
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

    <!-- Timeline Section -->
    <section class="timeline-section">
        <div class="content-container">

            @if($events->count() > 0)
                <div class="timeline">
                    @foreach($events as $index => $event)
                        <div class="timeline-item" data-index="{{ $index }}">
                            <div class="timeline-marker">
                                <div class="timeline-dot"></div>
                                <div class="timeline-date">
                                    <span class="day">{{ $event->event_date->format('d') }}</span>
                                    <span class="month">{{ $event->event_date->translatedFormat('M') }}</span>
                                    <span class="year">{{ $event->event_date->format('Y') }}</span>
                                </div>
                            </div>

                            <div class="timeline-content" onclick="openModal({{ $index }})">
                                @if($event->image)
                                    <div class="timeline-image">
                                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                                        <div class="image-overlay">
                                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2">
                                                <circle cx="12" cy="12" r="10" />
                                                <polyline points="12 6 12 12 16 14" />
                                            </svg>
                                        </div>
                                    </div>
                                @endif

                                <div class="timeline-body">
                                    <h3 class="timeline-title">{{ $event->title }}</h3>

                                    @if($event->location)
                                        <div class="timeline-location">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                                stroke-width="1.5">
                                                <path
                                                    d="M10 10.8333C11.3807 10.8333 12.5 9.71404 12.5 8.33333C12.5 6.95262 11.3807 5.83333 10 5.83333C8.61929 5.83333 7.5 6.95262 7.5 8.33333C7.5 9.71404 8.61929 10.8333 10 10.8333Z"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M10 17.5C13.3333 14.1667 16.6667 11.1548 16.6667 8.33333C16.6667 4.65143 13.6819 1.66667 10 1.66667C6.3181 1.66667 3.33333 4.65143 3.33333 8.33333C3.33333 11.1548 6.66667 14.1667 10 17.5Z"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            {{ $event->location }}
                                        </div>
                                    @endif

                                    <p class="timeline-excerpt">{{ Str::limit($event->description, 120) }}</p>

                                    <button class="btn-view-details">
                                        {{ __('media.view_details') }}
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <line x1="5" y1="10" x2="15" y2="10" />
                                            <polyline points="10 5 15 10 10 15" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-timeline">
                    <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    <h3>{{ __('media.no_events') }}</h3>
                    <p>{{ __('media.no_events_text') }}</p>
                </div>
            @endif

        </div>
    </section>

    <!-- Modal -->
    <div class="event-modal" id="eventModal">
        <div class="modal-overlay" onclick="closeModal()"></div>
        <div class="modal-container">
            <button class="modal-close" onclick="closeModal()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>

            <div class="modal-content" id="modalContent">
                <!-- Content will be injected here -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-logos">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="footer-logo">
            </div>
            <div class="footer-social">
                <!-- Facebook -->
                <a href="https://facebook.com/okfngreece" class="social-link" target="_blank" rel="noopener">
                    <img src="{{ asset('img/social/facebook.png') }}" alt="Facebook" class="social-icon">
                </a>

                <!-- Twitter -->
                <a href="https://twitter.com/okfngr" class="social-link" target="_blank" rel="noopener">
                    <img src="{{ asset('img/social/twitter.png') }}" alt="Twitter" class="social-icon">
                </a>

                <!-- GitHub -->
                <a href="https://github.com/okgreece" class="social-link" target="_blank" rel="noopener">
                    <img src="{{ asset('img/social/github.png') }}" alt="GitHub" class="social-icon">
                </a>

                <!-- Instagram -->
                <a href="https://instagram.com/okgreece" class="social-link" target="_blank" rel="noopener">
                    <img src="{{ asset('img/social/instagram.png') }}" alt="Instagram" class="social-icon">
                </a>
            </div>

            <div class="footer-text">
                <p>{!! __('home.footer.content', ['okfn_greece' => '<a href="https://okfn.gr/">' . __('home.footer.okfn_greece') . '</a>', 'okfn_international' => '<a href="https://okfn.org/">' . __('home.footer.okfn_international') . '</a>', 'license' => '<a href="https://creativecommons.org/licenses/by/4.0/">' . __('home.footer.license') . '</a>']) !!}
                </p>
                <p style="margin-top: 1rem;">{{ __('home.footer.copyright', ['year' => date('Y')]) }}</p>
            </div>
        </div>
    </footer>

    <script>
        const events = @json($events);

        function openModal(index) {
            const event = events[index];
            const modal = document.getElementById('eventModal');
            const modalContent = document.getElementById('modalContent');

            let linksHtml = '';
            if (event.links && event.links.length > 0) {
                linksHtml = '<div class="modal-links">';
                event.links.forEach(link => {
                    linksHtml += `
                        <a href="${link}" target="_blank" class="modal-link">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M10.8333 9.16667C10.3092 9.82926 9.56613 10.2845 8.73346 10.4588C7.90078 10.6331 7.03286 10.5159 6.28101 10.1271C5.52917 9.73829 4.94274 9.10306 4.62688 8.33438C4.31102 7.5657 4.28544 6.71437 4.55474 5.92894C4.82404 5.14351 5.37186 4.47529 6.09836 4.04265C6.82486 3.61001 7.68364 3.44149 8.52519 3.56482C9.36674 3.68815 10.1388 4.09574 10.7025 4.71667" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.16667 10.8333C9.69084 10.1707 10.4339 9.71554 11.2666 9.54121C12.0992 9.36688 12.9672 9.48414 13.719 9.87292C14.4709 10.2617 15.0573 10.8969 15.3732 11.6656C15.689 12.4343 15.7146 13.2856 15.4453 14.071C15.176 14.8565 14.6282 15.5247 13.9017 15.9573C13.1752 16.39 12.3164 16.5585 11.4749 16.4352C10.6333 16.3118 9.86125 15.9042 9.29752 15.2833" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ __('media.view_link') }}
                        </a>
                    `;
                });
                linksHtml += '</div>';
            }

            modalContent.innerHTML = `
                ${event.image ? `<div class="modal-image"><img src="{{ asset('storage') }}/${event.image}" alt="${event.title}"></div>` : ''}
                <div class="modal-header">
                    <h2>${event.title}</h2>
                    <div class="modal-meta">
                        <div class="meta-item">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M17.5 5.83333H2.5V15.8333C2.5 16.2754 2.67559 16.6993 2.98816 17.0118C3.30072 17.3244 3.72464 17.5 4.16667 17.5H15.8333C16.2754 17.5 16.6993 17.3244 17.0118 17.0118C17.3244 16.6993 17.5 16.2754 17.5 15.8333V5.83333Z"/>
                            </svg>
                            ${new Date(event.event_date).toLocaleDateString('{{ app()->getLocale() }}', { day: 'numeric', month: 'long', year: 'numeric' })}
                        </div>
                        ${event.location ? `
                            <div class="meta-item">
                                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M10 10.8333C11.3807 10.8333 12.5 9.71404 12.5 8.33333C12.5 6.95262 11.3807 5.83333 10 5.83333C8.61929 5.83333 7.5 6.95262 7.5 8.33333C7.5 9.71404 8.61929 10.8333 10 10.8333Z"/>
                                    <path d="M10 17.5C13.3333 14.1667 16.6667 11.1548 16.6667 8.33333C16.6667 4.65143 13.6819 1.66667 10 1.66667C6.3181 1.66667 3.33333 4.65143 3.33333 8.33333C3.33333 11.1548 6.66667 14.1667 10 17.5Z"/>
                                </svg>
                                ${event.location}
                            </div>
                        ` : ''}
                    </div>
                </div>
                <div class="modal-description">
                    ${event.description}
                </div>
                ${linksHtml}
            `;

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('eventModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Mobile menu
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const nav = document.querySelector('nav');

            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function () {
                    nav.classList.toggle('active');
                });
            }
        });
    </script>
</body>

</html>