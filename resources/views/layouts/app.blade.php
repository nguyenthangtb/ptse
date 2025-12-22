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
    <meta name="description" content="@yield('meta_description', 'Chuyên cung cấp giải pháp bơm và van cho ngành nước. Đơn vị hàng đầu trong lĩnh vực thiết bị bơm công nghiệp tại Việt Nam.')">
    <meta name="keywords" content="@yield('meta_keywords', 'bơm công nghiệp, bơm nước, van nước, giải pháp bơm, thiết bị bơm, Phú Thái, PTSE')">
    <meta name="author" content="{{ $config['company_name'] ?? 'PTSE' }}">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="language" content="{{ app()->getLocale() }}">
    <meta name="revisit-after" content="7 days">
    <meta name="distribution" content="global">
    <meta name="rating" content="general">
    <meta name="coverage" content="worldwide">
    <meta name="target" content="all">
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Giải pháp bơm & van cho ngành nước')">
    <meta property="og:description" content="Chuyên cung cấp giải pháp bơm và van cho ngành nước. Đơn vị hàng đầu trong lĩnh vực thiết bị bơm công nghiệp tại Việt Nam.">
    <meta property="og:image" content="{{ asset('images/logo_chuan.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Giải pháp bơm & van cho ngành nước')">
    <meta property="twitter:description" content="Chuyên cung cấp giải pháp bơm và van cho ngành nước. Đơn vị hàng đầu trong lĩnh vực thiết bị bơm công nghiệp tại Việt Nam.">
    <meta property="twitter:image" content="{{ asset('images/logo_chuan.png') }}">
    <!-- Force light mode - không cho phép dark mode -->
    <meta name="color-scheme" content="light only">
    <meta name="supported-color-schemes" content="light">
    <meta name="google-site-verification" content="lxQ97dDhGdIG32BifgSezgw7c7J6eM_OT2WaEaTrpRA" />
    <!-- Additional SEO tags -->
    <meta name="language" content="Vietnamese">
    <link rel="canonical" href="{{ url()->current() }}">

    <title>@yield('title', 'Giải pháp bơm & van cho ngành nước')</title>
    <style>
        /* Chỉ force background, KHÔNG force color */
        html, body {
            background-color: #ffffff !important;
        }

        @media (prefers-color-scheme: dark) {
            html, body {
                background-color: #ffffff !important;
            }
        }
    </style>
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "PTSE",
          "url": "{{ url('/') }}",
          "logo": "{{ asset('images/logo_chuan.png') }}",
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+84 968 750 388",
            "contactType": "Customer Service",
            "areaServed": "VN",
            "availableLanguage": ["Vietnamese", "English"]
          },
          "sameAs": [
            "https://www.facebook.com/ptse.vn",
            "https://www.linkedin.com/company/ptse",
            "https://www.youtube.com/@ptse"
          ]
        }
    </script>
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
                    },
                    fontFamily: {
                        sans: ['Roboto', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Oxygen', 'Ubuntu', 'Cantarell', 'Helvetica Neue', 'sans-serif'],
                    },
                    fontSize: {
                        'xs': ['0.75rem', { lineHeight: '1.5' }],
                        'sm': ['0.875rem', { lineHeight: '1.5' }],
                        'base': ['1rem', { lineHeight: '1.5' }],
                        'lg': ['1.125rem', { lineHeight: '1.5' }],
                        'xl': ['1.25rem', { lineHeight: '1.4' }],
                        '2xl': ['1.5rem', { lineHeight: '1.3' }],
                        '3xl': ['1.875rem', { lineHeight: '1.25' }],
                        '4xl': ['2.25rem', { lineHeight: '1.2' }],
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
    <link href="{{ asset('lightbox/dist/css/lightbox.min.css') }}" rel="stylesheet" />

    {{-- @vite('resources/css/app.css') --}}
    @yield('styles')

    <!-- Force light mode CSS -->
    <link rel="stylesheet" href="{{ asset('css/force-light.css') }}">

    <!-- Google Fonts - Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <style>
        /* Font family nhất quán */
        html {
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Oxygen, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;
            font-size: 16px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: inherit;
            font-size: 1rem;
        }

        /* Đồng nhất font size cho các thẻ heading */
        h1 { font-size: 2.25rem; font-weight: 700; line-height: 1.2; }
        h2 { font-size: 1.875rem; font-weight: 600; line-height: 1.25; }
        h3 { font-size: 1.5rem; font-weight: 600; line-height: 1.3; }
        h4 { font-size: 1.25rem; font-weight: 500; line-height: 1.4; }
        h5 { font-size: 1.125rem; font-weight: 500; line-height: 1.4; }
        h6 { font-size: 1rem; font-weight: 500; line-height: 1.5; }

        /* Responsive font size */
        @media (max-width: 768px) {
            html { font-size: 15px; }
            h1 { font-size: 1.875rem; }
            h2 { font-size: 1.5rem; }
            h3 { font-size: 1.25rem; }
        }

        /* Đồng nhất font cho các element khác */
        p, span, a, li, td, th, label, input, button, select, textarea {
            font-family: inherit;
        }
    </style>
</head>
<body class="font-sans text-gray-800 bg-gray-50 min-h-screen flex flex-col" style="font-family: 'Roboto', sans-serif;">
    <!-- Header -->
    @include('layouts.partials.header')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- jQuery and jQuery UI -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="{{ asset('js/notyf.min.js') }}"></script>
    <script src="{{ asset('lightbox/dist/js/lightbox.min.js') }}"></script>
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

        // Mobile menu variables
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

        // Xử lý submenu cấp 1 - Sửa để xử lý cả href="#" và javascript:void(0)
        $(document).on('click', '.menu-item > a[href="#"], .menu-item > a[href="javascript:void(0)"]', function(e) {
            e.preventDefault();
            const $this = $(this);
            const $submenu = $this.siblings('.mobile-submenu');
            const $arrow = $this.find('.menu-arrow');

            // Chỉ xử lý trên mobile
            if ($(window).width() >= 768) {
                return;
            }

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

        // Xử lý submenu cấp 2 - Sửa để xử lý cả href="#" và javascript:void(0)
        $(document).on('click', '.submenu-item > a[href="#"], .submenu-item > a[href="javascript:void(0)"]', function(e) {
            e.preventDefault();
            const $this = $(this);
            const $nestedSubmenu = $this.siblings('.nested-submenu');
            const $arrow = $this.find('.menu-arrow');

            // Chỉ xử lý trên mobile
            if ($(window).width() >= 768) {
                return;
            }

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

    <!-- Force light mode JavaScript -->
    <script src="{{ asset('js/force-light.js') }}"></script>
</body>
</html>
