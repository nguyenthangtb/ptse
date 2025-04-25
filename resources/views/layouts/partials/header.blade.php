<header class="bg-[#1E4ED8] shadow-sm fixed top-0 left-0 right-0 z-50">
    <!-- Banner Image -->
    <div class="relative w-full pt-0 pb-0 md:pt-1.5 md:pb-1.5 bg-gradient-to-b from-[#e8ebf0] to-[#e6f7ff]">
        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1NiIgaGVpZ2h0PSIxMDAiPgo8cGF0aCBvcGFjaXR5PSIwLjUiIGZpbGw9IiNmZmYiIGQ9Ik0yOCAwQzE2IDAgMSA0IDAgMTYgMCAyOCA0IDQxIDE2IDQxdDE2LTE2QzMyIDEgMjggMCAyOCAwWk0xODAgMzBjMCAwLTMxLTEyLTQ2LTEyLTIwIDAtMzYgMTQtMzYgMzNzMTMgMzMgMzIgMzNjMTItMyAxMy05IDE1LTE4IDQgMTQgMTAgMjkgMzMgMjktMTUtMi0yMi0xNi0yMi0zMWEzNCAzNCAwIDAgMSAxNy0yOWMwIDAgNi04IDctMTQgMC00LTMtOC0xMC04LTYgMC0xNyA0LTI1IDEwLTcgNS0zMCA0MC0zMCA0MC01LTgtOS0zOS01Mi0zOS01IDAtNCA2LTQgMTNzNSAyMSAxMyAzMGM0IDQgMTcgMjAgMzUgMjAgMTIgMCAxOC0xMCAxOC0xMHMyIDQgMiAxMGMyIDEwIDggMjQgMTggMjcgMCAwIDEzIDYgMjUtNnM3LTIzIDctMjMgOC0xOCA2LTMyLTktMTAtOS0xMFoiLz4KPC9zdmc+')"></div>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 items-center py-2 relative z-10">
            <!-- Logo -->
            <div class="flex justify-center md:justify-start">
                <a href="{{ route('home') }}" class="block">
                    <img src="{{ asset('images/logo_chuan.png') }}" alt="{{$config['company_name']}}"
                         class="w-[200px] h-[80px] object-contain">
                </a>
            </div>

            <!-- Centered Title -->
            <div class="mt-2 md:mt-10 text-center md:text-start">
                <p class="text-base md:text-4xl uppercase tracking-wide font-extrabold text-[#1E4ED8] md:whitespace-nowrap
                   [text-shadow:1px_1px_0px_#fffa90,-1px_-1px_0px_#00255e,0px_2px_5px_rgba(0,0,0,0.3)] italic">
                    GIẢI PHÁP THIẾT BỊ CHO XỬ LÝ NƯỚC
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="w-full bg-[#003087]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Desktop Header Layout -->
            <div class="hidden md:flex justify-between items-center">
                <!-- Main Menu -->
                <div class="flex-1 flex justify-center">
                    <x-main-menu />
                </div>

                <!-- Search Box -->
                <div class="ml-4">
                    <form action="{{ route('search') }}" method="GET" class="flex items-center">
                        <div class="relative">
                            <input type="text" id="desktop-search" name="q" placeholder="Search..."
                                class="w-56 py-1.5 px-4 pr-10 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white/10 text-white placeholder-white/70">
                            <button type="submit" class="absolute inset-y-0 right-0 flex items-center px-2">
                                <i class="fas fa-search text-white/80"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Mobile Header Layout -->
            <div class="flex md:hidden items-center justify-between py-1.5">
                <!-- Mobile Menu Button -->
                <button id="menuToggle" class="text-white focus:outline-none p-1 relative z-[60]">
                    <i class="fas fa-bars text-2xl transition-transform duration-300"></i>
                </button>

                <!-- Mobile Search Component -->
                <div class="flex-grow px-2">
                    <form action="{{ route('search') }}" method="GET" class="flex items-center">
                        <div class="relative w-full">
                            <input type="text" id="search-autocomplete" name="q" placeholder="Tìm kiếm..."
                                class="w-full py-2 px-4 pr-10 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" class="absolute inset-y-0 right-0 flex items-center px-3">
                                <i class="fas fa-search text-gray-500"></i>
                            </button>
                        </div>
                    </form>
                </div>

                @push('scripts')
                <script>
                $(document).ready(function() {
                    $('#search-autocomplete').autocomplete({
                        source: function(request, response) {
                            $.ajax({
                                url: "{{ route('search.autocomplete') }}",
                                dataType: "json",
                                data: {
                                    term: request.term
                                },
                                success: function(data) {
                                    response(data);
                                }
                            });
                        },
                        minLength: 2,
                        select: function(event, ui) {
                            $('#search-autocomplete').val(ui.item.value);
                            $(this).closest('form').submit();
                            return false;
                        }
                    }).autocomplete("instance")._renderItem = function(ul, item) {
                        return $('<li>')
                            .append('<div class="p-2 border-b hover:bg-gray-100">' + item.label + '</div>')
                            .appendTo(ul);
                    };
                });
                </script>
                @endpush
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
