<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('in_memory.title') }} - Open Knowledge Greece</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/in-memory.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>
<body>
    <!-- Hero Section -->
    <section class="memory-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="memorial-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                    <path d="M2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <h1>{{ __('in_memory.hero.title') }}</h1>
            <p class="hero-subtitle">{{ __('in_memory.hero.subtitle') }}</p>
            <div class="memorial-divider">
                <span>✦</span>
            </div>
        </div>
    </section>

    <!-- Memorial Content -->
    <section class="memorial-section">
        <div class="content-container">
            <!-- Person Info -->
            <div class="person-info">
                <div class="person-photo-main">
                    <img src="{{ asset('img/' . __('in_memory.person.main_photo')) }}" 
                         alt="{{ __('in_memory.person.name') }}"
                         onerror="this.onerror=null; this.src='{{ asset('img/people/placeholder.png') }}';">
                </div>
                
                <div class="person-details">
                    <h2 class="person-name">{{ __('in_memory.person.name') }}</h2>
                    <p class="person-years">{{ __('in_memory.person.years') }}</p>
                    <p class="person-role">{{ __('in_memory.person.role') }}</p>
                </div>
            </div>

            <!-- Tribute Text -->
            <div class="tribute-text">
                <div class="quote-mark">"</div>
                <div class="tribute-content">
                    @foreach(__('in_memory.tribute') as $paragraph)
                    <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
                <div class="quote-mark closing">"</div>
            </div>

            <!-- Image Carousel -->
            <div class="memories-carousel">
                <h3 class="carousel-title">{{ __('in_memory.carousel.title') }}</h3>
                
                <div class="carousel-container">
                    <button class="carousel-btn prev" id="prevBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>

                    <div class="carousel-track-container">
                        <div class="carousel-track" id="carouselTrack">
                            @foreach(__('in_memory.carousel.images') as $index => $image)
                            <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('img/' . $image['path']) }}" 
                                     alt="{{ $image['caption'] ?? '' }}"
                                     onerror="this.onerror=null; this.src='{{ asset('img/people/placeholder.png') }}';">
                                @if(isset($image['caption']))
                                <div class="slide-caption">{{ $image['caption'] }}</div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <button class="carousel-btn next" id="nextBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>

                <div class="carousel-indicators" id="carouselIndicators">
                    @foreach(__('in_memory.carousel.images') as $index => $image)
                    <button class="indicator {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></button>
                    @endforeach
                </div>
            </div>

            <!-- Legacy Section -->
            <div class="legacy-section">
                <h3>{{ __('in_memory.legacy.title') }}</h3>
                <div class="legacy-content">
                    @foreach(__('in_memory.legacy.points') as $point)
                    <div class="legacy-item">
                        <div class="legacy-icon">✦</div>
                        <p>{{ $point }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Back Button -->
            <div class="back-button-container">
                <a href="{{ route('our-team', ['locale' => app()->getLocale()]) }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    {{ __('in_memory.back_button') }}
                </a>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.getElementById('carouselTrack');
            const slides = document.querySelectorAll('.carousel-slide');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const indicators = document.querySelectorAll('.indicator');
            
            let currentSlide = 0;
            const totalSlides = slides.length;

            function updateCarousel() {
                // Update slides
                slides.forEach((slide, index) => {
                    slide.classList.remove('active');
                    if (index === currentSlide) {
                        slide.classList.add('active');
                    }
                });

                // Update indicators
                indicators.forEach((indicator, index) => {
                    indicator.classList.remove('active');
                    if (index === currentSlide) {
                        indicator.classList.add('active');
                    }
                });

                // Move track
                const offset = -currentSlide * 100;
                track.style.transform = `translateX(${offset}%)`;
            }

            nextBtn.addEventListener('click', function() {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateCarousel();
            });

            prevBtn.addEventListener('click', function() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                updateCarousel();
            });

            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', function() {
                    currentSlide = index;
                    updateCarousel();
                });
            });

            // Auto-play (optional)
            setInterval(function() {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateCarousel();
            }, 5000);

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    prevBtn.click();
                } else if (e.key === 'ArrowRight') {
                    nextBtn.click();
                }
            });
        });
    </script>
</body>
</html>