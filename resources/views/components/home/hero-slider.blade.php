<!-- Hero Section with Slider -->
<section class="relative min-h-[60vh] animate-fade-in">
    <!-- Image Slider -->
    <div class="swiper hero-slider h-full">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            @foreach ($sliders as $slider)
                <div class="swiper-slide overflow-hidden group">
                    <div class="w-full h-[60vh] bg-cover bg-center transition-all duration-700 ease-in-out group-hover:scale-110 group-hover:rotate-1" style="background-image: url('{{ asset('storage/' . $slider->image) }}')">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-700"></div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- Scroll Down Button -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-center z-20">
        <a href="#categories"
            class="inline-flex flex-col items-center text-white hover:text-gray-200 transition-all duration-300 ease-in-out"
            onclick="event.preventDefault(); document.getElementById('categories').scrollIntoView({
                behavior: 'smooth',
                block: 'start',
                inline: 'nearest'
            })">
            <span class="text-sm font-medium mb-2 hover:transform hover:translate-y-1 transition-transform">Cuộn xuống</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 animate-bounce transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </a>
    </div>
</section>
