<footer class="bg-[#164094] text-white py-6">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-7xl mx-auto">
            <!-- Company Info -->
            <div class="md:max-w-sm">
                <h3 class="font-bold text-lg mb-3 leading-tight uppercase">
                    THÔNG TIN CÔNG TY
                </h3>
                <div class="space-y-1 text-sm">
                    <p class="text-white">CÔNG TY CỔ PHẦN GIẢI PHÁP KỸ THUẬT PHÚ THÁI</p>
                    <p class="text-white">PHU THAI  SOLUTIONS ENGINEERING  JOINT STOCK  COMPANY</p>
                    <p class="text-white flex items-center gap-2">
                        <i class="fas fa-phone-alt"></i>
                        <a href="tel:0968750388" class="hover:text-gray-200 transition-colors">+84 968 750 388</a>
                    </p>
                    <p class="text-white flex items-center gap-2">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:info@ptse.vn" class="hover:text-gray-200 transition-colors">info@ptse.vn</a>
                    </p>
                </div>
                <div class="mt-3">
                    <p class="text-white text-sm">Là thành viên của:</p>
                    <p class="text-white text-sm">Hiệp Hội Cấp Nước Sạch Hàng Yên</p>
                </div>
                <div class="mt-3">
                    <a href="#" class="block">
                        <img src="{{ asset('images/logo-da-thong-bao-bo-cong-thuong.webp') }}" alt="Đã thông báo Bộ Công Thương" style="width: 280px; height: auto;">
                    </a>
                </div>
            </div>

            <!-- Information -->
            <div class="md:mx-auto">
                <h3 class="font-bold text-lg mb-3 leading-tight uppercase">
                    THÔNG TIN BỔ SUNG
                </h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-white hover:text-gray-200 block">Tư vấn dịch vụ</a></li>
                    {{-- <li><a href="#" class="text-white hover:text-gray-200 block">Tìm cửa hàng gần nhất</a></li> --}}
                    <li><a href="#" class="text-white hover:text-gray-200 block">Chăm sóc khách hàng</a></li>
                    <li><a href="#" class="text-white hover:text-gray-200 block">Câu hỏi thường gặp</a></li>
                    <li><a href="#" class="text-white hover:text-gray-200 block">Chính sách - Điều khoản</a></li>
                </ul>
            </div>

            <!-- Liên hệ (Cột mới) -->
            <div class="md:mx-auto">
                <h3 class="font-bold text-lg mb-3 leading-tight uppercase">
                    LIÊN HỆ
                </h3>
                <div class="space-y-2 text-sm">
                    <p class="text-white">Kỹ thuật - Vận hành:</p>
                    <p class="text-white"><a href="tel:+84968750388" class="hover:text-gray-200 transition-colors">+84 968 750 388</a></p>
                    <p class="text-white">Kinh doanh - CSKH:</p>
                    <p class="text-white"><a href="tel:+84968750388" class="hover:text-gray-200 transition-colors">+84 968 750 388</a></p>
                </div>
            </div>

            <!-- Support -->
            <div class="md:mx-auto">
                <h3 class="font-bold text-lg mb-3 leading-tight uppercase">
                    ĐĂNG KÝ NHẬN TIN
                </h3>
                <form class="flex flex-wrap gap-2 mt-2">
                    <input type="email" placeholder="Nhập email" class="px-3 py-2 text-gray-800 rounded w-full md:w-auto" required>
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">Đăng ký</button>
                </form>

                <h3 class="font-bold text-lg mt-6 mb-2 leading-tight uppercase">
                    KẾT NỐI VỚI CHÚNG TÔI
                </h3>
                <div class="flex space-x-3 mt-2">
                    <a href="#" class="text-white">
                        <i class="fab fa-facebook-f fa-lg"></i>
                    </a>
                    <a href="#" class="text-white">
                        <i class="fab fa-youtube fa-lg"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-blue-800 mt-6 pt-4 text-center text-white text-xs">
            <p>© {{ date('Y') }} Công ty Cổ phần Giải pháp kỹ thuật Phú Thái</p>
        </div>
    </div>
</footer>

<!-- Floating Contact Buttons -->
<div class="fixed bottom-6 right-6 flex flex-col gap-3 z-50">

    <!-- Back to top -->
    <a href="#"
       id="backToTopBtn"
       class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center text-white shadow-lg hover:bg-gray-700 transform hover:-translate-y-1 transition-all">
        <i class="fas fa-arrow-up"></i>
    </a>


    <!-- Zalo -->
    <a href="https://zalo.me/0968750388"
       target="_blank"
       class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white shadow-lg hover:bg-blue-600 transform hover:-translate-y-1 transition-all">
        <span class="text-xl font-bold">Zalo</span>
    </a>

    <!-- Facebook Messenger -->
    <a href="https://m.me/YOUR_FB_PAGE_ID"
       target="_blank"
       class="w-12 h-12 bg-[#0099FF] rounded-full flex items-center justify-center text-white shadow-lg hover:bg-[#0088FF] transform hover:-translate-y-1 transition-all">
        <i class="fab fa-facebook-messenger text-2xl"></i>
    </a>

    <!-- Hotline -->
    <a href="tel:0968750388"
       class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white shadow-lg hover:bg-red-600 transform hover:-translate-y-1 transition-all relative group">
        <i class="fas fa-phone-alt text-xl animate-bounce"></i>
        <span class="absolute right-full mr-3 bg-black text-white text-sm py-1 px-2 rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity">
            +84 968 750 388
        </span>
    </a>
</div>

<!-- Pulse Animation for Hotline -->
<style>
    @keyframes pulse-ring {
        0% {
            transform: scale(.33);
        }
        80%, 100% {
            opacity: 0;
        }
    }
    .pulse-ring::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-color: rgb(239 68 68 / 0.5);
        animation: pulse-ring 1.25s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
    }
</style>
