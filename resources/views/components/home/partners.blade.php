<div>
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
</div>

<!-- Partners Slider Section -->
<section class="py-8 bg-gradient-to-b from-blue-900 to-blue-800">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8 text-white reveal uppercase">{{ __('common.partners') }}</h2>

        <div class="partners-slider max-w-7xl mx-auto">
            <div class="swiper partnersSwiper">
                <div class="swiper-wrapper">
                    <!-- Display partners from database -->
                    @if($partners->count() > 0)
                        @foreach($partners as $partner)
                        <div class="swiper-slide partner-slide">
                            @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank" title="{{ $partner->name }}">
                            @endif
                                <div class="bg-white rounded p-4 mx-1 h-32 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="max-h-24 w-auto object-contain hover:scale-105 transition-all duration-300">
                                </div>
                            @if($partner->website_url)
                            </a>
                            @endif
                        </div>
                        @endforeach
                    @else
                       <div class="swiper-slide partner-slide">
                        <div class="bg-white rounded p-4 mx-1 h-32 flex items-center justify-center">
                            <p class="text-gray-500">{{ __('common.no_partners') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Swiper JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dynamically load Swiper
    if (!document.querySelector('link[href*="swiper-bundle.min.css"]')) {
        var swiperCss = document.createElement('link');
        swiperCss.rel = 'stylesheet';
        swiperCss.href = 'https://unpkg.com/swiper/swiper-bundle.min.css';
        document.head.appendChild(swiperCss);
    }

    // Load Swiper JS if not already loaded
    if (typeof Swiper === 'undefined') {
        var swiperScript = document.createElement('script');
        swiperScript.src = 'https://unpkg.com/swiper/swiper-bundle.min.js';
        swiperScript.onload = initSwiper;
        document.head.appendChild(swiperScript);
    } else {
        initSwiper();
    }

    function initSwiper() {
        var partnersSwiper = new Swiper('.partnersSwiper', {
            slidesPerView: 3,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 3,
                    spaceBetween: 10
                },
                // when window width is >= 768px
                768: {
                    slidesPerView: 4,
                    spaceBetween: 10
                },
                // when window width is >= 1024px
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 10
                }
            }
        });
    }
});
</script>

<style>
.partners-slider {
    position: relative;
    padding: 10px 0;
    overflow: hidden;
}

.partner-slide {
    height: auto;
    display: flex;
    justify-content: center;
}

/* Responsive */
@media (max-width: 768px) {
    .partner-slide .bg-white {
        height: 100px;
    }

    .partner-slide img {
        max-height: 60px;
    }
}
</style>
