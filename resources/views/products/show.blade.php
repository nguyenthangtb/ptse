@extends('layouts.app')

@section('title', $product->name)
@section('meta_description', $product->meta_description)
@section('meta_keywords', $product->meta_keywords)
@section('styles')
    <style>
        .content { font-size: 16px; line-height: 1.75; color: #111827; }
        .content h1,h2,h3 { font-weight: 700; line-height: 1.6; margin: 1.6em 0 .6em; }
        .content h1 { font-size: 2rem; }
        .content h2 { font-size: 1.5rem; }
        .content h3 { font-size: 1.25rem; }

        .content p { margin: 0 0 1.25em; }
        .content ul { list-style: disc; padding-left: 1.625em; margin: 0 0 1.25em; }
        .content ol { list-style: decimal; padding-left: 1.625em; margin: 0 0 1.25em; }
        .content li { margin: .5em 0; }
        .content img { max-width: 100%; height: auto; }
    </style>
@endsection
@section('content')
    <!-- Mobile Title (visible only on mobile) -->
    <div class="block lg:hidden pt-[170px] px-4">
        <h1 class="text-2xl font-bold text-center mt-8 mb-4">{{ $product->name }}</h1>
    </div>
    <!-- Product Detail Section -->
    <section class="mt-[20px] md:mt-[170px] py-6 md:py-8 px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto max-w-7xl bg-white rounded-xl shadow-lg backdrop-blur-sm bg-white/90 hover:shadow-xl transition-shadow p-4 md:p-8">
            <!-- Two Column Product Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12">
                <!-- Left Column - Product Images -->
                <div class="space-y-4">
                    <!-- Main Product Image -->
                    <div class="aspect-square overflow-hidden rounded-lg bg-gray-100">
                        <a href="{{ Storage::url($product->image) }}" data-lightbox="gallery" data-title="{{ $product->name }}">
                            <img id="mainImage" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover">
                        </a>
                    </div>

                    <!-- Thumbnail Gallery -->
                    <div class="grid grid-cols-4 gap-2">
                        @if($product->gallery)
                        @foreach($product->gallery as $image)
                            <a href="{{ Storage::url($image) }}" data-lightbox="gallery" data-title="{{ $product->name }}">
                                <img src="{{ Storage::url($image) }}" alt="Product thumbnail" class="w-full h-full object-cover">
                            </a>
                        @endforeach
                        @endif
                    </div>
                </div>

                <!-- Right Column - Product Details -->
                <div class="space-y-6">
                    <!-- Product Title (Hidden on mobile, shown on desktop) -->
                    <h1 class="hidden lg:block text-2xl md:text-3xl font-bold text-gray-900">{{ $product->name }}</h1>

                    <!-- Short Description -->
                    <div class="prose prose-sm text-gray-600">
                        {!! $product->short_description !!}
                    </div>

                    <!-- Product Features -->
                    <div class="space-y-3">
                        <h2 class="text-lg md:text-xl font-semibold">{{ __('common.product_features') }}</h2>
                        <ul class="space-y-2">
                            {!! $product->features !!}
                        </ul>
                    </div>

                    <!-- Contact Button -->
                    <div class="pt-4 space-y-3 md:space-y-0 md:flex md:space-x-3">
                        <!-- Zalo Button -->
                        <a href="https://zalo.me/{{ $config['connect_zalo'] }}" target="_blank" class="w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 transition-colors">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.0008 2C6.47831 2 2.00098 6.47733 2.00098 12C2.00098 17.5227 6.47831 22 12.0008 22C17.5234 22 22.0008 17.5227 22.0008 12C22.0008 6.47733 17.5234 2 12.0008 2ZM16.3174 15.7765C16.1921 15.9018 16.0385 15.9644 15.9131 15.9644C15.7877 15.9644 15.6341 15.9018 15.5088 15.7765L14.8174 15.0851C14.5667 15.3358 14.3161 15.5864 14.0654 15.8371C13.7582 16.1443 13.3883 16.193 13.0177 15.9906C11.9338 15.4008 10.9791 14.5856 10.1638 13.5767C9.34843 12.5678 8.78124 11.4423 8.47258 10.2116C8.36878 9.79082 8.49411 9.38158 8.83431 9.04138C9.0593 8.81639 9.28429 8.59141 9.50928 8.36642C9.63461 8.24109 9.76068 8.11502 9.88601 7.98969C10.1367 7.73898 10.1367 7.36611 9.88601 7.1154L8.71533 5.94472C8.46462 5.69401 8.09175 5.69401 7.84104 5.94472C7.5538 6.23196 7.25893 6.5164 6.98343 6.81126C6.75845 7.05106 6.63312 7.33753 6.60984 7.64785C6.58656 7.94654 6.58656 8.24524 6.60984 8.54393C6.84574 10.1447 7.4596 11.6594 8.42676 13.0489C9.39391 14.4383 10.6698 15.6309 12.2544 16.598C13.5388 17.3645 14.9348 17.8493 16.3591 18.0304C16.6161 18.0537 16.8731 18.053 17.1107 18.0297C17.3948 18.0064 17.6578 17.8811 17.8828 17.6561C18.1542 17.3847 18.4641 17.143 18.7355 16.8716C18.9862 16.6209 18.9862 16.2481 18.7355 15.9974L16.3174 15.7765Z"/>
                            </svg>
                            {{ __('common.connect_zalo') }}
                        </a>

                        <!-- Facebook Messenger Button -->
                        <a href="{{ $config['connect_facebook'] }}" target="_blank" class="w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-[#0084FF] text-white font-medium rounded-lg hover:bg-[#0084FF]/90 transition-colors">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C6.477 2 2 6.145 2 11.259C2 14.128 3.41 16.65 5.625 18.31V22L9.133 20.115C10.045 20.38 11.005 20.518 12 20.518C17.523 20.518 22 16.373 22 11.259C22 6.145 17.523 2 12 2ZM13.224 14.528L10.681 11.857L5.775 14.528L11.097 8.944L13.68 11.615L18.547 8.944L13.224 14.528Z"/>
                            </svg>
                            {{ __('common.connect_facebook') }}
                        </a>

                        <!-- Phone Button -->
                        <a href="tel: {{ $config['phone'] }}" class="w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            {{ __('common.call_phone') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class=" lg:grid grid-cols-1 lg:grid-cols-12 gap-6 mt-4 md:mt-12">
                <!-- Left Column - Description -->
                <div class="col-span-1 lg:col-span-7">
                    <div class="border rounded-lg bg-white">
                        <!-- Tab Navigation -->
                        <div class="border-b border-gray-200">
                            <nav class="flex" aria-label="Tabs">
                                <button type="button"
                                        class="tab-btn active py-4 px-1 w-full text-center border-b-2 border-[#1E4ED8] text-[#1E4ED8] font-medium text-sm"
                                        data-target="description-panel">
                                    {{ __('common.product_description') }}
                                </button>
                            </nav>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div id="description-panel" class="tab-panel block p-4 md:p-6">
                                <div id="product-description" class="prose prose-sm">
                                    {!! $product->description !!}
                                </div>
                                {{-- <div class="mt-4 text-center">
                                    <button id="show-more-btn"
                                            class="text-[#1E4ED8] hover:text-[#1E4ED8]/90 text-sm font-medium flex items-center mx-auto border border-[#1E4ED8] px-4 py-2 rounded-lg">
                                        {{ __('common.read_more') }}
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Specifications Table -->
                <div class="col-span-1 lg:col-span-5 mt-4 md:mt-0">
                    <div class="border rounded-lg bg-white">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold">{{ __('common.detailed_specifications') }}</h2>
                        </div>
                        <div class="divide-y">
                            @php
                                $currentLocale = app()->getLocale();
                                $specifications = $product->getTranslation('specifications', $currentLocale, false);
                            @endphp

                            @if($specifications && is_array($specifications))
                                @foreach($specifications as $spec)
                                    <div class="grid grid-cols-3 py-3 px-4">
                                        <dt class="text-sm font-medium text-gray-500 col-span-1">{{ $spec['label'] ?? '' }}</dt>
                                        <dd class="text-sm text-gray-900 col-span-2">{{ $spec['value'] ?? '' }}</dd>
                                    </div>
                                @endforeach
                            @else
                                <div class="py-3 px-4">
                                    <p class="text-sm text-gray-500">{{ __('common.no_detailed_specifications') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="border rounded-lg bg-white mt-4">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold">{{ __('common.documents') }}</h2>
                        </div>
                        <div class="divide-y">
                            @if($product->documents && is_array($product->documents))
                                @foreach($product->documentUrls as $document)
                                    @php
                                        $filename = $document['original_name'];
                                        $extension = $document['extension'];
                                        $fileIcon = match(strtolower($extension)) {
                                            'pdf' => '<svg class="w-6 h-6 text-red-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>',
                                            'doc', 'docx' => '<svg class="w-6 h-6 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>',
                                            'xls', 'xlsx' => '<svg class="w-6 h-6 text-green-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>',
                                            'zip', 'rar', '7z' => '<svg class="w-6 h-6 text-orange-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>',
                                            default => '<svg class="w-6 h-6 text-gray-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>'
                                        };
                                        $fileSize = $document['size'] > 0 ? round($document['size'] / 1024, 2) . ' KB' : '';
                                    @endphp
                                    <div class="py-3 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                {!! $fileIcon !!}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-bold text-gray-900 truncate">
                                                    {{ $filename }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ strtoupper($extension) }} {{ $fileSize ? ' · ' . $fileSize : '' }}
                                                </p>
                                            </div>
                                            <div>
                                                <a href="{{ $document['url'] }}"
                                                  class="inline-flex items-center px-3 py-1.5 border border-[#1E4ED8] rounded-lg text-xs font-medium text-[#1E4ED8] hover:bg-[#1E4ED8] hover:text-white transition-colors"
                                                  target="_blank">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                    </svg>
                                                    {{ __('common.download') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="py-3 px-4">
                                    <p class="text-sm text-gray-500">{{ __('common.no_documents') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products Section -->
            <div class="pt-5 mt-4 border-t md:mt-6">
                <h2 class="text-2xl font-semibold mb-6 text-center">{{ __('common.related_products') }}</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                            @if($relatedProduct->image)
                                <img src="{{ Storage::url($relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="aspect-square w-full bg-gray-200 object-cover group-hover:opacity-75">
                            @else
                                <img src="https://placehold.co/800x400" alt="{{ $relatedProduct->name }}" class="aspect-square w-full bg-gray-200 object-cover group-hover:opacity-75">
                            @endif
                            <div class="p-4">
                                <h3 class="text-sm font-semibold text-center text-gray-900">
                                    <a href="{{ route('products.show', $relatedProduct->slug) }}" class="hover:text-[#1E4ED8]">
                                        {{ $relatedProduct->name ?? __('common.product_name') }}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection
@push('styles')
<link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
@endpush
@push('scripts')
<script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    // Function to update main image
    function updateMainImage(src) {
        document.getElementById('mainImage').src = src;
    }

    // Mobile tab functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile tabs
        const mobileTabs = document.querySelectorAll('.mobile-tab-btn');
        const mobileTabPanels = document.querySelectorAll('.mobile-tab-panel');

        mobileTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                mobileTabs.forEach(t => {
                    t.classList.remove('active');
                    t.classList.remove('border-[#1E4ED8]');
                    t.classList.remove('text-[#1E4ED8]');
                    t.classList.add('border-transparent');
                    t.classList.add('text-gray-500');
                });

                // Add active class to clicked tab
                this.classList.add('active');
                this.classList.add('border-[#1E4ED8]');
                this.classList.add('text-[#1E4ED8]');
                this.classList.remove('border-transparent');
                this.classList.remove('text-gray-500');

                // Hide all panels
                mobileTabPanels.forEach(panel => {
                    panel.classList.add('hidden');
                    panel.classList.remove('block');
                });

                // Show target panel
                const targetId = this.getAttribute('data-target');
                const targetPanel = document.getElementById(targetId);
                if (targetPanel) {
                    targetPanel.classList.remove('hidden');
                    targetPanel.classList.add('block');
                }
            });
        });

        // Read more button
        const showMoreBtn = document.getElementById('show-more-btn');
        const mobileShowMore = document.getElementById('mobile-show-more');
        const productDescription = document.getElementById('product-description');

        function toggleDescription(button) {
            if (button) {
                button.addEventListener('click', function() {
                    productDescription.classList.toggle('max-h-[300px]');
                    productDescription.classList.toggle('overflow-hidden');

                    if (this.textContent.trim().startsWith('Xem thêm')) {
                        this.innerHTML = 'Thu gọn <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>';
                    } else {
                        this.innerHTML = 'Xem thêm <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
                    }
                });
            }
        }

        // Initialize product description with max height
        if (productDescription) {
            productDescription.classList.add('max-h-[300px]', 'overflow-hidden');
            toggleDescription(showMoreBtn);
            toggleDescription(mobileShowMore);
        }
    });
</script>
@endpush
