<!-- Category Section -->
<section class="!mt-[130px] lg:!mt-[100px]">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-4">
            @foreach($categories as $category)
            <a href="{{ route('products.category', $category->slug) }}"
               class="group bg-white p-3 md:p-4 rounded-lg flex flex-col items-center text-center hover:bg-gray-50
               transition-all duration-300 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]
               hover:shadow-lg">
                <div class="bg-blue-50 p-2 md:p-3 rounded-lg mb-2 group-hover:bg-blue-100 transition-colors">
                    {!! $category->icon_path !!}
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-900 group-hover:text-blue-600">{{ $category->name ?? __('common.product_category') }}</h3>
                    <!-- <p class="text-xs text-gray-500">{{ $category->description }}</p> -->
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
