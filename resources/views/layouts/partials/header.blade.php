<header class="bg-[#1E4ED8] shadow-sm fixed top-0 left-0 right-0 z-50">
    <!-- Contact Info -->
    <div id="contact-info" class="hidden md:block transition-all duration-300">
        <div class="container mx-auto px-4">
            <div class="flex justify-between py-2 border-b border-blue-500">
                <div class="text-sm font-semibold text-white">
                    <!-- <span>PTSE - Giải pháp kỹ thuật nước</span> -->
                </div>
                <div class="flex flex-col md:flex-row gap-2 md:gap-6 text-sm font-semibold text-white">
                    <a class="flex items-center hover:text-gray-200">
                        Tax code: 0109966923
                    </a>
                    <a href="tel:0968750388" class="flex items-center hover:text-gray-200">
                        <i class="fas fa-phone text-white mr-2"></i> SĐT: 0968 750 388
                    </a>
                    <a href="mailto:info@ptse.vn" class="flex items-center hover:text-gray-200">
                        <i class="fas fa-envelope text-white mr-2"></i> Email liên hệ: info@ptse.vn
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation - Keep inside container -->
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-2">
            <!-- Enhanced Logo Container -->
            <div class="flex items-center">
                <div class="w-16 h-16 bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300 mr-3">
                    <a href="{{ route('home') }}">
                        <img src="{{ Storage::url('logo/logo.jpeg') }}" 
                             alt="PTSE Logo" 
                             class="w-full h-full object-contain p-2">
                    </a>
                </div>
                <div class="block"> <!-- Changed from 'hidden md:block' to 'block' -->
                    <h1 class="text-white font-bold text-xl leading-tight">PTSE</h1>
                    <p class="text-blue-100 text-sm">Giải pháp kỹ thuật nước</p>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button id="menuToggle" class="md:hidden text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>

            <!-- Desktop Menu -->
            <nav id="navMenu" class="hidden md:flex absolute md:static left-0 right-0 top-full md:top-auto bg-[#1E4ED8] md:bg-transparent shadow-md md:shadow-none z-50 md:z-auto p-4 md:p-0 border-t md:border-t-0 border-blue-500">
                <x-main-menu />
            </nav>
        </div>
    </div>
</header>
