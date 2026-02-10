<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('about.title') }} - Open Knowledge Greece</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
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
                    <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="nav-link active">{{ __('home.nav.about') }} <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.our_mission') }}</a>
                        <a href="#vision" class="dropdown-item">{{ __('home.nav.our_vision') }}</a>
                        <a href="#team" class="dropdown-item">{{ __('home.nav.our_team') }}</a>
                    </div>
                </div>
                <div class="nav-item has-dropdown">
                    <a href="#team" class="nav-link">{{ __('home.nav.who_we_are') }} <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="#team" class="dropdown-item">{{ __('home.nav.team') }}</a>
                        <a href="#partners" class="dropdown-item">{{ __('home.nav.partners') }}</a>
                        <a href="#history" class="dropdown-item">{{ __('home.nav.history') }}</a>
                    </div>
                </div>
                <div class="nav-item has-dropdown">
                    <a href="#work" class="nav-link">{{ __('home.nav.what_we_do') }} <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="#projects" class="dropdown-item">{{ __('home.nav.projects') }}</a>
                        <a href="#research" class="dropdown-item">{{ __('home.nav.research') }}</a>
                        <a href="#advocacy" class="dropdown-item">{{ __('home.nav.advocacy') }}</a>
                    </div>
                </div>
                <div class="nav-item has-dropdown">
                    <a href="#data" class="nav-link">{{ __('home.nav.open_data') }} <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="#datasets" class="dropdown-item">{{ __('home.nav.datasets') }}</a>
                        <a href="#tools" class="dropdown-item">{{ __('home.nav.tools') }}</a>
                        <a href="#resources" class="dropdown-item">{{ __('home.nav.resources') }}</a>
                    </div>
                </div>
            </nav>
            <div class="nav-actions">
                <a href="{{ route('posts.index', ['locale' => app()->getLocale()]) }}" class="blog-btn">{{ __('home.nav.blog') }}</a>
                <div class="lang-switcher">
                    <a href="{{ route('about', ['locale' => 'en']) }}" class="lang-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        <img src="{{ asset('img/uk-flag.png') }}" alt="English" class="flag-icon">
                        EN
                    </a>
                    <a href="{{ route('about', ['locale' => 'el']) }}" class="lang-link {{ app()->getLocale() == 'el' ? 'active' : '' }}">
                        <img src="{{ asset('img/gr-flag.png') }}" alt="Ελληνικά" class="flag-icon">
                        EL
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="about-hero-content">
            <div class="hero-icon">
                <img src="{{ asset('img/icons/mission.svg') }}" alt="Mission">
            </div>
            <h1>{{ __('about.hero.title') }}</h1>
            <p class="hero-subtitle">{{ __('about.hero.subtitle') }}</p>
        </div>
        <div class="hero-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="content-container">
            <div class="section-header">
                <img src="{{ asset('img/icons/knowledge.svg') }}" alt="Knowledge" class="section-icon">
                <h2>{{ __('about.mission.title') }}</h2>
            </div>
            
            <div class="mission-intro">
                <p class="intro-text">{{ __('about.mission.intro') }}</p>
            </div>

            <div class="vision-box">
                <div class="vision-icon">
                    <img src="{{ asset('img/icons/impact.svg') }}" alt="Vision">
                </div>
                <div class="vision-content">
                    <h3>{{ __('about.mission.vision_title') }}</h3>
                    <p>{{ __('about.mission.vision_text') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Timeline Section -->
    <section class="values-section">
        <div class="content-container">
            <div class="section-header">
                <h2>{{ __('about.mission.values_title') }}</h2>
                <p class="section-subtitle">The principles that guide our work</p>
            </div>

            <div class="values-timeline">
                <!-- Value 1 -->
                <div class="timeline-item" data-color="#00D1FF">
                    <div class="timeline-marker">
                        <div class="marker-icon">
                            <img src="{{ asset('img/icons/governance.svg') }}" alt="Transparency">
                        </div>
                    </div>
                    <div class="timeline-content">
                        <h3>{{ __('about.mission.value1_title') }}</h3>
                        <p>{{ __('about.mission.value1_text') }}</p>
                    </div>
                </div>

                <!-- Value 2 -->
                <div class="timeline-item" data-color="#ADFFED">
                    <div class="timeline-marker">
                        <div class="marker-icon">
                            <img src="{{ asset('img/icons/connect-community.svg') }}" alt="Participation">
                        </div>
                    </div>
                    <div class="timeline-content">
                        <h3>{{ __('about.mission.value2_title') }}</h3>
                        <p>{{ __('about.mission.value2_text') }}</p>
                    </div>
                </div>

                <!-- Value 3 -->
                <div class="timeline-item" data-color="#E4FF36">
                    <div class="timeline-marker">
                        <div class="marker-icon">
                            <img src="{{ asset('img/icons/create-open-data.svg') }}" alt="Innovation">
                        </div>
                    </div>
                    <div class="timeline-content">
                        <h3>{{ __('about.mission.value3_title') }}</h3>
                        <p>{{ __('about.mission.value3_text') }}</p>
                    </div>
                </div>

                <!-- Value 4 -->
                <div class="timeline-item" data-color="#E077FF">
                    <div class="timeline-marker">
                        <div class="marker-icon">
                            <img src="{{ asset('img/icons/collaboration.svg') }}" alt="Collaboration">
                        </div>
                    </div>
                    <div class="timeline-content">
                        <h3>{{ __('about.mission.value4_title') }}</h3>
                        <p>{{ __('about.mission.value4_text') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do Section -->
    <section class="what-we-do">
        <div class="content-container">
            <div class="section-header">
                <h2>{{ __('about.what_we_do.title') }}</h2>
            </div>
            
            <div class="work-grid">
                <div class="work-card" data-color="#00D1FF">
                    <div class="work-icon">
                        <img src="{{ asset('img/icons/data.svg') }}" alt="Open Data">
                    </div>
                    <h3>{{ __('about.what_we_do.area1_title') }}</h3>
                    <p>{{ __('about.what_we_do.area1_text') }}</p>
                </div>

                <div class="work-card" data-color="#ADFFED">
                    <div class="work-icon">
                        <img src="{{ asset('img/icons/training.svg') }}" alt="Education">
                    </div>
                    <h3>{{ __('about.what_we_do.area2_title') }}</h3>
                    <p>{{ __('about.what_we_do.area2_text') }}</p>
                </div>

                <div class="work-card" data-color="#E4FF36">
                    <div class="work-icon">
                        <img src="{{ asset('img/icons/reproducible-research.svg') }}" alt="Research">
                    </div>
                    <h3>{{ __('about.what_we_do.area3_title') }}</h3>
                    <p>{{ __('about.what_we_do.area3_text') }}</p>
                </div>

                <div class="work-card" data-color="#E077FF">
                    <div class="work-icon">
                        <img src="{{ asset('img/icons/support.svg') }}" alt="Community">
                    </div>
                    <h3>{{ __('about.what_we_do.area4_title') }}</h3>
                    <p>{{ __('about.what_we_do.area4_text') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Us Section -->
    <section class="join-section">
        <div class="content-container">
            <div class="join-icon">
                <img src="{{ asset('img/icons/contact.svg') }}" alt="Join Us">
            </div>
            <h2>{{ __('about.join.title') }}</h2>
            <p class="join-text">{{ __('about.join.text') }}</p>
            <div class="join-buttons">
                <a href="{{ route('posts.index', ['locale' => app()->getLocale()]) }}" class="btn-primary">{{ __('about.join.blog_btn') }}</a>
                <a href="#contact" class="btn-secondary">{{ __('about.join.contact_btn') }}</a>
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
                <p>{!! __('home.footer.content', ['okfn_greece' => '<a href="https://okfn.gr/">' . __('home.footer.okfn_greece') . '</a>', 'okfn_international' => '<a href="https://okfn.org/">' . __('home.footer.okfn_international') . '</a>', 'license' => '<a href="https://creativecommons.org/licenses/by/4.0/">' . __('home.footer.license') . '</a>']) !!}</p>
                <p style="margin-top: 1rem;">{{ __('home.footer.copyright', ['year' => date('Y')]) }}</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const nav = document.querySelector('nav');
            
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    nav.classList.toggle('active');
                });
            }

            // Mobile dropdown toggle
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