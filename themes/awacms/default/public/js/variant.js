// Combined JavaScript from faq.html and comment.html

// -----------------------------------
// JavaScript from faq.html: FAQ Toggle
// -----------------------------------
document.querySelectorAll('.faq-question').forEach(item => {
    item.addEventListener('click', () => {
        const parent = item.parentElement;
        parent.classList.toggle('active');
    });
});

// -----------------------------------
// JavaScript from comment.html: Swiper Initializations
// -----------------------------------
document.addEventListener('DOMContentLoaded', function () {
    // Varyant 1 için Swiper
    new Swiper('.variant-1', {
        loop: true,
        slidesPerView: 3,
        spaceBetween: 5,
        centeredSlides: true,
        navigation: {
            nextEl: '.variant-1 .swiper-button-next',
            prevEl: '.variant-1 .swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    // Varyant 2 için Swiper
    new Swiper('.variant-2', {
        loop: true,
        slidesPerView: 3,
        spaceBetween: 5,
        centeredSlides: true,
        navigation: {
            nextEl: '.variant-2 .swiper-button-next',
            prevEl: '.variant-2 .swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    // Varyant 3 için Swiper
    new Swiper('.variant-3', {
        loop: true,
        slidesPerView: 3,
        spaceBetween: 5,
        centeredSlides: true,
        navigation: {
            nextEl: '.variant-3 .swiper-button-next',
            prevEl: '.variant-3 .swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    // Varyant 4 için Swiper
    new Swiper('.variant-4', {
        loop: true,
        slidesPerView: 3,
        spaceBetween: 5,
        centeredSlides: true,
        navigation: {
            nextEl: '.variant-4 .swiper-button-next',
            prevEl: '.variant-4 .swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    // Varyant 5 için Swiper
    new Swiper('.variant-5', {
        loop: true,
        slidesPerView: 3,
        spaceBetween: 5,
        centeredSlides: true,
        navigation: {
            nextEl: '.variant-5 .swiper-button-next',
            prevEl: '.variant-5 .swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    // Varyant 6 için Swiper
    new Swiper('.variant-6', {
        loop: true,
        slidesPerView: 3,
        spaceBetween: 5,
        centeredSlides: true,
        navigation: {
            nextEl: '.variant-6 .swiper-button-next',
            prevEl: '.variant-6 .swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    // Varyant 7 için Swiper
    new Swiper('.variant-7', {
        loop: true,
        slidesPerView: 3,
        spaceBetween: 15,
        centeredSlides: true,
        navigation: {
            nextEl: '.variant-7 .swiper-button-next',
            prevEl: '.variant-7 .swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });
});