<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Mobile menu toggle
            $('#menuToggle').click(function() {
                $('#navMenu').toggleClass('hidden');
            });

            // Mobile dropdown toggle
            $('.dropdown-toggle').click(function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    $(this).siblings('.dropdown-menu').toggleClass('hidden');
                }
            });

            // Close menu when clicking outside
            $(document).click(function(e) {
                if (!$(e.target).closest('#navMenu, #menuToggle').length) {
                    if (window.innerWidth <= 768) {
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
        });
    </script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script>
        ScrollReveal().reveal('.reveal', {
            distance: '50px',
            duration: 1000,
            easing: 'cubic-bezier(0.5, 0, 0, 1)',
            interval: 100
        });
    </script>
    @yield('scripts')
</body>
</html>
