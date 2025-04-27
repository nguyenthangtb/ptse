@extends('layouts.app')

@section('content')
<div class="pt-[72px] md:pt-[116px]">
    <!-- Mobile Title -->
    <div class="block lg:hidden mt-[120px] mb-8">
        <h1 class="text-3xl font-bold text-center">{{ __('common.news') }}</h1>
    </div>
    <!-- News Section -->
    <section class="py-4 mt-8">
        <!-- Desktop Title -->
        <h1 class="hidden lg:block text-3xl font-bold text-center mb-12">{{ __('common.news') }}</h1>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 ">
            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8" id="newsExten">
                @foreach($news as $item)
                    <article class="bg-white/80 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group h-[500px]">
                        <a href="{{ route('news.show', $item) }}" class="block h-full overflow-hidden bg-gray-100 relative">
                            <img src="{{ $item->image }}" alt="{{ $item->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/75 to-transparent opacity-60 transition-all duration-500 group-hover:opacity-75"></div>
                            <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-transparent opacity-30 mix-blend-overlay"></div>
                            <!-- Content Overlay -->
                            <div class="absolute bottom-0 left-0 right-0 p-10 transform transition-transform duration-500 group-hover:translate-y-[-8px]">
                                <span class="text-blue-100 text-sm font-medium mb-4 inline-block opacity-0 group-hover:opacity-100 transition-opacity duration-500">{{ __('common.new_news') }}</span>
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
