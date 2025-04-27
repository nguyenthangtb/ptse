@extends('layouts.app')

@section('content')
<div class="pt-[72px] md:pt-[116px]">
    <!-- Mobile Title -->
    <div class="block lg:hidden mt-[120px] mb-8">
        <h1 class="text-3xl font-bold text-center">{{ __('common.projects') }}</h1>
    </div>

    <!-- Breadcrumb -->
    {{-- <nav class="hidden lg:block bg-white py-3 !mt-[130px] border-b">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-nowrap overflow-x-auto whitespace-nowrap hide-scrollbar" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-2 md:space-x-4">
                    <li>
                        <div>
                            <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <a href="{{ route('products.index') }}" class="ml-2 md:ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Dự án</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </nav> --}}

    <!-- Projects Section -->
    <section class="py-6 mt-8">
        <!-- Desktop Title -->
        <h1 class="hidden lg:block text-3xl font-bold text-center mb-12">{{ __('common.projects') }}</h1>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="projectExten">
                @foreach($projects as $project)
                    <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all group">
                        <div class="h-64 overflow-hidden rounded-t-lg">
                            <a href="{{ route('projects.show', $project->slug) }}" class="block h-full">
                                @if($project->image)
                                    <img src="{{ $project->image }}"
                                         alt="{{ $project->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @endif
                            </a>
                        </div>
                        <div class="p-6">
                            <h3 class="font-semibold text-xl mb-3 group-hover:text-primary transition-colors">
                                <a href="{{ route('projects.show', $project->slug) }}">
                                    {{ $project->title }}
                                </a>
                            </h3>
                            <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                                @if($project->client)
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        {{ $project->client }}
                                    </div>
                                @endif
                                @if($project->location)
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        {{ $project->location }}
                                    </div>
                                @endif
                            </div>
                            <p class="text-gray-600 line-clamp-3 mb-4">{{ $project->short_description }}</p>
                            <a href="{{ route('projects.show', $project->slug) }}"
                               class="inline-flex items-center text-sm text-primary hover:text-primary/80 font-medium">
                                {{ __('common.read_more') }}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Load More -->
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
                    url: `/projects/load-more?page=${page + 1}`,
                    method: 'GET',
                    success: function(response) {
                        if (response.html) {
                            $('#projectExten').append(response.html);
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
