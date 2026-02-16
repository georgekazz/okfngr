<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Applications - Open Knowledge Greece</title>
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
                    <a href="{{ route('applications', ['locale' => 'en']) }}"
                        class="lang-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        <img src="{{ asset('img/uk-flag.png') }}" alt="English" class="flag-icon">
                        EN
                    </a>
                    <a href="{{ route('applications', ['locale' => 'el']) }}"
                        class="lang-link {{ app()->getLocale() == 'el' ? 'active' : '' }}">
                        <img src="{{ asset('img/gr-flag.png') }}" alt="Ελληνικά" class="flag-icon">
                        EL
                    </a>
                </div>
            </div>
        </div>
    </header>


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