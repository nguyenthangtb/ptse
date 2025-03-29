<li class="relative group">
    <a href="{{ route('products.index') }}" class="flex items-center justify-between md:justify-start text-gray-700 hover:text-primary font-medium dropdown-toggle">
        SẢN PHẨM
        <i class="fas fa-chevron-down ml-2 text-xs"></i>
    </a>
    <ul class="dropdown-menu hidden group-hover:md:block md:absolute md:top-full md:left-0 md:bg-white md:min-w-[200px] md:shadow-lg md:rounded md:py-2 md:mt-1 z-50">
        @foreach($categories as $category)
            <li>
                @if($category->children->count() > 0)
                    <div class="relative group/sub">
                        <a href="{{ route('products.category', $category->slug) }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-primary">
                            {{ $category->name }}
                            <i class="fas fa-chevron-right float-right mt-1 text-xs"></i>
                        </a>
                        <ul class="hidden group-hover/sub:block absolute left-full top-0 bg-white min-w-[200px] shadow-lg rounded py-2">
                            @foreach($category->children as $child)
                                <li>
                                    <a href="{{ route('products.category', $child->slug) }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-primary">
                                        {{ $child->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <a href="{{ route('products.category', $category->slug) }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-primary">
                        {{ $category->name }}
                    </a>
                @endif
            </li>
        @endforeach
    </ul>
</li>
