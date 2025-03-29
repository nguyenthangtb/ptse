@extends('layouts.app')

@section('title', 'Giải pháp bơm & van cho ngành nước')

@section('content')
    <!-- Hero Section -->
    <section class="min-h-[70vh] bg-[#DBEAFE] flex items-center relative animate-fade-in">
        <div class="container mx-auto px-4 py-32 md:py-40 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-slide-up relative">
                <span class="block text-gray-900 mb-2 animate-text-shadow">Tôi giúp bạn xây dựng</span>
                <span class="bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-400 text-transparent bg-clip-text animate-text-shadow">Giải pháp bơm & van tối ưu cho ngành nước</span>
            </h1>
            <p class="text-gray-600 text-lg md:text-xl mb-12 max-w-3xl mx-auto animate-slide-up delay-200 animate-text-shadow">Nâng cao hiệu quả - Tiết kiệm năng lượng</p>
            <div class="flex flex-wrap justify-center gap-4 animate-slide-up delay-300">
                <a href="#contact-us"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-4 rounded-lg inline-flex items-center transition-all duration-300 ease-in-out"
                   onclick="event.preventDefault(); document.getElementById('contact-us').scrollIntoView({
                       behavior: 'smooth',
                       block: 'start',
                       inline: 'nearest'
                   })">
                    Nhận tư vấn ngay
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>

            </div>
        </div>

        <!-- Scroll Down Button -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-center">
            <a href="#categories"
                   class="inline-flex flex-col items-center text-gray-600 hover:text-gray-900 transition-all duration-300 ease-in-out"
                   onclick="event.preventDefault(); document.getElementById('categories').scrollIntoView({
                       behavior: 'smooth',
                       block: 'start',
                       inline: 'nearest'
                   })">
                    <span class="text-sm font-medium mb-2 hover:transform hover:translate-y-1 transition-transform">Cuộn xuống</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 animate-bounce transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </a>
        </div>
    </section>

    <!-- Categories Section -->
    <div id="categories" class="bg-gray-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl py-2 sm:py-24 lg:max-w-none lg:py-8">
                <h2 class="text-2xl font-bold text-center mb-10 reveal">Danh mục sản phẩm</h2>
                <div class="mt-6 grid grid-cols-1 gap-y-12 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 xl:gap-x-8">
                    @foreach($categories ?? [] as $category)
                    <div class="group relative reveal transition-all duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        @if($category->image)
                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full rounded-lg bg-white object-cover group-hover:opacity-75 max-sm:h-80 sm:aspect-2/1 lg:aspect-square transition-all duration-300">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100 rounded-lg max-sm:h-80 sm:aspect-2/1 lg:aspect-square">
                            <span>Hình ảnh</span>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/50 to-transparent rounded-lg flex flex-col justify-end p-6 transform transition-all duration-300">
                            <div class="flex items-end justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-white mb-2 transform transition-all duration-300">
                                        <a href="{{ route('products.category', $category) }}" class="hover:underline">
                                            {{ $category->name ?? 'Danh mục sản phẩm' }}
                                        </a>
                                    </h3>
                                    <!-- <p class="text-sm text-gray-200 transform transition-all duration-300">{{ $category->description ?? 'Danh mục' }}</p> -->
                                </div>
                                <div class="flex-shrink-0 ml-4">
                                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-white/20 transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white group-hover:translate-x-1 transition-transform">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Scroll Down Button -->
        <div class="text-center pb-8">
            <a href="#featured-products"
               class="inline-flex flex-col items-center text-gray-600 hover:text-gray-900 transition-all duration-300 ease-in-out"
               onclick="event.preventDefault(); document.getElementById('featured-products').scrollIntoView({
                   behavior: 'smooth',
                   block: 'start',
                   inline: 'nearest'
               })">
                <span class="text-sm font-medium mb-2 hover:transform hover:translate-y-1 transition-transform">Cuộn xuống</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 animate-bounce transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Featured Products -->
    <section id="featured-products" class="py-8 bg-secondary">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center mb-10 reveal">Sản phẩm nổi bật</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach($featuredProducts ?? [] as $product)
                    <div class="group relative reveal">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
                        @else
                            <img src="https://placehold.co/800x400" alt="{{ $product->name }}" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
                        @endif
                        <div class="mt-4">
                            <h3 class="text-[14px] font-bold text-center text-gray-700">
                                <a href="#">
                                    <a href="{{ route('products.show', $product->slug) }}" class="hover:text-primary transition-colors">
                                    {{ $product->name ?? 'Tên sản phẩm' }}
                                </a>
                            </h3>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-16 reveal">
                <a href="{{route('products.index')}}" class="text-primary hover:underline inline-flex items-center">
                    Xem tất cả sản phẩm <span class="ml-1">→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center mb-10 reveal">Tin tức</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($news ?? [] as $article)
                    <div class="group relative bg-secondary rounded-lg shadow-md overflow-hidden reveal">
                        <div class="relative h-[300px] sm:h-[350px]">
                            @if($article->image)
                                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:opacity-75">
                            @else
                                <img src="https://placehold.co/800x400" alt="{{ $article->title }}" class="w-full h-full object-cover">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                            <div class="absolute bottom-0 p-4 text-white">
                                <h3 class="font-medium text-lg mb-1">{{ $article->title ?? 'Tiêu đề bài viết' }}</h3>
                                <p class="text-gray-200 text-sm">{{ $article->date ?? now()->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="py-8 bg-gray-50" id="contact-us">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-2 reveal">Liên hệ với tôi</h2>
            <p class="text-gray-600 text-center mb-12 reveal">Bạn có dự án cần thực hiện? Hãy liên hệ ngay để nhận tư vấn và báo giá miễn phí.</p>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-7xl mx-auto">
                <div class="bg-white p-8 rounded-lg shadow-sm reveal">
                    <h3 class="text-xl font-semibold mb-6">Gửi yêu cầu</h3>
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Họ và tên</label>
                            <input type="text" name="name" placeholder="Nhập họ và tên của bạn" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Email</label>
                            <input type="email" name="email" placeholder="Nhập email của bạn" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Số điện thoại</label>
                            <input type="tel" name="phone" placeholder="Nhập số điện thoại của bạn" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary" required>
                        </div>
{{--                        <div class="mb-4">--}}
{{--                            <label class="block text-sm font-medium mb-2">Dịch vụ quan tâm</label>--}}
{{--                            <select name="service" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary">--}}
{{--                                <option value="">Chọn dịch vụ</option>--}}
{{--                                <option value="1">Dịch vụ 1</option>--}}
{{--                                <option value="2">Dịch vụ 2</option>--}}
{{--                                <option value="3">Dịch vụ 3</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium mb-2">Nội dung yêu cầu</label>
                            <textarea name="message" rows="4" placeholder="Mô tả chi tiết yêu cầu của bạn..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-medium px-6 py-3 rounded-lg flex items-center justify-center">
                            Gửi yêu cầu
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <h3 class="text-xl font-semibold mb-6">Thông tin liên hệ</h3>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-primary/5 p-3 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-medium mb-1">Email</h4>
                                <p class="text-gray-600">info@ptse.vn</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-primary/5 p-3 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-medium mb-1">Điện thoại</h4>
                                <p class="text-gray-600">0968 750 388</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-primary/5 p-3 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-medium mb-1">Địa chỉ</h4>
                                <p class="text-gray-600">10th Floor, CEO Tower Building, Lot HH2-1, Me Tri Ha Urban Area, Pham Hung Street, Me Tri Ward, Nam Tu Liem District, Hanoi City</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">Kết nối với tôi</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="bg-primary/5 p-3 rounded-lg hover:bg-primary/10 transition-colors">
                                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                                </svg>
                            </a>
                            <a href="#" class="bg-primary/5 p-3 rounded-lg hover:bg-primary/10 transition-colors">
                                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                </svg>
                            </a>
                            <a href="#" class="bg-primary/5 p-3 rounded-lg hover:bg-primary/10 transition-colors">
                                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/>
                                </svg>
                            </a>
                            <a href="#" class="bg-primary/5 p-3 rounded-lg hover:bg-primary/10 transition-colors">
                                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">Giờ làm việc</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Thứ Hai – Thứ Sáu:</span>
                                <span class="font-medium">8:00 – 17:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Thứ Bảy - Chủ Nhật</span>
                                <span class="font-medium">Nghỉ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
