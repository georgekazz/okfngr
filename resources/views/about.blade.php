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
                <div class="nav-item">
                    <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="nav-link active">{{ __('home.nav.about') }}</a>
                </div>
                <div class="nav-item">
                    <a href="#team" class="nav-link">{{ __('home.nav.who_we_are') }}</a>
                </div>
                <div class="nav-item">
                    <a href="#work" class="nav-link">{{ __('home.nav.what_we_do') }}</a>
                </div>
                <div class="nav-item">
                    <a href="#data" class="nav-link">{{ __('home.nav.open_data') }}</a>
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
            <h1>{{ __('about.hero.title') }}</h1>
            <p class="hero-subtitle">{{ __('about.hero.subtitle') }}</p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="content-container">
            <div class="mission-content">
                <h2>{{ __('about.mission.title') }}</h2>
                <div class="mission-text">
                    <p>{{ __('about.mission.intro') }}</p>
                    
                    <h3>{{ __('about.mission.vision_title') }}</h3>
                    <p>{{ __('about.mission.vision_text') }}</p>
                    
                    <h3>{{ __('about.mission.values_title') }}</h3>
                    <ul class="values-list">
                        <li>
                            <strong>{{ __('about.mission.value1_title') }}</strong>
                            <p>{{ __('about.mission.value1_text') }}</p>
                        </li>
                        <li>
                            <strong>{{ __('about.mission.value2_title') }}</strong>
                            <p>{{ __('about.mission.value2_text') }}</p>
                        </li>
                        <li>
                            <strong>{{ __('about.mission.value3_title') }}</strong>
                            <p>{{ __('about.mission.value3_text') }}</p>
                        </li>
                        <li>
                            <strong>{{ __('about.mission.value4_title') }}</strong>
                            <p>{{ __('about.mission.value4_text') }}</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mission-image">
                <img src="{{ asset('img/mission-image.jpg') }}" alt="Our Mission">
            </div>
        </div>
    </section>

    <!-- What We Do Section -->
    <section class="what-we-do">
        <div class="content-container">
            <h2>{{ __('about.what_we_do.title') }}</h2>
            <div class="work-grid">
                <div class="work-card">
                    <div class="work-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 24H44" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24 4C29.0206 9.44839 31.8365 16.5725 32 24C31.8365 31.4275 29.0206 38.5516 24 44C18.9794 38.5516 16.1635 31.4275 16 24C16.1635 16.5725 18.9794 9.44839 24 4V4Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>{{ __('about.what_we_do.area1_title') }}</h3>
                    <p>{{ __('about.what_we_do.area1_text') }}</p>
                </div>

                <div class="work-card">
                    <div class="work-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M42 20V38C42 39.0609 41.5786 40.0783 40.8284 40.8284C40.0783 41.5786 39.0609 42 38 42H10C8.93913 42 7.92172 41.5786 7.17157 40.8284C6.42143 40.0783 6 39.0609 6 38V10C6 8.93913 6.42143 7.92172 7.17157 7.17157C7.92172 6.42143 8.93913 6 10 6H28" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M34 4H44V14" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20 28L44 4" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>{{ __('about.what_we_do.area2_title') }}</h3>
                    <p>{{ __('about.what_we_do.area2_text') }}</p>
                </div>

                <div class="work-card">
                    <div class="work-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M16 22V38" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24 14V38" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M32 26V38" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 42H42" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>{{ __('about.what_we_do.area3_title') }}</h3>
                    <p>{{ __('about.what_we_do.area3_text') }}</p>
                </div>

                <div class="work-card">
                    <div class="work-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M40 20C40 34 24 44 24 44C24 44 8 34 8 20C8 15.7565 9.68571 11.6869 12.6863 8.68629C15.6869 5.68571 19.7565 4 24 4C28.2435 4 32.3131 5.68571 35.3137 8.68629C38.3143 11.6869 40 15.7565 40 20Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24 26C27.3137 26 30 23.3137 30 20C30 16.6863 27.3137 14 24 14C20.6863 14 18 16.6863 18 20C18 23.3137 20.6863 26 24 26Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
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
</body>
</html>