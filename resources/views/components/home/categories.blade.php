<!-- Categories Section -->
<div id="categories" class="bg-gray-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl py-2 sm:py-24 lg:max-w-none lg:py-8">
            <h2 class="text-2xl font-bold text-center reveal uppercase">{{ __('common.product_category') }}</h2>
            <div class="mt-6 grid grid-cols-1 gap-y-4 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 xl:gap-x-4">
                @foreach($categories ?? [] as $category)
                    <a href="{{ route('products.category', $category) }}" class="group relative reveal transition-all duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-xl block">
                        @if($category->image)
                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full rounded-lg bg-white object-cover group-hover:opacity-75 max-sm:h-80 sm:aspect-2/1 lg:aspect-square transition-all duration-300">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100 rounded-lg max-sm:h-80 sm:aspect-2/1 lg:aspect-square">
                            <span>{{ __('common.image') }}</span>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/50 to-transparent rounded-lg flex flex-col justify-end p-6 transform transition-all duration-300">
                            <div class="flex items-end justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-white mb-2 transform transition-all duration-300 uppercase">
                                        {{ $category->name ?? __('common.product_category') }}
                                    </h3>
                                </div>
                                <div class="flex-shrink-0 ml-4">
                                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-white/20 transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white group-hover:translate-x-1 transition-transform">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Scroll Down Button -->
    <div class="text-center pb-8">
        <a href="#featured-products"
           class="inline-flex flex-col items-center text-gray-600 hover:text-gray-900 transition-all duration-300 ease-in-out"
           onclick="event.preventDefault(); document.getElementById('featured-products').scrollIntoView({
               behavior: 'smooth',
               block: 'start',
               inline: 'nearest'
           })">
            <span class="text-sm font-medium mb-2 hover:transform hover:translate-y-1 transition-transform">{{ __('common.scroll_down') }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 animate-bounce transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </a>
    </div>
</div>
