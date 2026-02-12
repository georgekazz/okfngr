<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Why Open - Open Knowledge Greece</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/opendata.css') }}">
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
                <a href="./el/blog" class="blog-btn">{{ __('home.nav.blog') }}</a>
                <div class="lang-switcher">
                    <a href="{{ route('whyOpen', ['locale' => 'en']) }}"
                        class="lang-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        <img src="{{ asset('img/uk-flag.png') }}" alt="English" class="flag-icon">
                        EN
                    </a>
                    <a href="{{ route('whyOpen', ['locale' => 'el']) }}"
                        class="lang-link {{ app()->getLocale() == 'el' ? 'active' : '' }}">
                        <img src="{{ asset('img/gr-flag.png') }}" alt="Ελληνικά" class="flag-icon">
                        EL
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="opendata-hero">
        <div class="hero-background">
            <div class="hero-shape shape-1"></div>
            <div class="hero-shape shape-2"></div>
            <div class="hero-shape shape-3"></div>
        </div>

        <div class="hero-content">
            <div class="hero-badge">
                <img src="{{ asset('img/icons/data.svg') }}" alt="Open Data">
                <span>{{ __('opendata.hero.badge') }}</span>
            </div>

            <h1>{{ __('opendata.hero.title') }}</h1>
            <p class="hero-lead">{{ __('opendata.hero.subtitle') }}</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="opendata-content">
        <div class="content-container">

            <!-- Definition Box -->
            <div class="definition-box">
                <div class="definition-icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 16v-4M12 8h.01" />
                    </svg>
                </div>
                <h2>{{ __('opendata.what_is_open.title') }}</h2>
                <p class="definition-quote">{{ __('opendata.what_is_open.definition') }}</p>
            </div>

            <!-- Open Data Explanation -->
            <div class="content-section">
                <h2>{{ __('opendata.open_data.title') }}</h2>
                <p class="intro-text">{{ __('opendata.open_data.intro') }}</p>
                <p>{{ __('opendata.open_data.full_definition') }}</p>
            </div>

            <!-- Key Principles -->
            <div class="principles-section">
                <h2>{{ __('opendata.principles.title') }}</h2>

                <div class="principles-grid">
                    <div class="principle-card">
                        <div class="principle-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path
                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                                <line x1="12" y1="22.08" x2="12" y2="12" />
                            </svg>
                        </div>
                        <h3>{{ __('opendata.principles.availability.title') }}</h3>
                        <p>{{ __('opendata.principles.availability.text') }}</p>
                    </div>

                    <div class="principle-card">
                        <div class="principle-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                        <h3>{{ __('opendata.principles.reuse.title') }}</h3>
                        <p>{{ __('opendata.principles.reuse.text') }}</p>
                    </div>

                    <div class="principle-card">
                        <div class="principle-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="2" y1="12" x2="22" y2="12" />
                                <path
                                    d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                            </svg>
                        </div>
                        <h3>{{ __('opendata.principles.participation.title') }}</h3>
                        <p>{{ __('opendata.principles.participation.text') }}</p>
                    </div>
                </div>
            </div>

            <!-- Interoperability Section -->
            <div class="interoperability-section">
                <div class="section-header-large">
                    <img src="{{ asset('img/icons/collaboration.svg') }}" alt="Interoperability" class="section-icon">
                    <h2>{{ __('opendata.interoperability.title') }}</h2>
                </div>

                <p class="lead-paragraph">{{ __('opendata.interoperability.intro') }}</p>

                <div class="interop-content">
                    <div class="interop-text">
                        <p>{{ __('opendata.interoperability.definition') }}</p>
                        <p>{{ __('opendata.interoperability.importance') }}</p>
                        <p>{{ __('opendata.interoperability.babel') }}</p>
                    </div>

                    <div class="interop-visual">
                        <div class="interop-diagram">
                            <div class="dataset-box">
                                <span>{{ __('opendata.interoperability.dataset') }} A</span>
                            </div>
                            <div class="plus-sign">+</div>
                            <div class="dataset-box">
                                <span>{{ __('opendata.interoperability.dataset') }} B</span>
                            </div>
                            <div class="equals-sign">=</div>
                            <div class="dataset-box combined">
                                <span>{{ __('opendata.interoperability.value') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="highlight-text">{{ __('opendata.interoperability.benefits') }}</p>
            </div>

            <!-- Types of Data -->
            <div class="data-types-section">
                <h2>{{ __('opendata.data_types.title') }}</h2>
                <p>{{ __('opendata.data_types.intro') }}</p>

                <div class="key-point-box">
                    <div class="key-icon">🔑</div>
                    <div class="key-content">
                        <h3>{{ __('opendata.data_types.key_point.title') }}</h3>
                        <p>{{ __('opendata.data_types.key_point.text') }}</p>
                    </div>
                </div>

                <div class="restrictions-box">
                    <h3>{{ __('opendata.data_types.restrictions.title') }}</h3>
                    <ul>
                        <li>{{ __('opendata.data_types.restrictions.personal') }}</li>
                        <li>{{ __('opendata.data_types.restrictions.security') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Why Clear Definition -->
            <div class="definition-importance">
                <div class="importance-icon">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 11l3 3L22 4" />
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                    </svg>
                </div>
                <h3>{{ __('opendata.clear_definition.title') }}</h3>
                <p>{{ __('opendata.clear_definition.text') }}</p>
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