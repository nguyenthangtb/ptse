<header class="bg-[#1E4ED8] shadow-sm fixed top-0 left-0 right-0 z-50">
    <!-- Banner Image -->
    <div class="relative w-full bg-white py-1.5 md:py-2 flex justify-center items-center">
        <div class="w-full max-w-[800px] h-auto overflow-hidden px-4 md:px-0 group">
            <img src="{{ asset('images/banner_header.jpg') }}"
                 alt="PTSE Banner"
                 class="w-full h-auto object-contain max-h-[80px] md:max-h-[120px] transition-all duration-500 ease-in-out
                 group-hover:scale-105 group-hover:brightness-110 rounded-lg">
        </div>
    </div>

    <!-- Navigation -->
    <div class="w-full">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-1.5">
                <!-- Enhanced Logo Container -->
                <div class="flex items-center">
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300 mr-2">
                        <a href="{{ route('home') }}">
                            <img src="{{ Storage::url('logo/logo.jpeg') }}"
                                 alt="PTSE Logo"
                                 class="w-full h-full object-contain p-1">
                        </a>
                    </div>
                    <div class="block">
                        <h1 class="text-white font-bold text-base md:text-lg leading-tight">PTSE</h1>
                        <p class="text-blue-100 text-xs">
                            {{ $config['company_name'] }}
                        </p>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button id="menuToggle" class="md:hidden text-white focus:outline-none p-2 relative z-[60]">
                    <i class="fas fa-bars text-2xl transition-transform duration-300"></i>
                </button>

                <!-- Desktop Menu -->
                <div class="hidden md:block">
                    <x-main-menu />
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Container -->
    <div id="mobileMenu" class="fixed inset-0 bg-black/50 opacity-0 invisible transition-all duration-300 ease-in-out md:hidden z-[55]">
        <div class="absolute right-0 top-0 h-full w-[300px] bg-[#1E4ED8] transform translate-x-full transition-transform duration-300 ease-in-out">
            <!-- Close button -->
            <button class="absolute top-4 right-4 text-white p-2" id="closeMenu">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <div class="p-6 pt-16 min-h-full flex flex-col">
                <div class="flex-1 overflow-y-auto">
                    <div class="flex flex-col space-y-2">
                        <x-main-menu />
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
