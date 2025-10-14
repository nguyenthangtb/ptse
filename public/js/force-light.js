// Force light mode - disable dark mode completely
(function() {
    'use strict';

    // Set color scheme to light only
    document.documentElement.style.setProperty('color-scheme', 'light');

    let isProcessing = false;

    // Force light mode styles
    function forceLightMode() {
        if (isProcessing) return; // Ngăn chặn vòng lặp
        isProcessing = true;

        document.documentElement.style.backgroundColor = '#ffffff';
        document.body.style.backgroundColor = '#ffffff';

        // Mobile specific fixes
        if (window.innerWidth <= 768) {
            // CHỈ target các elements CẦN THIẾT, không loop hết
            const darkBackgrounds = document.querySelectorAll('.bg-gray-900, .bg-black, .dark\\:bg-gray-900');
            darkBackgrounds.forEach(el => {
                el.style.backgroundColor = '#ffffff';
            });
        }

        setTimeout(() => {
            isProcessing = false;
        }, 100);
    }

    // Run on load
    forceLightMode();

    // Run on resize (debounced)
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(forceLightMode, 250);
    });

    // Throttle MutationObserver
    const observer = new MutationObserver(function() {
        if (!isProcessing) {
            requestAnimationFrame(forceLightMode);
        }
    });

    observer.observe(document.body, {
        childList: true,
        subtree: false // CHỈ observe direct children, không deep
    });
})();
