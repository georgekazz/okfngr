<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Open Knowledge Greece - Ανοικτή Γνώση Ελλάδας</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>

<body>
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

    <section class="hero">
        <div class="hero-content">
            <h1>{{ __('home.hero.title') }}</h1>
            <div class="mission-statements">
                <p class="mission-item bold">{{ __('home.hero.mission_1') }}</p>
                <p class="mission-item bold">{{ __('home.hero.mission_2') }}</p>
                <p class="mission-item">{{ __('home.hero.mission_3') }}</p>
                <p class="mission-item bold">{{ __('home.hero.mission_4') }}</p>
            </div>
        </div>
        <div class="hero-slider">
            <div class="slider-wrapper">
                <div class="slide active">
                    <img src="{{ asset('img/slides/frontpage_img_one.png') }}"
                        alt="Slide 1"
                        class="slide-image">
                    <div class="slide-overlay">
                        <h3>{{ __('home.slider.schools_title') }}</h3>
                        <p>{{ __('home.slider.schools_desc') }}</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('img/slides/frontpage_img_two.png') }}"
                        alt="Slide 1"
                        class="slide-image">
                    <div class="slide-overlay">
                        <h3>{{ __('home.slider.governance_title') }}</h3>
                        <p>{{ __('home.slider.governance_desc') }}</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('img/slides/frontpage_img_three.png') }}"
                        alt="Slide 1"
                        class="slide-image">
                    <div class="slide-overlay">
                        <h3>{{ __('home.slider.dbpedia_title') }}</h3>
                        <p>{{ __('home.slider.dbpedia_desc') }}</p>
                    </div>
                </div>

            </div>
            <div class="slider-dots">
                <span class="dot active" onclick="currentSlide(0)"></span>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
    </section>

    <section class="open-section">
        <h2>{{ __('home.open') }}</h2>
    </section>

    <section class="info-cards">
        <div class="info-card">
            <div class="info-card-icon">👥</div>
            <h3>{{ __('home.info.team_title') }}</h3>
            <p>{{ __('home.info.team_desc') }}</p>
            <a href="/new-team" class="info-card-btn">{{ __('home.info.explore') }}</a>
        </div>
        <div class="info-card">
            <div class="info-card-icon">🌍</div>
            <h3>{{ __('home.info.network_title') }}</h3>
            <p>{{ __('home.info.network_desc') }}</p>
            <a href="https://okfn.org/en/network/" class="info-card-btn">{{ __('home.info.explore') }}</a>
        </div>
        <div class="info-card">
            <div class="info-card-icon">🔬</div>
            <h3>{{ __('home.info.projects_title') }}</h3>
            <p>{{ __('home.info.projects_desc') }}</p>
            <a href="/research-projects" class="info-card-btn">{{ __('home.info.explore') }}</a>
        </div>
    </section>

    <section class="recent-posts">
        <div class="posts-container">
            <h2>{{ __('home.posts.title') }}</h2>
            <div class="posts-grid">
                @forelse($recentPosts as $post)
                <div class="post-card">
                    @if($post->featured_image)
                    <div class="post-card-image">
                        <a href="{{ route('posts.show', ['locale' => app()->getLocale(), 'post' => $post->slug]) }}">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                        </a>
                    </div>
                    @endif
                    <div class="post-card-content">
                        <div class="post-date">{{ $post->published_at->format('d F Y') }}</div>
                        <h3><a href="{{ route('posts.show', ['locale' => app()->getLocale(), 'post' => $post->slug]) }}">{{ $post->title }}</a></h3>
                        <p class="post-excerpt">{{ Str::limit($post->excerpt, 100) }}</p>
                        <a href="{{ route('posts.show', ['locale' => app()->getLocale(), 'post' => $post->slug]) }}" class="read-more">{{ __('home.posts.read_more') }} →</a>
                    </div>
                </div>
                @empty
                <div class="post-card">
                    <div class="post-card-content">
                        <p class="post-excerpt">{{ __('home.posts.no_posts') }}</p>
                    </div>
                </div>
                @endforelse
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
                <p>{!! __('home.footer.content', ['okfn_greece' => '<a href="https://okfn.gr/">' . __('home.footer.okfn_greece') . '</a>', 'okfn_international' => '<a href="https://okfn.org/">' . __('home.footer.okfn_international') . '</a>', 'license' => '<a href="https://creativecommons.org/licenses/by/4.0/">' . __('home.footer.license') . '</a>']) !!}</p>
                <p style="margin-top: 1rem;">{{ __('home.footer.copyright', ['year' => date('Y')]) }}</p>
            </div>
        </div>
    </footer>

    <script>
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            currentSlideIndex = index;
            if (currentSlideIndex >= slides.length) currentSlideIndex = 0;
            if (currentSlideIndex < 0) currentSlideIndex = slides.length - 1;
            slides[currentSlideIndex].classList.add('active');
            dots[currentSlideIndex].classList.add('active');
        }

        function currentSlide(index) {
            showSlide(index);
        }

        function nextSlide() {
            showSlide(currentSlideIndex + 1);
        }
        setInterval(nextSlide, 5000);

        function switchLanguage(locale) {
            fetch(`/language/${locale}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json()).then(data => {
                if (data.success) window.location.reload();
            }).catch(error => console.error('Error switching language:', error));
        }

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
                    
                    // Close other dropdowns
                    document.querySelectorAll('.nav-item.has-dropdown').forEach(otherItem => {
                        if (otherItem !== parent) {
                            otherItem.classList.remove('active');
                        }
                    });
                    
                    // Toggle current dropdown
                    parent.classList.toggle('active');
                }
            });
        });
    });
    </script>
</body>

</html>