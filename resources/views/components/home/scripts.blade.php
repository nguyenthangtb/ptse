<script>
// Initialize Swiper Slider
const heroSlider = new Swiper('.hero-slider', {
    // Optional parameters
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
    speed: 2000,

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // Pagination
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});

// Handle header spacing dynamically
let lastScrollTop = 0;
const heroSection = document.querySelector('.hero-slider').closest('section');
const header = document.querySelector('header');

// Initial adjustment
adjustHeroSpacing();

// Adjust spacing when window loads
window.addEventListener('load', adjustHeroSpacing);

// Adjust spacing when window resizes
window.addEventListener('resize', adjustHeroSpacing);

// Adjust spacing when scrolling
window.addEventListener('scroll', function() {
    adjustHeroSpacing();
});

function adjustHeroSpacing() {
    if (header && heroSection) {
        const headerHeight = header.offsetHeight;
        heroSection.style.paddingTop = headerHeight + 'px';
        // Add console log to help debug
        console.log('Header height:', headerHeight);

        // Add a resize observer to handle dynamic header height changes
        if (!window.headerResizeObserver) {
            window.headerResizeObserver = new ResizeObserver(() => {
                const newHeaderHeight = header.offsetHeight;
                heroSection.style.paddingTop = newHeaderHeight + 'px';
                console.log('Header height updated:', newHeaderHeight);
            });
            window.headerResizeObserver.observe(header);
        }
    }
}

// Initialize Notyf
const notyf = new Notyf({
    duration: 5000,
    position: {
        x: 'right',
        y: 'top'
    }
});
$(document).ready(function() {
    $('.ajaxForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/lien-he',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status == 200) {
                    notyf.success(response.message);
                    $('.ajaxForm')[0].reset();
                } else {
                    notyf.error(response.message);
                }
            },
            error: function(xhr) {
                notyf.error(response.message);
            }
        });
    });
});
</script>
