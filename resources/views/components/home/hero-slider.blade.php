<div class="relative w-full bg-gray-900  animate-fade-in mt-[76px] md:mt-[156px]">
    <!-- Hero section with 3 images grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 min-h-[300px] md:h-[500px] lg:h-[600px]">
        @foreach ($sliders->take(3) as $index => $slider)
            <div class="relative h-[400px] md:h-full overflow-hidden group {{ $index > 0 ? 'hidden md:block' : '' }}">
                <!-- Image -->
                @if(!$slider->image)
                    <img
                        src="https://images.unsplash.com/photo-1531297484001-80022131f5a1?ixlib=rb-4.0.3"
                        alt="Industrial technology"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                    />
                @else
                    <img
                        src="{{ asset('storage/' . $slider->image) }}"
                        alt="{{ $slider->title }}"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                    />
                @endif

                <!-- Gradient overlay -->
                <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-black/20 to-black/60 group-hover:via-black/30 group-hover:to-black/70 transition-all duration-300"></div>

                <!-- Content overlay - Always visible on mobile, hover on desktop -->
                <div class="absolute inset-0 flex flex-col justify-end p-6 md:p-8 lg:p-10 text-white">
                    @if($slider->title)
                        <h2 class="text-3xl md:text-3xl lg:text-4xl font-bold mb-4 drop-shadow-lg
                            md:opacity-0 md:translate-y-4 md:group-hover:opacity-100 md:group-hover:translate-y-0
                            transition-all duration-500">
                            {{ $slider->title }}
                        </h2>
                    @endif

                    @if($slider->description)
                        <p class="text-lg md:text-lg mb-6 max-w-md drop-shadow-md
                            md:opacity-0 md:translate-y-4 md:group-hover:opacity-100 md:group-hover:translate-y-0
                            transition-all duration-500 delay-100
                            line-clamp-3 md:line-clamp-none">
                            {{ $slider->description }}
                        </p>
                    @endif

                    @if($slider->button_link)
                        <a
                            href="{{ $slider->button_link }}"
                            class="inline-block bg-green-600 hover:bg-green-500 text-white py-3.5 px-8 rounded-md
                                transition-all duration-300 w-fit text-lg font-medium
                                md:opacity-0 md:translate-y-4 md:group-hover:opacity-100 md:group-hover:translate-y-0
                                delay-200 shadow-lg hover:shadow-green-500/50
                                active:bg-green-700 touch-manipulation
                                hover:ring-2 hover:ring-green-400 hover:ring-offset-2 hover:ring-offset-black/50"
                        >
                            {{ $slider->button_text ?? 'Tìm hiểu thêm' }}
                        </a>
                    @endif
                </div>

                <!-- Touch overlay for mobile -->
                <div class="absolute inset-0 bg-transparent touch-manipulation md:hidden"></div>
            </div>
        @endforeach
    </div>

    <!-- Scroll Down Button -->
    {{-- <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-center z-20">
        <a href="#categories"
            class="inline-flex flex-col items-center text-white hover:text-green-400 transition-all duration-300 ease-in-out"
            onclick="event.preventDefault(); document.getElementById('categories').scrollIntoView({
                behavior: 'smooth',
                block: 'start',
                inline: 'nearest'
            })">
            <span class="text-base font-medium mb-2 hover:transform hover:translate-y-1 transition-transform drop-shadow-lg">Cuộn xuống</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 animate-bounce transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </a>
    </div> --}}
</div>

@push('styles')
<style>
    @keyframes fade-up {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush
