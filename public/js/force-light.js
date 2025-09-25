// Force light mode - disable dark mode completely
(function() {
    'use strict';

    // Set color scheme to light only
    document.documentElement.style.setProperty('color-scheme', 'light');

    // Force light mode styles
    function forceLightMode() {
        document.documentElement.style.backgroundColor = '#ffffff';
        document.documentElement.style.color = '#000000';
        document.body.style.backgroundColor = '#ffffff';
        document.body.style.color = '#000000';

        // Mobile specific fixes
        if (window.innerWidth <= 768) {
            const allElements = document.querySelectorAll('*');
            allElements.forEach(el => {
                // Override any dark text colors
                if (el.style.color === '' ||
                    el.style.color === 'rgb(255, 255, 255)' ||
                    el.style.color === 'white' ||
                    el.classList.contains('text-white') ||
                    el.classList.contains('dark:text-gray-100')) {
                    el.style.color = '#000000';
                }

                // Override any dark backgrounds
                if (el.classList.contains('bg-gray-900') ||
                    el.classList.contains('bg-black') ||
                    el.classList.contains('dark:bg-gray-900')) {
                    el.style.backgroundColor = '#ffffff';
                }
            });
        }
    }

    // Run on load
    forceLightMode();

    // Run on resize (mobile orientation change)
    window.addEventListener('resize', forceLightMode);

    // Run when DOM changes
    const observer = new MutationObserver(forceLightMode);
    observer.observe(document.body, { childList: true, subtree: true });
})();
