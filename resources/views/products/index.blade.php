@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <nav class="bg-white py-3">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary">Trang chủ</a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li>
                    <a href="{{ route('solutions.index') }}" class="text-gray-600 hover:text-primary">Sản phẩm</a>
                </li>
            </ol>
        </div>
    </nav>

    <!-- Products Section -->
    <section class="py-12 md:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 ">
            <!-- Product Category Title -->
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Bơm chống nghẹt</h1>

            <!-- Product Description -->
            <div class="mb-8">
                <p class="text-gray-600 mb-4">
                    Chúng tôi Bơm Thủy Nghiệm cung cấp đa dạng các loại máy bơm chống nghẹt cho công trình dân sự và chuyên
                    nghiệp từ các hãng uy tín trên thế giới. Máy bơm chống nghẹt có cấu tạo đặc biệt, được thiết kế để có thể
                    bơm được các chất lỏng có lẫn cặn bã, rác thải mà không bị tắc nghẽn. Đây là dòng sản phẩm rất cần thiết
                    trong các hệ thống xử lý nước thải.
                </p>
                <p class="text-gray-600">
                    Chúng tôi cung cấp nhiều loại máy bơm chống nghẹt phù hợp với từng nhu cầu sử dụng, bao gồm: bơm chìm nước
                    thải, bơm ly tâm trục ngang, bơm ly tâm trục đứng và các loại bơm công nghiệp khác. Tất cả sản phẩm đều
                    được nhập khẩu chính hãng và có đầy đủ giấy tờ CO, CQ.
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
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
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

            <!-- Additional Product Information -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Bơm chống nghẹt</h2>
                <p class="text-gray-600 mb-4">
                    Bơm chống nghẹt - Giải pháp hiệu quả cho hệ thống thoát nước và xử lý chất thải.
                </p>
                <p class="text-gray-600 mb-4">
                    Chúng tôi Bơm Thủy Nghiệm cung cấp đa dạng các loại máy bơm chống nghẹt cho công trình dân sự và chuyên
                    nghiệp từ các hãng uy tín trên thế giới. Máy bơm chống nghẹt có cấu tạo đặc biệt, được thiết kế để có thể
                    bơm được các chất lỏng có lẫn cặn bã, rác thải mà không bị tắc nghẽn. Đây là dòng sản phẩm rất cần thiết
                    trong các hệ thống xử lý nước thải.
                </p>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Ứng dụng của bơm chống nghẹt</h3>
                <ul class="list-disc pl-6 text-gray-600 space-y-2 mb-4">
                    <li>Bơm nước thải sinh hoạt, công nghiệp</li>
                    <li>Bơm nước thải có chứa chất rắn, bùn, cặn bã, rác thải</li>
                    <li>Hệ thống thoát nước mưa, nước thải đô thị</li>
                    <li>Hệ thống xử lý nước thải công nghiệp, dân dụng</li>
                    <li>Trạm bơm nước thải</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Đặc điểm của bơm chống nghẹt</h3>
                <ul class="list-disc pl-6 text-gray-600 space-y-2 mb-4">
                    <li>Thiết kế cánh bơm đặc biệt, có khả năng xử lý chất rắn, cặn bã mà không bị tắc nghẽn</li>
                    <li>Vật liệu chế tạo bền với môi trường ăn mòn, chịu mài mòn tốt</li>
                    <li>Dễ dàng lắp đặt, bảo trì, bảo dưỡng</li>
                    <li>Hoạt động ổn định, độ tin cậy cao</li>
                    <li>Tiết kiệm điện năng</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Tư vấn chọn mua bơm chống nghẹt</h3>
                <p class="text-gray-600 mb-4">
                    Để chọn được loại bơm chống nghẹt phù hợp với nhu cầu sử dụng, quý khách hàng cần xác định các thông số
                    sau:
                </p>
                <ul class="list-disc pl-6 text-gray-600 space-y-2 mb-6">
                    <li>Lưu lượng cần bơm</li>
                    <li>Cột áp cần đạt được</li>
                    <li>Đặc tính của chất lỏng cần bơm (độ pH, nhiệt độ, thành phần...)</li>
                    <li>Kích thước hạt rắn lớn nhất có thể có trong chất lỏng</li>
                    <li>Môi trường lắp đặt và vận hành</li>
                </ul>

                <div class="flex justify-center mt-8">
                    <a href="#" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Liên hệ tư vấn
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
