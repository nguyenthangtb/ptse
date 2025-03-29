@foreach($products as $product)
    <div class="group relative reveal">
        @if($product->image)
            <img src="{{$product->image}}" alt="{{ $product->name }}" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
        @else
            <img src="https://placehold.co/800x400" alt="{{ $product->name }}" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
        @endif
        <div class="mt-4">
            <h3 class="text-[14px] font-bold text-center text-gray-700">
                <a href="{{ route('products.show', $product->slug) }}" class="hover:text-[#1E4ED8] transition-colors">
                    {{ $product->name ?? 'Tên sản phẩm' }}
                </a>
            </h3>
        </div>
    </div>
@endforeach