@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <nav class="hidden lg:block bg-white py-3 mt-[116px] border-b">
        <div class="mx-auto max-w-7xl px-3 sm:px-6 lg:px-8">
            <nav class="flex flex-nowrap overflow-x-auto whitespace-nowrap hide-scrollbar" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-1.5 md:space-x-4">
                    <li>
                        <div>
                            <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-4 w-4 md:h-5 md:w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="h-4 w-4 md:h-5 md:w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                            <a href="{{ route('projects.index') }}" class="ml-1 md:ml-4 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-700">Tin tức & Sự kiện</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </nav>

    <!-- News Section -->
    <section class="py-12 md:py-8 mt-[70px]">
        <h1 class="text-3xl font-bold text-center mb-12">Tin tức</h1>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8" id="newsExten">
                @foreach($news as $item)
                    <article class="bg-white/80 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group h-[500px]">
                        <a href="{{ route('news.show', $item) }}" class="block h-full overflow-hidden bg-gray-100 relative">
                            <!-- @if($item->image && !empty(trim($item->image))) -->
                                <img src="{{ $item->image }}" alt="{{ $item->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <!-- @endif -->
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/75 to-transparent opacity-60 transition-all duration-500 group-hover:opacity-75"></div>
                            <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-transparent opacity-30 mix-blend-overlay"></div>
                            <!-- Content Overlay -->
                            <div class="absolute bottom-0 left-0 right-0 p-10 transform transition-transform duration-500 group-hover:translate-y-[-8px]">
                                <span class="text-blue-100 text-sm font-medium mb-4 inline-block opacity-0 group-hover:opacity-100 transition-opacity duration-500">Tin tức mới</span>
                                <h3 class="font-bold text-2xl text-white line-clamp-3 mb-4 group-hover:text-blue-100 transition-colors">
                                    {{ $item->title }}
                                </h3>
                                <div class="flex items-center text-gray-200 text-sm opacity-90 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $item->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                <button class="load-more-btn px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                    Tải thêm
                </button>
                <div class="loading-indicator hidden flex items-center gap-2">
                    <div class="w-6 h-6 border-2 border-t-primary border-r-transparent border-b-transparent border-l-transparent rounded-full animate-spin"></div>
                    <span class="text-gray-600">Đang tải...</span>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
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
                    url: `/news/load-more?page=${page + 1}`,
                    method: 'GET',
                    success: function(response) {
                        if (response.html) {
                            $('#newsExten').append(response.html);
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
