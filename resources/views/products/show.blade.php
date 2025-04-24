@extends('layouts.app')

@section('content')
    <!-- Mobile Title (visible only on mobile) -->
    <div class="block lg:hidden pt-[100px] px-4">
        <h1 class="text-2xl font-bold text-center mt-8 mb-4">{{ $product->name }}</h1>
    </div>

    <!-- Breadcrumb -->
    <nav class="hidden lg:block bg-white py-3 mt-[116px] border-b">
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
                            <span class="ml-2 md:ml-4 text-sm font-medium text-gray-500 truncate max-w-[150px] md:max-w-none" aria-current="page">{{ $product->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </nav>

    <!-- Product Detail Section -->
    <section class="mt-4 lg:mt-0 py-6 md:py-8 px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto max-w-7xl bg-white rounded-xl shadow-lg backdrop-blur-sm bg-white/90 hover:shadow-xl transition-shadow p-4 md:p-8">
            <!-- Two Column Product Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12">
                <!-- Left Column - Product Images -->
                <div class="space-y-4">
                    <!-- Main Product Image -->
                    <div class="aspect-square overflow-hidden rounded-lg bg-gray-100">
                        <img id="mainImage" src="{{ $product->image }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Thumbnail Gallery -->
                    <div class="grid grid-cols-4 gap-2">
                        <button onclick="updateMainImage(this.children[0].src)" class="aspect-square rounded-lg overflow-hidden bg-gray-100 hover:ring-2 hover:ring-[#1E4ED8] focus:ring-2 focus:ring-[#1E4ED8]">
                            <img src="{{$product->image}}" alt="Product thumbnail" class="w-full h-full object-cover">
                        </button>
                        <button onclick="updateMainImage(this.children[0].src)" class="aspect-square rounded-lg overflow-hidden bg-gray-100 hover:ring-2 hover:ring-[#1E4ED8] focus:ring-2 focus:ring-[#1E4ED8]">
                            <img src="{{$product->image}}" alt="Product thumbnail" class="w-full h-full object-cover">
                        </button>
                        <button onclick="updateMainImage(this.children[0].src)" class="aspect-square rounded-lg overflow-hidden bg-gray-100 hover:ring-2 hover:ring-[#1E4ED8] focus:ring-2 focus:ring-[#1E4ED8]">
                            <img src="{{$product->image}}" alt="Product thumbnail" class="w-full h-full object-cover">
                        </button>
                        <button onclick="updateMainImage(this.children[0].src)" class="aspect-square rounded-lg overflow-hidden bg-gray-100 hover:ring-2 hover:ring-[#1E4ED8] focus:ring-2 focus:ring-[#1E4ED8]">
                            <img src="{{$product->image}}" alt="Product thumbnail" class="w-full h-full object-cover">
                        </button>
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
                        <h2 class="text-lg md:text-xl font-semibold">Tính năng sản phẩm</h2>
                        <ul class="space-y-2">
                            {!! $product->features !!}
                            {{-- <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#1E4ED8] mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Công suất: 0.75kW - 400kW</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#1E4ED8] mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Lưu lượng: 2 - 2000 m³/h</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#1E4ED8] mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Cột áp: 5 - 100m</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#1E4ED8] mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Vật liệu: Gang, Inox 304, Inox 316</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#1E4ED8] mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Chứng nhận: CE, ISO 9001:2015</span>
                            </li> --}}
                        </ul>
                    </div>

                    <!-- Contact Button -->
                    <div class="pt-4">
                        <a href="#" class="w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-[#1E4ED8] text-white font-medium rounded-lg hover:bg-[#1E4ED8]/90 transition-colors">
                            Liên hệ tư vấn
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile Tabs for Specs and Description -->
            <div class="mt-8 lg:hidden">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px" aria-label="Tabs">
                        <button type="button"
                                class="mobile-tab-btn active w-1/2 py-4 px-1 text-center border-b-2 border-[#1E4ED8] text-[#1E4ED8] font-medium"
                                data-target="mobile-description">
                            Mô tả
                        </button>
                        <button type="button"
                                class="mobile-tab-btn w-1/2 py-4 px-1 text-center border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium"
                                data-target="mobile-specs">
                            Thông số & Tài liệu
                        </button>
                    </nav>
                </div>

                <div class="mobile-tab-content mt-4">
                    <!-- Mobile Description Tab Content -->
                    <div id="mobile-description" class="mobile-tab-panel block">
                        <div class="prose prose-sm">
                            {!! $product->description !!}
                        </div>
                        <div class="mt-4 text-center">
                            <button id="mobile-show-more"
                                    class="text-[#1E4ED8] hover:text-[#1E4ED8]/90 text-sm font-medium flex items-center mx-auto border border-[#1E4ED8] px-4 py-2 rounded-lg">
                                Xem thêm
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Mobile Specs Tab Content -->
                    <div id="mobile-specs" class="mobile-tab-panel hidden">
                        <div class="space-y-6">
                            <!-- Specifications Section -->
                            <div class="border rounded-lg bg-white">
                                <div class="p-4">
                                    <h2 class="text-lg font-semibold">Thông số chi tiết</h2>
                                </div>
                                <div class="divide-y">
                                    @if($product->specifications && is_array($product->specifications))
                                    @foreach($product->specifications as $spec)
                                        <div class="grid grid-cols-3 py-3 px-4">
                                            <dt class="text-sm font-medium text-gray-500 col-span-1">{{ $spec['label'] ?? '' }}</dt>
                                            <dd class="text-sm text-gray-900 col-span-2">{{ $spec['value'] ?? '' }}</dd>
                                        </div>
                                    @endforeach
                                    @else
                                        <div class="py-3 px-4">
                                            <p class="text-sm text-gray-500">Không có thông số chi tiết</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Documents Section - Mobile -->
                            <div class="border rounded-lg bg-white mt-4">
                                <div class="p-4">
                                    <h2 class="text-lg font-semibold">Tài liệu</h2>
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
                                                            Tải xuống
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="py-3 px-4">
                                            <p class="text-sm text-gray-500">Không có tài liệu</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Two-Column Content -->
            <div class="hidden lg:grid grid-cols-1 lg:grid-cols-12 gap-6 mt-12">
                <!-- Left Column - Description -->
                <div class="col-span-1 lg:col-span-7">
                    <div class="border rounded-lg bg-white">
                        <!-- Tab Navigation -->
                        <div class="border-b border-gray-200">
                            <nav class="flex" aria-label="Tabs">
                                <button type="button"
                                        class="tab-btn active py-4 px-1 w-full text-center border-b-2 border-[#1E4ED8] text-[#1E4ED8] font-medium text-sm"
                                        data-target="description-panel">
                                    Mô tả sản phẩm
                                </button>
                            </nav>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div id="description-panel" class="tab-panel block p-4 md:p-6">
                                <div id="product-description" class="prose prose-sm">
                                    {!! $product->description !!}
                                </div>
                                <div class="mt-4 text-center">
                                    <button id="show-more-btn"
                                            class="text-[#1E4ED8] hover:text-[#1E4ED8]/90 text-sm font-medium flex items-center mx-auto border border-[#1E4ED8] px-4 py-2 rounded-lg">
                                        Xem thêm
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Specifications Table -->
                <div class="col-span-1 lg:col-span-5">
                    <div class="border rounded-lg bg-white">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold">Thông số chi tiết</h2>
                        </div>
                        <div class="divide-y">
                            @if($product->specifications && is_array($product->specifications))
                            @foreach($product->specifications as $spec)
                                <div class="grid grid-cols-3 py-3 px-4">
                                    <dt class="text-sm font-medium text-gray-500 col-span-1">{{ $spec['label'] ?? '' }}</dt>
                                    <dd class="text-sm text-gray-900 col-span-2">{{ $spec['value'] ?? '' }}</dd>
                                </div>
                            @endforeach
                            @else
                                <div class="py-3 px-4">
                                    <p class="text-sm text-gray-500">Không có thông số chi tiết</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="border rounded-lg bg-white mt-4">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold">Tài liệu</h2>
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
                                                    Tải xuống
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="py-3 px-4">
                                    <p class="text-sm text-gray-500">Không có tài liệu</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products Section -->
            <div class="pt-10 mt-6 border-t">
                <h2 class="text-2xl font-semibold mb-6">Sản phẩm liên quan</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                            @if($product->image)
                                <img src="{{$product->image}}" alt="{{ $product->name }}" class="aspect-square w-full bg-gray-200 object-cover group-hover:opacity-75">
                            @else
                                <img src="https://placehold.co/800x400" alt="{{ $product->name }}" class="aspect-square w-full bg-gray-200 object-cover group-hover:opacity-75">
                            @endif
                            <div class="p-4">
                                <h3 class="text-sm font-semibold text-center text-gray-900">
                                    <a href="#" class="hover:text-[#1E4ED8]">
                                        {{ $product->name ?? 'Tên sản phẩm' }}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    @endfor
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
@push('scripts')
<script>
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
