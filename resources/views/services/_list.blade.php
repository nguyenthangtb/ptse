<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
    @foreach($services as $service)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 h-[400px]">
            <div class="aspect-w-9 aspect-h-16 relative overflow-hidden h-full">
                <img
                    src="{{ $service->thumbnail ? asset('storage/' . $service->thumbnail) : 'https://img.youtube.com/vi/' . $service->youtube_id . '/maxresdefault.jpg' }}"
                    alt="{{ $service->title }}"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                />

                <!-- Overlay đen mờ và text -->
                <div class="absolute inset-0 bg-black/50 group-hover:bg-black/40 transition-all duration-300">
                    <!-- Icon play - đã được căn giữa chính xác -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center bg-red-600 rounded-full">
                        <a href="javascript:void(0)"
                            onclick="openVideoModal('{{ $service->embed_url }}')"
                            class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        </a>
                    </div>

                    <!-- Text ở dưới -->
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-white text-lg font-semibold">
                            {{ $service->title }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>