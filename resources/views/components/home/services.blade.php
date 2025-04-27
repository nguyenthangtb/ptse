<!-- Video Services Section -->
<section class="py-8bg-gradient-to-b from-gray-100 to-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-4 mt-4 reveal uppercase">{{ __('common.services') }}</h2>

        @if($services && $services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($services->take(3) as $service)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 h-[400px]">
                        <div class="aspect-w-9 aspect-h-16 relative overflow-hidden h-full">
                            <img
                                src="{{ $service->thumbnail ? asset('storage/' . $service->thumbnail) : 'https://img.youtube.com/vi/' . $service->youtube_id . '/maxresdefault.jpg' }}"
                                alt="{{ $service->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            />
                            <!-- Play button overlay -->
                            <a href="javascript:void(0)"
                               onclick="openVideoModal('{{ $service->embed_url }}')"
                               class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-red-600 bg-opacity-80 rounded-full w-24 h-24 flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-500">{{ __('common.no_services') }}</p>
            </div>
        @endif
    </div>

    <!-- Video Modal -->
    <div id="videoModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-black bg-opacity-90 transition-opacity" onclick="closeVideoModal()"></div>
        <div class="relative bg-black rounded-lg overflow-hidden w-full max-w-6xl mx-auto h-[80vh]">
            <div class="absolute top-5 right-5 z-10">
                <button onclick="closeVideoModal()" class="bg-red-600 rounded-full p-3 text-white hover:bg-red-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="h-full w-full">
                <iframe id="videoFrame" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="w-full h-full"></iframe>
            </div>
        </div>
    </div>
</section>

<script>
    function openVideoModal(videoSrc) {
        // Thêm autoplay=1 vào URL
        if (videoSrc.indexOf('?') > 0) {
            videoSrc += '&autoplay=1';
        } else {
            videoSrc += '?autoplay=1';
        }

        document.getElementById('videoFrame').src = videoSrc;
        document.getElementById('videoModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // Ngăn scroll trang
    }

    function closeVideoModal() {
        document.getElementById('videoFrame').src = '';
        document.getElementById('videoModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Đóng modal khi nhấn phím ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeVideoModal();
        }
    });
</script>