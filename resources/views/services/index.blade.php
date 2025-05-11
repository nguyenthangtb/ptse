@extends('layouts.app')

@section('content')
<div class="pt-[72px] md:pt-[116px]">
    <!-- Mobile Title -->
    <div class="block lg:hidden mt-[120px] mb-8">
        <h1 class="text-3xl font-bold text-center">{{ __('common.services') }}</h1>
    </div>
    <!-- Services Section -->
    <section class="py-4 mt-8">
        <!-- Desktop Title -->
        <h1 class="hidden lg:block text-3xl font-bold text-center mb-12">{{ __('common.services') }}</h1>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 ">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" id="servicesExtend">
                @if($services && $services->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
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

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                <button class="load-more-btn px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                    {{ __('common.load_more') }}
                </button>
                <div class="loading-indicator hidden flex items-center gap-2">
                    <div class="w-6 h-6 border-2 border-t-primary border-r-transparent border-b-transparent border-l-transparent rounded-full animate-spin"></div>
                    <span class="text-gray-600">{{ __('common.loading') }}</span>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
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

    $(document).ready(function() {
        $('.load-more-btn').on('click', {page: 1}, function(e) {
            e.preventDefault();
            loadMore();
        });

        let page = 1;
        let loading = false;

        function loadMore() {
            if (loading) return;

            loading = true;
            $('.loading-indicator').show();
            $('.load-more-btn').hide();

            $.ajax({
                url: `/dich-vu/load-more?page=${page + 1}`,
                method: 'GET',
                success: function(response) {
                    if (response.html) {
                        $('#servicesExtend').append(response.html);
                        page++;
                    }

                    if (!response.hasMore) {
                        $('.load-more-btn').parent().remove();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading more solutions:', error);
                },
                complete: function() {
                    loading = false;
                    $('.loading-indicator').hide();
                    $('.load-more-btn').show();
                }
            });
        }
    });
</script>
@endsection
