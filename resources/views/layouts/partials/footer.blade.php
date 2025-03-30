<footer class="bg-dark text-white pt-12 pb-6">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <!-- Company Info -->
            <div class="md:max-w-sm">
                <h3 class="font-bold text-lg mb-4 leading-tight">
                    CÔNG TY CỔ PHẦN GIẢI PHÁP KỸ THUẬT PHÚ THÁI
                    <span class="block text-sm mt-1 font-normal text-gray-400">PHU THAI SOLUTIONS ENGINEERING JOINT STOCK COMPANY</span>
                </h3>
                <div class="space-y-2">
                    <p class="text-gray-400 text-sm flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0 mt-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <span>Tầng 10, tòa nhà CEO Tower, Lô HH2-1 Khu đô thị Mễ Trì Hạ, đường Phạm Hùng, Phường Mễ Trì, Quận Nam Từ Liêm, Thành phố Hà Nội, Việt Nam</span>
                    </p>
                    <p class="text-gray-400 text-sm flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        <a href="tel:0968750388" class="hover:text-white transition-colors">0968 750 388</a>
                    </p>
                    <p class="text-gray-400 text-sm flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <a href="mailto:info@ptse.vn" class="hover:text-white transition-colors">info@ptse.vn</a>
                    </p>
                </div>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Information -->
            <div class="md:mx-auto md:w-48">
                <h3 class="font-bold text-lg mb-4">THÔNG TIN</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Về chúng tôi</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Sản phẩm</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Dịch vụ</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="md:mx-auto md:w-48">
                <h3 class="font-bold text-lg mb-4">HỖ TRỢ</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Liên hệ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Hỗ trợ kỹ thuật</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Chính sách bảo hành</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-10 pt-6 text-center text-gray-500 text-sm">
            <p>© {{ date('Y') }} CÔNG TY CỔ PHẦN GIẢI PHÁP KỸ THUẬT PHÚ THÁI.</p>
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
            0968 750 388
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
