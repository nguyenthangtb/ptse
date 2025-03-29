@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <nav class="bg-white py-3 mt-[72px] md:mt-[116px] border-b">
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
                            <a href="{{ route('products.index') }}" class="ml-2 md:ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Sản phẩm</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2 md:ml-4 text-sm font-medium text-gray-500" aria-current="page">{{ $category->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </nav>

    @include('products.partials.list-category')

    <!-- Products Section -->
    <section class="py-12 md:py-2">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Product Category Title -->
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $category->name }}</h1>

            <!-- Product Description -->
            <div class="mb-8">
                <p class="text-gray-600 mb-4">
                   {{ $category->short_description}}
                </p>
            </div>

            <!-- Filter and Sort -->
            <div class="flex justify-between items-center mb-6">
                <div class="text-sm text-gray-500"></div>
                <div class="text-sm">
                    <select class="border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Thứ tự mặc định</option>
                        <option>Giá: Thấp đến cao</option>
                        <option>Giá: Cao đến thấp</option>
                        <option>Mới nhất</option>
                    </select>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6" id="products-container">
                @foreach($products as $product)
                    <div class="group relative reveal">
                        @if($product->image)
                            <img src="{{$product->image}}" alt="{{ $product->name }}" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
                        @else
                            <img src="https://placehold.co/800x400" alt="{{ $product->name }}" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
                        @endif
                        <div class="mt-4">
                            <h3 class="text-[14px] font-bold text-center text-gray-700">
                                <a href="{{ route('products.show', $product->slug) }}" class="hover:text-[#1E4ED8] transition-colors">
                                    {{ $product->name ?? 'Tên sản phẩm' }}
                                </a>
                            </h3>
                        </div>
                    </div>
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
            <!-- Additional Product Information -->
            <div class="mt-12 prose prose-lg max-w-none">
                <div class="bg-white rounded-lg p-6">
                    {!! str($category->description)->sanitizeHtml() !!}
                </div>
            </div>
            <div class="flex justify-center mt-8">
                <a href="{{ route('lien-he') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-all duration-300 inline-flex items-center gap-2">
                    Liên hệ tư vấn
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            const categorySlug = '{{ $category->slug }}';
            
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
                    url: `/san-pham/${categorySlug}/?page=${page + 1}`,
                    method: 'GET',
                    success: function(response) {
                        if (response.html) {
                            $('#products-container').append(response.html);
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

