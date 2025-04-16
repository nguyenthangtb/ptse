@extends('layouts.app')

@section('content')
<div class="pt-[72px] md:pt-[116px]">
    <!-- Mobile Title -->
    <div class="block lg:hidden mt-[100px] mb-8">
        <h1 class="text-3xl font-bold text-center">Giải pháp</h1>
    </div>

    <!-- Breadcrumb -->
    <nav class="hidden lg:block bg-white py-3 !mt-[130px] border-b">
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
                            <span class="ml-2 md:ml-4 text-sm font-medium text-gray-500" aria-current="page">Giải pháp</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </nav>

    <!-- Solutions Section -->
    <section class="py-0">
        <!-- Desktop Title -->
        <h1 class="hidden lg:block text-3xl font-bold text-center mb-12 mt-8">Giải pháp</h1>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Solutions List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="solutionExten">
                @foreach($solutions as $solution)
                    <article class="bg-white rounded-xl shadow-sm overflow-hidden group hover:shadow-md transition-all">
                        <!-- Image Container -->
                        <div class="aspect-[4/3] w-full overflow-hidden">
                            @if($solution->image && !empty(trim($solution->image)))
                                <img src="{{ $solution->image }}"
                                     alt="{{ $solution->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    >
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                    <div class="relative w-16 h-16">
                                        <div class="absolute inset-0 border-4 border-t-primary border-r-transparent border-b-transparent border-l-transparent rounded-full animate-spin"></div>
                                        <div class="absolute inset-2 border-4 border-t-transparent border-r-primary border-b-transparent border-l-transparent rounded-full animate-spin-reverse"></div>
                                        <div class="absolute inset-[30%] bg-primary rounded-full opacity-50"></div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Content Container -->
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                {{ $solution->created_at->format('d/m/Y') }}
                            </div>
                            <h3 class="font-semibold text-xl mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('solutions.show', $solution->slug) }}">
                                    {{ $solution->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $solution->short_description }}</p>
                            <a href="{{ route('solutions.show', $solution->slug) }}"
                               class="inline-flex items-center text-sm text-primary hover:text-primary/80 font-medium">
                                Chi tiết
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                <button class="load-more-btn-solutions px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                    Tải thêm
                </button>
                <div class="loading-indicator hidden flex items-center gap-2">
                    <div class="w-6 h-6 border-2 border-t-primary border-r-transparent border-b-transparent border-l-transparent rounded-full animate-spin"></div>
                    <span class="text-gray-600">Đang tải...</span>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
   $(document).ready(function() {

        $('.load-more-btn-solutions').on('click', {page: 1}, function(e) {
            e.preventDefault();
            loadMore();
        });

       let page = 1;
       let loading = false;

       function loadMore() {
           if (loading) return;

           loading = true;
           $('.loading-indicator').show();
           $('.load-more-btn-solutions').hide();

           $.ajax({
               url: `/solutions/load-more?page=${page + 1}`,
               method: 'GET',
               success: function(response) {
                   if (response.html) {
                       $('#solutionExten').append(response.html);
                       page++;
                   }

                   if (!response.hasMore) {
                       $('.pagination-container').remove();
                   }
               },
               error: function(xhr, status, error) {
                   console.error('Error loading more solutions:', error);
               },
               complete: function() {
                   loading = false;
                   $('.loading-indicator').hide();
                   $('.load-more-btn-solutions').show();
               }
           });
       }

   });
</script>
@endsection
