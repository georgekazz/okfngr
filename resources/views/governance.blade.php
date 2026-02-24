<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Governance - Open Knowledge Greece</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/governance.css') }}">
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
                    <a href="{{ route('governance', ['locale' => 'en']) }}"
                        class="lang-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        <img src="{{ asset('img/uk-flag.png') }}" alt="English" class="flag-icon">
                        EN
                    </a>
                    <a href="{{ route('governance', ['locale' => 'el']) }}"
                        class="lang-link {{ app()->getLocale() == 'el' ? 'active' : '' }}">
                        <img src="{{ asset('img/gr-flag.png') }}" alt="Ελληνικά" class="flag-icon">
                        EL
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="governance-hero">
        <div class="hero-background">
            <div class="hero-shape shape-1"></div>
            <div class="hero-shape shape-2"></div>
            <div class="hero-shape shape-3"></div>
        </div>

        <div class="hero-content">
            <div class="hero-badge">
                <img src="{{ asset('img/icons/governance.svg') }}" alt="Governance">
                <span>{{ __('governance.hero.badge') }}</span>
            </div>

            <h1>{{ __('governance.hero.title') }}</h1>
            <p class="hero-lead">{{ __('governance.hero.subtitle') }}</p>
        </div>
    </section>

    <!-- Governance Content -->
    <section class="governance-content">
        <div class="content-container">

            <!-- Introduction -->
            <div class="governance-intro">
                <div class="intro-icon">
                    <img src="{{ asset('img/icons/mission.svg') }}" alt="Mission">
                </div>
                <p class="intro-text">{{ __('governance.intro') }}</p>
            </div>

            <!-- Democracy Section -->
            <div class="governance-section">
                <div class="section-header">
                    <div class="section-number">01</div>
                    <h2>{{ __('governance.democracy.title') }}</h2>
                </div>
                <div class="section-content">
                    <p>{{ __('governance.democracy.text') }}</p>
                </div>
            </div>

            <!-- Leadership Section -->
            <div class="governance-section highlight">
                <div class="section-header">
                    <div class="section-number">02</div>
                    <h2>{{ __('governance.leadership.title') }}</h2>
                </div>
                <div class="section-content">
                    <div class="leadership-box">
                        <div class="leader-info">
                            <img src="{{ asset('img/people/bratsas1.jpg') }}" alt="Dr. Charalampos Bratsas"
                                class="leader-photo">
                            <div class="leader-details">
                                <h3>{{ __('governance.leadership.president_name') }}</h3>
                                <p class="leader-title">{{ __('governance.leadership.president_title') }}</p>
                                <p class="leader-bio">{{ __('governance.leadership.president_bio') }}</p>
                            </div>
                        </div>
                    </div>
                    <p class="leadership-text">{{ __('governance.leadership.board_text') }}</p>
                </div>
            </div>

            <!-- Responsibility Section -->
            <div class="governance-section">
                <div class="section-header">
                    <div class="section-number">03</div>
                    <h2>{{ __('governance.responsibility.title') }}</h2>
                </div>
                <div class="section-content">
                    <p>{{ __('governance.responsibility.text') }}</p>
                </div>
            </div>

            <!-- Volunteers Section -->
            <div class="governance-section">
                <div class="section-header">
                    <div class="section-number">04</div>
                    <h2>{{ __('governance.volunteers.title') }}</h2>
                </div>
                <div class="section-content">
                    <p>{{ __('governance.volunteers.text') }}</p>

                    <div class="volunteer-communities">
                        <div class="community-badge">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                                <path d="M6 12v5c3 3 9 3 12 0v-5" />
                            </svg>
                            <span>{{ __('governance.volunteers.community1') }}</span>
                        </div>
                        <div class="community-badge">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                            </svg>
                            <span>{{ __('governance.volunteers.community2') }}</span>
                        </div>
                        <div class="community-badge">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                            <span>{{ __('governance.volunteers.community3') }}</span>
                        </div>
                        <div class="community-badge">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            <span>{{ __('governance.volunteers.community4') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Organization Section -->
            <div class="governance-section">
                <div class="section-header">
                    <div class="section-number">05</div>
                    <h2>{{ __('governance.organization.title') }}</h2>
                </div>
                <div class="section-content">
                    <p>{{ __('governance.organization.text1') }}</p>
                    <p>{{ __('governance.organization.text2') }}</p>
                </div>
            </div>

            <!-- Decision Making Section -->
            <div class="governance-section highlight">
                <div class="section-header">
                    <div class="section-number">06</div>
                    <h2>{{ __('governance.decisions.title') }}</h2>
                </div>
                <div class="section-content">
                    <p>{{ __('governance.decisions.text') }}</p>

                    <div class="decision-process">
                        <div class="process-step">
                            <div class="step-icon">💬</div>
                            <p>{{ __('governance.decisions.step1') }}</p>
                        </div>
                        <div class="process-arrow">→</div>
                        <div class="process-step">
                            <div class="step-icon">🤝</div>
                            <p>{{ __('governance.decisions.step2') }}</p>
                        </div>
                        <div class="process-arrow">→</div>
                        <div class="process-step">
                            <div class="step-icon">✓</div>
                            <p>{{ __('governance.decisions.step3') }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


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

</body>

</html>