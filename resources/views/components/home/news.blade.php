<!-- News Section -->
<section class="py-4">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-center mb-5 reveal uppercase">Tin tức & sự kiện</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($news ?? [] as $article)
                <a href="{{ route('news.show', $article) }}" class="group relative bg-secondary rounded-lg shadow-md overflow-hidden reveal block transform transition-all duration-500 hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative h-[300px] sm:h-[350px] overflow-hidden">
                        @if($article->image)
                            <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition-all duration-700 ease-in-out group-hover:scale-110 group-hover:rotate-1">
                        @else
                            <img src="https://placehold.co/800x400" alt="{{ $article->title }}" class="w-full h-full object-cover transition-all duration-700 ease-in-out group-hover:scale-110 group-hover:rotate-1">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent transition-opacity duration-300 group-hover:opacity-80"></div>
                        <div class="absolute bottom-0 p-4 text-white transform transition-all duration-300 group-hover:translate-y-[-5px]">
                            <h3 class="font-medium text-lg mb-1">{{ $article->title ?? 'Tiêu đề bài viết' }}</h3>
                            <p class="text-sm text-gray-200 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Xem chi tiết</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
