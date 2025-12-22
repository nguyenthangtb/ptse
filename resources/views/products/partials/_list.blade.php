@foreach($products as $product)
    <a href="{{ route('products.show', $product->slug) }}" title="{{ $product->name }}">
        <div class="group relative reveal">
            @if($product->image)
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80 cursor-pointer">
            @else
                <img src="https://placehold.co/800x400" alt="{{ $product->name }}" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80 cursor-pointer">
            @endif
            <div class="mt-4">
                <h3 class="text-[14px] font-bold text-center text-gray-700">
                    <span class="hover:text-[#1E4ED8] transition-colors">
                        {{ $product->name ?? __('common.product_name') }}
                    </span>
                </h3>
            </div>
        </div>
    </a>
@endforeach