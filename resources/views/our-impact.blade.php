<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('our_impact.title') }} - Open Knowledge Greece</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/our-impact.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <!-- Header -->
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
                <a href="./blog" class="blog-btn">{{ __('home.nav.blog') }}</a>
                <div class="lang-switcher">
                    <a href="{{ route('our-impact', ['locale' => 'en']) }}" class="lang-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        <img src="{{ asset('img/uk-flag.png') }}" alt="English" class="flag-icon">
                        EN
                    </a>
                    <a href="{{ route('our-impact', ['locale' => 'el']) }}" class="lang-link {{ app()->getLocale() == 'el' ? 'active' : '' }}">
                        <img src="{{ asset('img/gr-flag.png') }}" alt="Ελληνικά" class="flag-icon">
                        EL
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="impact-hero">
        <div class="hero-background">
            <div class="hero-shape shape-1"></div>
            <div class="hero-shape shape-2"></div>
            <div class="hero-shape shape-3"></div>
            <div class="hero-shape shape-4"></div>
        </div>

        <div class="hero-content">
            <div class="hero-badge">
                <img src="{{ asset('img/icons/impact.svg') }}" alt="Impact">
                <span>{{ __('our_impact.hero.badge') }}</span>
            </div>

            <h1>{{ __('our_impact.hero.title') }}</h1>
            <p class="hero-lead">{{ __('our_impact.hero.subtitle') }}</p>

            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-icon">
                        <img src="{{ asset('img/icons/connect-community.svg') }}" alt="Community">
                    </div>
                    <div class="stat-number">2012</div>
                    <div class="stat-label">{{ __('our_impact.hero.founded') }}</div>
                </div>

                <div class="stat-item">
                    <div class="stat-icon">
                        <img src="{{ asset('img/icons/collaboration.svg') }}" alt="Projects">
                    </div>
                    <div class="stat-number">50+</div>
                    <div class="stat-label">{{ __('our_impact.hero.projects') }}</div>
                </div>

                <div class="stat-item">
                    <div class="stat-icon">
                        <img src="{{ asset('img/icons/knowledge.svg') }}" alt="Impact">
                    </div>
                    <div class="stat-number">∞</div>
                    <div class="stat-label">{{ __('our_impact.hero.impact') }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="intro-section">
        <div class="content-container">
            <div class="intro-content">
                <div class="intro-question">
                    <h2>{{ __('our_impact.intro.question1') }}</h2>
                    <p>{{ __('our_impact.intro.answer1') }}</p>
                </div>

                <div class="choice-boxes">
                    <div class="choice-box closed">
                        <div class="choice-icon">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                                <path d="M30 5C16.215 5 5 16.215 5 30C5 43.785 16.215 55 30 55C43.785 55 55 43.785 55 30C55 16.215 43.785 5 30 5Z" stroke="currentColor" stroke-width="3" />
                                <path d="M30 20V30L37.5 37.5" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                <rect x="25" y="15" width="10" height="3" fill="currentColor" />
                            </svg>
                        </div>
                        <h3>{{ __('our_impact.intro.closed_title') }}</h3>
                        <p>{{ __('our_impact.intro.closed_text') }}</p>
                    </div>

                    <div class="choice-box open">
                        <div class="choice-icon">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                                <path d="M30 5C16.215 5 5 16.215 5 30C5 43.785 16.215 55 30 55C43.785 55 55 43.785 55 30C55 16.215 43.785 5 30 5Z" stroke="currentColor" stroke-width="3" />
                                <path d="M20 30L27 37L40 23" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3>{{ __('our_impact.intro.open_title') }}</h3>
                        <p>{{ __('our_impact.intro.open_text') }}</p>
                    </div>
                </div>

                <div class="our-belief">
                    <img src="{{ asset('img/icons/knowledge.svg') }}" alt="Belief" class="belief-icon">
                    <p>{{ __('our_impact.intro.our_belief') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do Section -->
    <section class="what-we-do-section">
        <div class="content-container">
            <h2 class="section-title">{{ __('our_impact.what_we_do.title') }}</h2>

            <div class="impact-cards">
                <div class="impact-card" data-color="#00D1FF">
                    <div class="card-icon">
                        <img src="{{ asset('img/icons/governance.svg') }}" alt="Lead">
                    </div>
                    <h3>{{ __('our_impact.what_we_do.lead_title') }}</h3>
                    <p>{{ __('our_impact.what_we_do.lead_text') }}</p>
                </div>

                <div class="impact-card" data-color="#ADFFED">
                    <div class="card-icon">
                        <img src="{{ asset('img/icons/tools.svg') }}" alt="Create">
                    </div>
                    <h3>{{ __('our_impact.what_we_do.create_title') }}</h3>
                    <p>{{ __('our_impact.what_we_do.create_text') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section class="achievements-section">
        <div class="content-container">
            <div class="achievements-header">
                <img src="{{ asset('img/icons/impact.svg') }}" alt="Achievements" class="section-icon-large">
                <h2>{{ __('our_impact.achievements.title') }}</h2>
                <p class="achievements-intro">{{ __('our_impact.achievements.intro') }}</p>
            </div>

            <div class="achievement-grid">
                <div class="achievement-item" data-color="#00D1FF">
                    <div class="achievement-number">01</div>
                    <h3>{{ __('our_impact.achievements.point1_title') }}</h3>
                    <p>{{ __('our_impact.achievements.point1_text') }}</p>
                </div>

                <div class="achievement-item" data-color="#ADFFED">
                    <div class="achievement-number">02</div>
                    <h3>{{ __('our_impact.achievements.point2_title') }}</h3>
                    <p>{{ __('our_impact.achievements.point2_text') }}</p>
                </div>

                <div class="achievement-item" data-color="#E4FF36">
                    <div class="achievement-number">03</div>
                    <h3>{{ __('our_impact.achievements.point3_title') }}</h3>
                    <p>{{ __('our_impact.achievements.point3_text') }}</p>
                </div>

                <div class="achievement-item" data-color="#E077FF">
                    <div class="achievement-number">04</div>
                    <h3>{{ __('our_impact.achievements.point4_title') }}</h3>
                    <p>{{ __('our_impact.achievements.point4_text') }}</p>
                </div>
            </div>

            <div class="proud-statement">
                <p>{{ __('our_impact.achievements.proud_text') }}</p>
            </div>
        </div>
    </section>

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
                <p>{!! __('home.footer.content', ['okfn_greece' => '<a href="https://okfn.gr/">' . __('home.footer.okfn_greece') . '</a>', 'okfn_international' => '<a href="https://okfn.org/">' . __('home.footer.okfn_international') . '</a>', 'license' => '<a href="https://creativecommons.org/licenses/by/4.0/">' . __('home.footer.license') . '</a>']) !!}</p>
                <p style="margin-top: 1rem;">{{ __('home.footer.copyright', ['year' => date('Y')]) }}</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const nav = document.querySelector('nav');

            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    nav.classList.toggle('active');
                });
            }

            const navItems = document.querySelectorAll('.nav-item.has-dropdown > .nav-link');

            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        const parent = this.parentElement;

                        document.querySelectorAll('.nav-item.has-dropdown').forEach(otherItem => {
                            if (otherItem !== parent) {
                                otherItem.classList.remove('active');
                            }
                        });

                        parent.classList.toggle('active');
                    }
                });
            });
        });
    </script>
</body>

</html>