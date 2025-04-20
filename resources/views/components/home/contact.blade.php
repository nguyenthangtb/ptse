<!-- Contact Form -->
<section class="py-8 bg-gray-100" id="contact-us">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
        <div class="w-full lg:w-1/2 bg-white p-8 rounded-lg shadow-sm reveal">
            <h2 class="text-3xl font-bold text-center mb-2">Liên hệ với tôi</h2>
            <p class="text-gray-600 text-center mb-12">Bạn có dự án cần thực hiện? Hãy liên hệ ngay để nhận tư vấn và báo giá miễn phí.</p>
            <form class="ajaxForm">
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
    </div>
</section>
