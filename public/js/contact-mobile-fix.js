$(document).ready(function() {
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
            $('body').addClass('menu-open').css('overflow', 'hidden');
            $menuToggle.css('visibility', 'hidden');

            // Disable iframe interactions when menu is open
            $('iframe').css('pointer-events', 'none');
        } else {
            $mobileMenu.addClass('opacity-0');
            $menuContent.addClass('translate-x-full');
            $menuToggle.css('visibility', 'visible');

            setTimeout(() => {
                $mobileMenu.addClass('invisible');
            }, 300);

            $('body').removeClass('menu-open').css('overflow', '');

            // Re-enable iframe interactions when menu is closed
            $('iframe').css('pointer-events', 'auto');
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

    // Close menu on escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && isOpen) {
            toggleMainMenu();
        }
    });

    // Close menu when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#mobileMenu, #menuToggle').length && isOpen) {
            toggleMainMenu();
        }
    });
});
