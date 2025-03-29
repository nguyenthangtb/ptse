@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <nav class="bg-white py-3">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Trang chủ</span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                            <a href="{{ route('products.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Sản phẩm</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-4 text-sm font-medium text-gray-500" aria-current="page">{{ $product->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </nav>
    <!-- Product Detail Section -->
    <section class="py-12 md:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 bg-white rounded-xl shadow-lg backdrop-blur-sm bg-white/90 hover:shadow-xl transition-shadow p-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-8">
                    <!-- Left Column - Product Images -->
                    <div class="col-span-5 space-y-4 max-w-md">
                        <!-- Main Product Image -->
                        <div class="aspect-square overflow-hidden rounded-lg bg-gray-100">
                            <img id="mainImage" src="{{ $product->image }}" alt="{{ $product->name }}" 
                                class="w-full h-full">
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

                    @push('scripts')
                    <script>
                        function updateMainImage(src) {
                            document.getElementById('mainImage').src = src;
                        }
                    </script>
                    @endpush
                    
                    <!-- Right Column - Product Details -->
                    <div class="col-span-7 space-y-6">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                        <div class="prose prose-sm text-gray-600">
                            {!! $product->short_description !!}
                        </div>
                        
                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold">Tính năng sản phẩm</h2>
                            <ul class="space-y-2">
                                <li class="flex items-start">
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
                                </li>
                            </ul>
                        </div>

                        <!-- Contact Button -->
                        <div class="pt-6">
                            <a href="#" class="inline-flex items-center px-6 py-3 bg-[#1E4ED8] text-white font-medium rounded-lg hover:bg-[#1E4ED8]/90 transition-colors">
                                Liên hệ tư vấn
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-12 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-8">
                    <!-- Left Column - Tabs -->
                    <div class="col-span-7">
                        <div class="border rounded-lg">
                            <div class="mb-4 border-b border-gray-200">
                                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="product-tabs" data-tabs-toggle="#product-tabs-content" role="tablist">
                                    <li class="flex-1" role="presentation">
                                        <button class="w-full p-4 border-b-2 rounded-t-lg text-[#1E4ED8] border-[#1E4ED8]" 
                                                id="description-tab" 
                                                data-tabs-target="#description" 
                                                type="button" 
                                                role="tab" 
                                                aria-controls="description" 
                                                aria-selected="true">
                                            Mô tả sản phẩm
                                        </button>
                                    </li>
                                    <li class="flex-1" role="presentation">
                                        <button class="w-full p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-700" 
                                                id="documents-tab" 
                                                data-tabs-target="#documents" 
                                                type="button" 
                                                role="tab" 
                                                aria-controls="documents" 
                                                aria-selected="false">
                                            Download tài liệu
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            
                            <div id="product-tabs-content">
                                <div class="p-4" 
                                    id="description" 
                                    role="tabpanel" 
                                    aria-labelledby="description-tab">
                                    <div class="prose prose-sm max-h-96 overflow-hidden">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                                <div class="hidden p-4 space-y-4" 
                                    id="documents" 
                                    role="tabpanel" 
                                    aria-labelledby="documents-tab">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <span class="text-sm font-medium">Catalogue.pdf</span>
                                        <a href="#" class="text-[#1E4ED8] hover:underline text-sm">Tải xuống</a>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <span class="text-sm font-medium">Hướng dẫn lắp đặt.pdf</span>
                                        <a href="#" class="text-[#1E4ED8] hover:underline text-sm">Tải xuống</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Expand Button -->
                            <div class="p-4 border-t flex justify-center">
                                <button onclick="expandContent()" 
                                        class="text-[#1E4ED8] hover:text-[#1E4ED8]/90 text-sm font-medium flex items-center border border-[#1E4ED8] px-4 py-2 rounded-lg">
                                    Mở rộng
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Specifications Table -->
                    <div class="col-span-5">
                        <div class="border rounded-lg">
                            <div class="p-4 border-b">
                                <h2 class="text-lg font-semibold">Thông số chi tiết</h2>
                            </div>
                            <div class="divide-y">
                                <div class="grid grid-cols-2 p-4 bg-white">
                                    <div class="text-sm text-gray-600">Model</div>
                                    <div class="text-sm font-medium">{{ $product->model }}</div>
                                </div>
                                <div class="grid grid-cols-2 p-4 bg-gray-50">
                                    <div class="text-sm text-gray-600">Xuất xứ</div>
                                    <div class="text-sm font-medium">{{ $product->origin }}</div>
                                </div>
                                <div class="grid grid-cols-2 p-4 bg-white">
                                    <div class="text-sm text-gray-600">Bảo hành</div>
                                    <div class="text-sm font-medium">12 tháng</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-12 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-semibold mb-4 text-center">Sản phẩm liên quan</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="group relative reveal">
                            @if($product->image)
                                <img src="{{$product->image}}" alt="{{ $product->name }}" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
                            @else
                                <img src="https://placehold.co/800x400" alt="{{ $product->name }}" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
                            @endif
                            <div class="mt-4">
                                <h3 class="text-[14px] font-bold text-center text-gray-700">
                                    <a href="#">
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

@endsection
@push('scripts')
<script>
    // Initialize the tabs
    const tabElements = [
        {
            id: 'description-tab',
            triggerEl: document.querySelector('#description-tab'),
            targetEl: document.querySelector('#description')
        },
        {
            id: 'documents-tab',
            triggerEl: document.querySelector('#documents-tab'),
            targetEl: document.querySelector('#documents')
        }
    ];

    // Create an array of objects with the tab elements
    const tabs = new Tabs(tabElements);
    tabs.show('description-tab');
</script>
@endpush
