<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('our_team.title') }} - Open Knowledge Greece</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/our-team.css') }}">
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
                    <a href="#about" class="nav-link">{{ __('home.nav.about') }} <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.our_mission') }}</a>
                        <a href="{{ route('vision-and-values', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.who_we_are') }}</a>
                        <a href="{{ route('our-impact', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.our_impact') }}</a>
                    </div>
                </div>
                <div class="nav-item has-dropdown">
                    <a href="#team" class="nav-link">{{ __('home.nav.who_we_are2') }} <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('our-team', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.team') }}</a>
                        <a href="{{ route('board-of-directors', ['locale' => app()->getLocale()]) }}" class="dropdown-item">{{ __('home.nav.board') }}</a>
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
                <a href="./blog" class="blog-btn">{{ __('home.nav.blog') }}</a>
                <div class="lang-switcher">
                    <a href="{{ route('our-team', ['locale' => 'en']) }}" class="lang-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        <img src="{{ asset('img/uk-flag.png') }}" alt="English" class="flag-icon">
                        EN
                    </a>
                    <a href="{{ route('our-team', ['locale' => 'el']) }}" class="lang-link {{ app()->getLocale() == 'el' ? 'active' : '' }}">
                        <img src="{{ asset('img/gr-flag.png') }}" alt="Ελληνικά" class="flag-icon">
                        EL
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="team-hero">
        <div class="hero-background">
            <div class="hero-shape shape-1"></div>
            <div class="hero-shape shape-2"></div>
            <div class="hero-shape shape-3"></div>
        </div>

        <div class="hero-content">
            <div class="hero-badge">
                <img src="{{ asset('img/icons/connect-community.svg') }}" alt="Team">
                <span>{{ __('our_team.hero.badge') }}</span>
            </div>

            <h1>{{ __('our_team.hero.title') }}</h1>
            <p class="hero-lead">{{ __('our_team.hero.subtitle') }}</p>
        </div>
    </section>

    <!-- Team Grid Section -->
    <section class="team-section">
        <div class="content-container">
            <div class="team-intro">
                <h2>{{ __('our_team.intro.title') }}</h2>
                <p>{{ __('our_team.intro.text') }}</p>
            </div>

            <div class="team-grid">
                @foreach(__('our_team.members') as $member)
                <div class="team-member">
                    <div class="member-image-wrapper">
                        <div class="member-image">
                            <img src="{{ asset('img/' . $member['image']) }}" alt="{{ $member['name'] }}" onerror="this.src='{{ asset('img/people/placeholder.png') }}'">
                        </div>
                        <div class="member-overlay">
                            <div class="social-links">
                                @if(isset($member['social']['twitter']) && $member['social']['twitter'])
                                <a href="{{ $member['social']['twitter'] }}" target="_blank" rel="noopener" class="social-btn">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
                                    </svg>
                                </a>
                                @endif

                                @if(isset($member['social']['linkedin']) && $member['social']['linkedin'])
                                <a href="{{ $member['social']['linkedin'] }}" target="_blank" rel="noopener" class="social-btn">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z" />
                                        <circle cx="4" cy="4" r="2" />
                                    </svg>
                                </a>
                                @endif

                                @if(isset($member['social']['github']) && $member['social']['github'])
                                <a href="{{ $member['social']['github'] }}" target="_blank" rel="noopener" class="social-btn">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22" />
                                    </svg>
                                </a>
                                @endif

                                @if(isset($member['social']['email']) && $member['social']['email'])
                                <a href="mailto:{{ $member['social']['email'] }}" class="social-btn">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                        <polyline points="22,6 12,13 2,6" />
                                    </svg>
                                </a>
                                @endif

                                @if(isset($member['social']['website']) && $member['social']['website'])
                                <a href="{{ $member['social']['website'] }}" target="_blank" rel="noopener" class="social-btn">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="2" y1="12" x2="22" y2="12" />
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                                    </svg>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="member-info">
                        <h3 class="member-name">{{ $member['name'] }}</h3>
                        <p class="member-role">{{ $member['role'] }}</p>
                        <p class="member-bio">{{ $member['bio'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Volunteers Section -->
    <section class="volunteers-section">
        <div class="content-container">
            <div class="volunteers-intro">
                <h2>{{ __('our_team.volunteers.title') }}</h2>
                <p>{{ __('our_team.volunteers.text') }}</p>
            </div>

            <div class="volunteers-grid">
                @php
                $volunteers = __('our_team.volunteer_members');
                // Convert to array if it's not already
                if (!is_array($volunteers)) {
                $volunteers = [];
                }
                @endphp

                @if(empty($volunteers))
                <p>No volunteers found.</p>
                @else
                @foreach($volunteers as $index => $volunteer)
                <div class="volunteer-card" data-volunteer="{{ $index }}">
                    <div class="volunteer-image">
                        <img src="{{ asset('img/' . ($volunteer['image'] ?? 'people/placeholder.png')) }}"
                            alt="{{ $volunteer['name'] ?? 'Volunteer' }}"
                            onerror="this.onerror=null; this.src='{{ asset('img/people/placeholder.png') }}';">
                        <div class="volunteer-overlay">
                            <span class="view-bio-text">{{ __('our_team.volunteers.view_bio') }}</span>
                        </div>
                    </div>
                    <h3 class="volunteer-name">{{ $volunteer['name'] ?? 'Volunteer' }}</h3>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Volunteer Bio Modal -->
    <div class="modal-overlay" id="volunteerModal">
        <div class="modal-container">
            <button class="modal-close" id="closeModal">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <div class="modal-content">
                <div class="modal-image">
                    <img id="modalImage" src="" alt="">
                </div>
                <div class="modal-info">
                    <h2 id="modalName"></h2>
                    <p class="modal-role" id="modalRole"></p>
                    <div class="modal-bio" id="modalBio"></div>

                    <div class="modal-social" id="modalSocial">
                        <!-- Social links will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- In Memory Section -->
    <section class="in-memory-teaser">
        <div class="content-container">
            <div class="memory-teaser-content">
                <div class="memory-teaser-icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                        <path d="M2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <h3>{{ __('our_team.in_memory_teaser.title') }}</h3>
                <p>{{ __('our_team.in_memory_teaser.text') }}</p>
                <a href="{{ route('in-memory', ['locale' => app()->getLocale()]) }}" class="btn-memory">
                    {{ __('our_team.in_memory_teaser.button') }}
                </a>
            </div>
        </div>
    </section>

    <!-- Join Team CTA -->
    <section class="join-team-section">
        <div class="content-container">
            <div class="join-content">
                <div class="join-icon">
                    <img src="{{ asset('img/icons/collaboration.svg') }}" alt="Join">
                </div>
                <h2>{{ __('our_team.join.title') }}</h2>
                <p>{{ __('our_team.join.text') }}</p>
                <a href="#contact" class="btn-join">{{ __('our_team.join.button') }}</a>
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
            // Mobile menu toggle
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

            // Volunteer Modal
            const volunteers = {!! json_encode(__('our_team.volunteer_members')) !!};
            const modal = document.getElementById('volunteerModal');
            const closeModal = document.getElementById('closeModal');
            const volunteerCards = document.querySelectorAll('.volunteer-card');

            volunteerCards.forEach(card => {
                card.addEventListener('click', function() {
                    const index = this.dataset.volunteer;
                    const volunteer = volunteers[index];

                    if (!volunteer) return;

                    // Set modal content
                    document.getElementById('modalImage').src = '{{ asset("img") }}/' + volunteer.image;
                    document.getElementById('modalImage').alt = volunteer.name;
                    document.getElementById('modalName').textContent = volunteer.name;
                    document.getElementById('modalRole').textContent = volunteer.role;
                    document.getElementById('modalBio').textContent = volunteer.bio;

                    // Add social links
                    const socialContainer = document.getElementById('modalSocial');
                    socialContainer.innerHTML = '';

                    if (volunteer.social) {
                        if (volunteer.social.twitter) {
                            socialContainer.innerHTML += `
                            <a href="${volunteer.social.twitter}" target="_blank" rel="noopener">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
                                </svg>
                            </a>
                        `;
                        }
                        if (volunteer.social.linkedin) {
                            socialContainer.innerHTML += `
                            <a href="${volunteer.social.linkedin}" target="_blank" rel="noopener">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/>
                                    <circle cx="4" cy="4" r="2"/>
                                </svg>
                            </a>
                        `;
                        }
                        if (volunteer.social.github) {
                            socialContainer.innerHTML += `
                            <a href="${volunteer.social.github}" target="_blank" rel="noopener">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22"/>
                                </svg>
                            </a>
                        `;
                        }
                        if (volunteer.social.email) {
                            socialContainer.innerHTML += `
                            <a href="mailto:${volunteer.social.email}">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                            </a>
                        `;
                        }
                    }

                    // Show modal
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
            });

            // Close modal
            closeModal.addEventListener('click', function() {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            });

            // Close on overlay click
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });

            // Close on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.classList.contains('active')) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
</body>

</html>