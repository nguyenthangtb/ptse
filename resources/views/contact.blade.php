@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <nav class="hidden lg:block bg-white py-3 mt-[72px] md:mt-[116px] border-b">
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
                    <a href="#" class="text-gray-600 hover:text-primary">Liên hệ</a>
                </li>
            </ol>
        </div>
    </nav>

    <!-- Contact Section -->
    <section class="py-12 md:py-16 bg-gradient-to-br from-gray-50 via-white to-gray-50 mt-[70px] lg:mt-0">
        <div class="container mx-auto px-4">
            <div class="max-w-xl mx-auto text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Liên hệ với chúng tôi</h1>
                <p class="text-gray-600">Hãy để lại thông tin, chúng tôi sẽ liên hệ với bạn sớm nhất có thể</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
                <!-- Map & Info -->
                <div class="bg-white rounded-xl shadow-lg p-6 backdrop-blur-sm bg-white/90 hover:shadow-xl transition-shadow">
                    <div class="mb-6">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=YOUR_EMBED_URL"
                            class="w-full h-[400px] rounded-lg shadow-sm"
                            style="border:0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary flex-shrink-0 mt-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">Địa chỉ</h3>
                                <p class="text-gray-600 leading-relaxed">10th Floor, CEO Tower Building, Lot HH2-1, Me Tri Ha Urban Area, Pham Hung Street, Me Tri Ward, Nam Tu Liem District, Hanoi City</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary flex-shrink-0 mt-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">Điện thoại</h3>
                                <p class="text-gray-600">0968 750 388</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary flex-shrink-0 mt-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">Email</h3>
                                <p class="text-gray-600">info@ptse.vn</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-white rounded-xl shadow-lg p-8 backdrop-blur-sm bg-white/90 hover:shadow-xl transition-shadow">
                    <h2 class="text-2xl font-semibold mb-6">Gửi thông tin liên hệ</h2>
                    <form class="space-y-6 ajaxForm">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Họ và tên</label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                   placeholder="Nhập họ và tên">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                   placeholder="Nhập địa chỉ email">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                            <input type="tel" 
                                   name="phone" 
                                   id="phone" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                   placeholder="Nhập số điện thoại">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Nội dung</label>
                            <textarea name="message" 
                                      id="message" 
                                      rows="5" 
                                      required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                      placeholder="Nhập nội dung liên hệ"></textarea>
                        </div>

                        <button type="submit" 
                                class="w-full px-6 py-4 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-all transform hover:-translate-y-0.5">
                            Gửi liên hệ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script>
// Initialize Notyf
const notyf = new Notyf({
    duration: 5000,
    position: {
        x: 'right',
        y: 'top'
    }
});
$(document).ready(function() {
    $('.ajaxForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/lien-he',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status == 200) {
                    notyf.success(response.message);
                    $('.ajaxForm')[0].reset();
                } else {
                    notyf.error(response.message);
                }
            },
            error: function(xhr) {
                notyf.error(response.message);
            }
        });
    });
});
</script>
@endsection