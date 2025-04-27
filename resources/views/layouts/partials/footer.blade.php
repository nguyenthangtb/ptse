<footer class="bg-[#164094] text-white py-8 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCI+CjxyZWN0IHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgZmlsbD0ibm9uZSIvPgo8cGF0aCBkPSJNMzAgMEMxMyAwIDAgMTMgMCAzMHMxMyAzMCAzMCAzMCAzMC0xMyAzMC0zMFM0NyAwIDMwIDB6bTAgNTJjLTEyLjEgMC0yMi05LjktMjItMjJzOS45LTIyIDIyLTIyIDIyIDkuOSAyMiAyMi05LjkgMjItMjIgMjJ6Ii8+Cjwvc3ZnPg=='); background-size: 60px;"></div>
    </div>

    <div class="container mx-auto px-4 relative">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-7xl mx-auto">
            <!-- Company Info -->
            <div class="md:max-w-sm relative z-10">
                <h3 class="font-bold text-xl mb-4 leading-tight uppercase relative inline-block">
                    <span class="relative z-10">{{ __('common.company_info') }}</span>
                    <span class="absolute -bottom-1 left-0 w-12 h-1 bg-orange-400"></span>
                </h3>
                <div class="space-y-2 text-base">
                    <p class="text-white font-semibold text-lg mb-1">{{$config['company_name']}}</p>
                    <div class="bg-white/10 p-4 rounded-lg my-3 shadow-inner backdrop-blur-sm border border-white/10 hover:bg-white/15 transition-colors duration-300">
                        <p class="text-white flex items-start gap-2 mb-2">
                            <i class="fas fa-map-marker-alt mt-1 text-orange-400"></i>
                            <span class="font-medium">{{ $config['address_1'] }}</span>
                        </p>
                        <p class="text-white flex items-start gap-2">
                            <i class="fas fa-building mt-1 text-orange-400"></i>
                            <span class="font-medium">{{ $config['address_2'] }}</span>
                        </p>
                    </div>
                    <p class="text-white flex items-center gap-2 group">
                        <i class="fas fa-phone-alt text-blue-300 group-hover:text-orange-400 transition-colors"></i>
                        <a href="tel:{{ $config['phone'] }}" class="hover:text-orange-300 transition-colors">{{ $config['phone'] }}</a>
                    </p>
                    <p class="text-white flex items-center gap-2 group">
                        <i class="fas fa-envelope text-blue-300 group-hover:text-orange-400 transition-colors"></i>
                        <a href="mailto:{{ $config['email'] }}" class="hover:text-orange-300 transition-colors">{{ $config['email'] }}</a>
                    </p>
                </div>

{{--                <div class="mt-3">--}}
{{--                    <a href="#" class="block">--}}
{{--                        <img src="{{ asset('images/logo-da-thong-bao-bo-cong-thuong.webp') }}" alt="Đã thông báo Bộ Công Thương" style="width: 280px; height: auto;">--}}
{{--                    </a>--}}
{{--                </div>--}}
            </div>

            <!-- Information -->
            <div class="md:mx-auto relative z-10">
                <h3 class="font-bold text-xl mb-4 leading-tight uppercase relative inline-block">
                    <span class="relative z-10">{{ __('common.additional_information') }}</span>
                    <span class="absolute -bottom-1 left-0 w-12 h-1 bg-orange-400"></span>
                </h3>
                <ul class="space-y-3 text-base">
                    <li><a href="#" class="text-white hover:text-orange-300 transition-colors flex items-center gap-2 group"><i class="fas fa-angle-right text-blue-300 group-hover:text-orange-400 transition-transform group-hover:translate-x-1"></i> {{ __('common.consultation_service') }}</a></li>
                    {{-- <li><a href="#" class="text-white hover:text-gray-200 block">Tìm cửa hàng gần nhất</a></li> --}}
                    <li><a href="#" class="text-white hover:text-orange-300 transition-colors flex items-center gap-2 group"><i class="fas fa-angle-right text-blue-300 group-hover:text-orange-400 transition-transform group-hover:translate-x-1"></i> {{ __('common.customer_care') }}</a></li>
                    <li><a href="#" class="text-white hover:text-orange-300 transition-colors flex items-center gap-2 group"><i class="fas fa-angle-right text-blue-300 group-hover:text-orange-400 transition-transform group-hover:translate-x-1"></i> {{ __('common.frequently_asked_questions') }}</a></li>
                    <li><a href="#" class="text-white hover:text-orange-300 transition-colors flex items-center gap-2 group"><i class="fas fa-angle-right text-blue-300 group-hover:text-orange-400 transition-transform group-hover:translate-x-1"></i> {{ __('common.policy_terms') }}</a></li>
                </ul>
            </div>

            <!-- Liên hệ (Cột mới) -->
            <div class="md:mx-auto relative z-10">
                <h3 class="font-bold text-xl mb-4 leading-tight uppercase relative inline-block">
                    <span class="relative z-10">{{ __('common.contact') }}</span>
                    <span class="absolute -bottom-1 left-0 w-12 h-1 bg-orange-400"></span>
                </h3>
                <div class="space-y-4 text-base">
                    <div class="bg-white/5 p-3 rounded-lg border border-white/10 hover:bg-white/10 transition-colors duration-300">
                        <p class="text-blue-300 font-medium mb-1">{{ __('common.business_customer_care') }}</p>
                        <p class="text-white flex items-start gap-2 group">
                            <i class="fas fa-user-tie text-orange-400 mt-1"></i>
                            <span class="contact-info">
                                {!! nl2br(e($config['customer_phone'])) !!}
                            </span>
                        </p>
                    </div>
                    <div class="bg-white/5 p-3 rounded-lg border border-white/10 hover:bg-white/10 transition-colors duration-300">
                        <p class="text-blue-300 font-medium mb-1">{{ __('common.technical_operation') }}</p>
                        <p class="text-white flex items-start gap-2 group">
                            <i class="fas fa-headset text-orange-400 mt-1"></i>
                            <span class="contact-info">
                                {!! nl2br(e($config['support_phone'])) !!}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Support -->
            <div class="md:mx-auto relative z-10">
                <h3 class="font-bold text-xl mb-4 leading-tight uppercase relative inline-block">
                    <span class="relative z-10">{{ __('common.sign_up_for_news') }}</span>
                    <span class="absolute -bottom-1 left-0 w-12 h-1 bg-orange-400"></span>
                </h3>
                <form class="flex flex-wrap gap-2 mt-4">
                    <input type="email" placeholder="{{ __('common.enter_email') }}" class="px-3 py-2 text-gray-800 rounded-lg w-full md:w-auto text-base focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg w-full md:w-auto text-base font-medium transition-colors shadow-lg hover:shadow-orange-500/50">{{ __('common.subscribe') }}</button>
                </form>

                {{-- <h3 class="font-bold text-xl mt-8 mb-4 leading-tight uppercase relative inline-block">
                    <span class="relative z-10">KẾT NỐI VỚI CHÚNG TÔI</span>
                    <span class="absolute -bottom-1 left-0 w-12 h-1 bg-orange-400"></span>
                </h3>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-white bg-blue-500 hover:bg-blue-600 p-3 rounded-full transition-transform hover:-translate-y-1 hover:shadow-lg">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="text-white bg-red-600 hover:bg-red-700 p-3 rounded-full transition-transform hover:-translate-y-1 hover:shadow-lg">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div> --}}
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-blue-800 mt-10 pt-6 text-center text-white/80 text-sm relative z-10">
            <p>© {{ date('Y') }} <span class="text-white font-medium">{{$config['company_name']}}</span> | {{ __('common.designed_by') }} <a href="#" class="text-orange-300 hover:underline">PTSE</a></p>
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
            {{ $config['phone'] }}
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
