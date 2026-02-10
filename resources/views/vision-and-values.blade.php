<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('who_we_are.title') }} - Open Knowledge Greece</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/who-we-are.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="./el" class="logo">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="Open Knowledge Greece" class="logo-img">
            </a>
            <button class="mobile-menu-toggle">☰</button>
            <nav>
                <div class="nav-item has-dropdown">
                    <a href="#about" class="nav-link">{{ __('home.nav.about') }} <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.our_mission') }}</a>
                        <a href="{{ route('vision-and-values', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.who_we_are') }}</a>
                        <a href="{{ route('our-impact', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.our_impact') }}</a>
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
                <a href="./el/blog" class="blog-btn">{{ __('home.nav.blog') }}</a>
                <div class="lang-switcher">
                    <a href="./en" class="lang-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        <img src="{{ asset('img/uk-flag.png') }}" alt="English" class="flag-icon">
                        EN
                    </a>

                    <a href="./el" class="lang-link {{ app()->getLocale() == 'el' ? 'active' : '' }}">
                        <img src="{{ asset('img/gr-flag.png') }}" alt="Ελληνικά" class="flag-icon">
                        EL
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="hero-content">
            <div class="hero-icon">
                <img src="{{ asset('img/icons/knowledge.svg') }}" alt="Knowledge">
            </div>
            <h1>{{ __('who_we_are.hero.title') }}</h1>
            <p class="hero-lead">{{ __('who_we_are.hero.subtitle') }}</p>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="vision-section">
        <div class="content-container">
            <div class="section-header-large">
                <img src="{{ asset('img/icons/impact.svg') }}" alt="Vision" class="section-icon-large">
                <h2>{{ __('who_we_are.vision.title') }}</h2>
            </div>

            <div class="vision-content">
                <div class="vision-intro">
                    <p class="lead-text">{{ __('who_we_are.vision.intro') }}</p>
                </div>

                <div class="vision-paragraphs">
                    <p>{{ __('who_we_are.vision.paragraph1') }}</p>
                    <p>{{ __('who_we_are.vision.paragraph2') }}</p>
                    <p>{{ __('who_we_are.vision.paragraph3') }}</p>
                    <p>{{ __('who_we_are.vision.paragraph4') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Open Term Section -->
    <section class="open-term-section">
        <div class="content-container">
            <div class="section-header-large">
                <h2>{{ __('who_we_are.open_term.title') }}</h2>
            </div>

            <div class="term-content">
                <p class="lead-text">{{ __('who_we_are.open_term.intro') }}</p>
                
                <div class="definition-box">
                    <h3>{{ __('who_we_are.open_term.definition_title') }}</h3>
                    <p>{{ __('who_we_are.open_term.definition_text') }}</p>
                </div>

                <div class="principles-grid">
                    <div class="principle-card" data-color="#00D1FF">
                        <div class="principle-icon">
                            <img src="{{ asset('img/icons/governance.svg') }}" alt="Access">
                        </div>
                        <p>{{ __('who_we_are.open_term.principle1') }}</p>
                    </div>

                    <div class="principle-card" data-color="#ADFFED">
                        <div class="principle-icon">
                            <img src="{{ asset('img/icons/reproducible-research.svg') }}" alt="Redistribute">
                        </div>
                        <p>{{ __('who_we_are.open_term.principle2') }}</p>
                    </div>

                    <div class="principle-card" data-color="#E4FF36">
                        <div class="principle-icon">
                            <img src="{{ asset('img/icons/create-open-data.svg') }}" alt="Reuse">
                        </div>
                        <p>{{ __('who_we_are.open_term.principle3') }}</p>
                    </div>

                    <div class="principle-card" data-color="#E077FF">
                        <div class="principle-icon">
                            <img src="{{ asset('img/icons/collaboration.svg') }}" alt="No restrictions">
                        </div>
                        <p>{{ __('who_we_are.open_term.principle4') }}</p>
                    </div>
                </div>

                <p class="term-conclusion">{{ __('who_we_are.open_term.conclusion') }}</p>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-detailed-section">
        <div class="content-container">
            <div class="section-header-large">
                <img src="{{ asset('img/icons/mission.svg') }}" alt="Values" class="section-icon-large">
                <h2>{{ __('who_we_are.values.title') }}</h2>
            </div>

            <div class="values-intro">
                <p class="lead-text">{{ __('who_we_are.values.intro') }}</p>
            </div>

            <!-- Value Items -->
            <div class="value-items">
                @foreach(['open_knowledge', 'respect', 'collaboration', 'realistic', 'doing', 'achieving_change'] as $valueKey)
                <div class="value-item">
                    <h3>{{ __("who_we_are.values.{$valueKey}_title") }}</h3>
                    <p>{{ __("who_we_are.values.{$valueKey}_text") }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Organization Section -->
    <section class="organization-section">
        <div class="content-container">
            <div class="org-box">
                <div class="org-icon">
                    <img src="{{ asset('img/icons/board.svg') }}" alt="Organization">
                </div>
                <div class="org-content">
                    <h2>{{ __('who_we_are.organization.title') }}</h2>
                    <p>{{ __('who_we_are.organization.text') }}</p>
                </div>
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