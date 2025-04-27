<!-- Featured Products -->
<section id="featured-products" class="py-8 bg-secondary">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-center mb-5 reveal uppercase">{{ __('common.featured_products') }}</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($featuredProducts ?? [] as $product)
                <a href="{{ route('products.show', $product->slug) }}" class="group relative reveal block overflow-hidden rounded-md">
                    <div class="overflow-hidden">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                class="aspect-square w-full rounded-md bg-gray-200 object-cover transition-all duration-500
                                group-hover:scale-110 group-hover:rotate-1 lg:aspect-auto lg:h-80">
                        @else
                            <img src="https://placehold.co/800x400" alt="{{ $product->name }}"
                                class="aspect-square w-full rounded-md bg-gray-200 object-cover transition-all duration-500
                                group-hover:scale-110 group-hover:rotate-1 lg:aspect-auto lg:h-80">
                        @endif
                    </div>
                    <div class="mt-4">
                        <h3 class="text-[14px] font-bold text-center text-gray-700 capitalize group-hover:text-primary transition-colors">
                            {{ $product->name ?? __('common.product_name') }}
                        </h3>
                    </div>
                </a>
            @endforeach
        </div>
        {{-- <div class="text-center mt-16 reveal">
            <a href="/san-pham/danh-muc/bom-cong-nghiep" class="text-primary hover:underline inline-flex items-center">
                Xem tất cả sản phẩm <span class="ml-1">→</span>
            </a>
        </div> --}}
    </div>
</section>
