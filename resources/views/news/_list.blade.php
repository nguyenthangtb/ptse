@foreach($news as $item)
    <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
    <a href="{{ route('news.show', $item) }}" class="block aspect-[4/3] overflow-hidden bg-gray-100 relative group">
            <img src="{{ $item->image }}" alt="{{ $item->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-60 transition-opacity group-hover:opacity-80"></div>
            <!-- Title Overlay -->
            <div class="absolute bottom-0 left-0 right-0 p-6">
                <h3 class="font-semibold text-lg text-white line-clamp-2">
                    {{ $item->title }}
                </h3>
            </div>
        </a>
    </article>
@endforeach