<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#1976d2">
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#1976d2">
    <meta name="msapplication-config" content="{{ asset('images/favicon/browserconfig.xml') }}">

    <meta name="theme-color" content="#1976d2">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Chuyên cung cấp giải pháp bơm và vận tải cho ngành nước. Đơn vị hàng đầu trong lĩnh vực thiết bị bơm công nghiệp tại Việt Nam.">
    <meta name="keywords" content="bơm công nghiệp, bơm nước, vận tải nước, giải pháp bơm, thiết bị bơm, Phú Thái">
    <meta name="author" content="{{ $config['company_name'] }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Giải pháp bơm & vận tải cho ngành nước')">
    <meta property="og:description" content="Chuyên cung cấp giải pháp bơm và vận tải cho ngành nước. Đơn vị hàng đầu trong lĩnh vực thiết bị bơm công nghiệp tại Việt Nam.">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Giải pháp bơm & vận tải cho ngành nước')">
    <meta property="twitter:description" content="Chuyên cung cấp giải pháp bơm và vận tải cho ngành nước. Đơn vị hàng đầu trong lĩnh vực thiết bị bơm công nghiệp tại Việt Nam.">
    <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Additional SEO tags -->
    <meta name="robots" content="index, follow">
    <meta name="language" content="Vietnamese">
    <link rel="canonical" href="{{ url()->current() }}">

    <title>@yield('title', 'Giải pháp bơm & vận tải cho ngành nước')</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1976d2',
                        secondary: '#f0f7ff',
                        dark: '#1a1a1a',
                    }
                }
            }
        }
    </script>
    <!-- Font Awesome for icons -->
    <!-- <link rel="stylesheet" href="{{ asset('css/all.min.css') }}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href=" {{ asset('css/notyf.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    {{-- @vite('resources/css/app.css') --}}
    @yield('styles')
</head>
<body class="font-sans text-gray-800 bg-gray-50 dark:bg-gray-900 dark:text-gray-100">
    <!-- Header -->
    @include('layouts.partials.header')

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- jQuery (if needed) -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/notyf.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Mobile menu toggle
            $('#menuToggle').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('#navMenu').toggleClass('hidden');
            });

            // Mobile dropdown toggle
            $('.dropdown-toggle').click(function(e) {
                if (window.innerWidth < 768) {
                    e.preventDefault();
                    $(this).siblings('.dropdown-menu').toggleClass('hidden');
                }
            });

            // Close menu when clicking outside
            $(document).click(function(e) {
                if (!$(e.target).closest('#navMenu, #menuToggle').length) {
                    if (window.innerWidth < 768 && !$('#navMenu').hasClass('hidden')) {
                        $('#navMenu').addClass('hidden');
                    }
                }
            });

            // Hide button initially
            $("#backToTopBtn").hide();
            var btn = $("#backToTopBtn");
            // Ẩn/hiện nút khi cuộn xuống
            $(window).scroll(function () {
                if ($(window).scrollTop() > 300) {
                    btn.fadeIn();
                } else {
                    btn.fadeOut();
                }
            });
            // Cuộn lên đầu khi nhấn vào nút
            btn.click(function () {
                $("html, body").animate({ scrollTop: 0 }, "slow");
            });

        const $menuToggle = $('#menuToggle');
        const $closeMenu = $('#closeMenu');
        const $mobileMenu = $('#mobileMenu');
        const $menuContent = $mobileMenu.find('.absolute');
        let isOpen = false;

        function toggleMenu() {
            isOpen = !isOpen;

            if (isOpen) {
                // Open menu
                $mobileMenu.removeClass('invisible opacity-0');
                $menuContent.removeClass('translate-x-full');
                $('body').css('overflow', 'hidden');
                $menuToggle.css('visibility', 'hidden');
            } else {
                // Close menu
                $mobileMenu.addClass('opacity-0');
                $menuContent.addClass('translate-x-full');
                $menuToggle.css('visibility', 'visible');
                setTimeout(() => {
                    $mobileMenu.addClass('invisible');
                }, 300);
                $('body').css('overflow', '');
            }
        }

        $menuToggle.on('click', toggleMenu);
        $closeMenu.on('click', toggleMenu);
        $mobileMenu.on('click', function(e) {
            if (e.target === this) {
                toggleMenu();
            }
        });

        // Close menu on window resize
        $(window).on('resize', function() {
            if ($(window).width() >= 768 && isOpen) {
                toggleMenu();
            }
        });
        });
         // Menu mobile toggle
    const $menuToggle = $('#menuToggle');
    const $closeMenu = $('#closeMenu');
    const $mobileMenu = $('#mobileMenu');
    const $menuContent = $mobileMenu.find('.absolute');
    let isOpen = false;

    // Hàm mở/đóng menu chính
    function toggleMainMenu() {
        isOpen = !isOpen;

        if (isOpen) {
            $mobileMenu
                .removeClass('invisible')
                .removeClass('opacity-0');
            $menuContent.removeClass('translate-x-full');
            $('body').css('overflow', 'hidden');
            $menuToggle.css('visibility', 'hidden');
        } else {
            $mobileMenu.addClass('opacity-0');
            $menuContent.addClass('translate-x-full');
            $menuToggle.css('visibility', 'visible');

            setTimeout(() => {
                $mobileMenu.addClass('invisible');
            }, 300);

            $('body').css('overflow', '');

            // Reset all submenus when closing main menu
            $('.mobile-submenu').slideUp();
            $('.menu-arrow').removeClass('rotate-180');
        }
    }

    // Xử lý click menu chính
    $menuToggle.on('click', toggleMainMenu);
    $closeMenu.on('click', toggleMainMenu);
    $mobileMenu.on('click', function(e) {
        if (e.target === this) {
            toggleMainMenu();
        }
    });

    // Xử lý submenu cấp 1
    $(document).on('click', '.menu-item > a[href="#"]', function(e) {
        e.preventDefault();
        const $this = $(this);
        const $submenu = $this.siblings('.mobile-submenu');
        const $arrow = $this.find('.menu-arrow');

        // Đóng các submenu khác cùng cấp
        $this.closest('.menu-item')
            .siblings()
            .find('.mobile-submenu')
            .slideUp()
            .end()
            .find('.menu-arrow')
            .removeClass('rotate-180');

        // Toggle submenu hiện tại
        $submenu.slideToggle(300);
        $arrow.toggleClass('rotate-180');
    });

    // Xử lý submenu cấp 2
    $(document).on('click', '.submenu-item > a[href="#"]', function(e) {
        e.preventDefault();
        const $this = $(this);
        const $nestedSubmenu = $this.siblings('.nested-submenu');
        const $arrow = $this.find('.menu-arrow');

        // Đóng các nested submenu khác
        $this.closest('.submenu-item')
            .siblings()
            .find('.nested-submenu')
            .slideUp()
            .end()
            .find('.menu-arrow')
            .removeClass('rotate-180');

        // Toggle nested submenu hiện tại
        $nestedSubmenu.slideToggle(300);
        $arrow.toggleClass('rotate-180');
    });

    // Đóng menu khi resize
    $(window).on('resize', function() {
        if ($(window).width() >= 768 && isOpen) {
            toggleMainMenu();
        }
    });
    </script>
    <script src="{{ asset('js/scrollreveal.js') }}"></script>
    <script>
        ScrollReveal().reveal('.reveal', {
            distance: '50px',
            duration: 1000,
            easing: 'cubic-bezier(0.5, 0, 0, 1)',
            interval: 100
        });


    </script>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    {{-- @vite('resources/js/app.js') --}}
    @yield('scripts')
</body>
</html>
