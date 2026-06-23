// === Swiper Slider Initialization ===
document.addEventListener('DOMContentLoaded', function () {
    // Helper function to initialize Swiper with error handling
    function initializeSwiper(container, options) {
        try {
            return new Swiper(container, options);
        } catch (e) {
            return null;
        }
    }

    // Scroll to top button functionality
    const scrollTopBtn = document.querySelector('.scroll-top');
    if (scrollTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.add('visible');
            } else {
                scrollTopBtn.classList.remove('visible');
            }
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Testimonial Slider Variant 1
    initializeSwiper('.testimonial_slider_variant1_swiper', {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: '.testimonial_slider_variant1 .swiper-button-next',
            prevEl: '.testimonial_slider_variant1 .swiper-button-prev',
        },
        pagination: {
            el: '.testimonial_slider_variant1 .swiper-pagination',
            clickable: true,
        },
        lazy: {
            loadPrevNext: true,
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 10 },
            576: { slidesPerView: 1, spaceBetween: 10 },
            768: { slidesPerView: 2, spaceBetween: 10 },
        },
    });

    // Testimonial Slider Variant 2
    const testimonialSlider2 = initializeSwiper('.testimonial_slider_variant2_swiper', {
        slidesPerView: 2,
        spaceBetween: 20,
        navigation: {
            nextEl: '.testimonial_slider_variant2 .swiper-button-next',
            prevEl: '.testimonial_slider_variant2 .swiper-button-prev',
        },
        pagination: {
            el: '.testimonial_slider_variant2 .swiper-pagination',
            clickable: true,
        },
        lazy: {
            loadPrevNext: true,
        },
        on: {
            slideChange: function () {
                document.querySelectorAll('.testimonial_slider_variant2_card').forEach(card => {
                    card.classList.remove('active-slide');
                });
                const activeSlides = document.querySelectorAll('.swiper-slide-active .testimonial_slider_variant2_card');
                activeSlides.forEach(card => {
                    card.classList.add('active-slide');
                });
            },
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 10 },
            576: { slidesPerView: 1, spaceBetween: 15 },
            768: { slidesPerView: 2, spaceBetween: 20 },
        },
    });
    if (testimonialSlider2) {
        const initialActiveSlides = document.querySelectorAll('.swiper-slide-active .testimonial_slider_variant2_card');
        initialActiveSlides.forEach(card => {
            card.classList.add('active-slide');
        });
    }

    // Testimonial Slider Variant 3
    initializeSwiper('.testimonial_slider_variant3_swiper', {
        slidesPerView: 1,
        spaceBetween: 50,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.testimonial_slider_variant3 .swiper-button-next',
            prevEl: '.testimonial_slider_variant3 .swiper-button-prev',
        },
        pagination: {
            el: '.testimonial_slider_variant3 .swiper-pagination',
            clickable: true,
        },
        lazy: {
            loadPrevNext: true,
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 20 },
            576: { slidesPerView: 1, spaceBetween: 30 },
            768: { slidesPerView: 1, spaceBetween: 50 },
        },
    });

    // Testimonial Slider Variant 4
    initializeSwiper('.testimonial_slider_variant4_swiper', {
        slidesPerView: 2,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.testimonial_slider_variant4 .swiper-button-next',
            prevEl: '.testimonial_slider_variant4 .swiper-button-prev',
        },
        pagination: {
            el: '.testimonial_slider_variant4 .swiper-pagination',
            clickable: true,
        },
        lazy: {
            loadPrevNext: true,
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 10 },
            576: { slidesPerView: 1, spaceBetween: 15 },
            768: { slidesPerView: 2, spaceBetween: 20 },
        },
    });

    // Testimonial Slider Variant 5
    initializeSwiper('.testimonial_slider_variant5_swiper', {
        slidesPerView: 2,
        spaceBetween: 40,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        effect: 'coverflow',
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
        },
        navigation: {
            nextEl: '.testimonial_slider_variant5 .swiper-button-next',
            prevEl: '.testimonial_slider_variant5 .swiper-button-prev',
        },
        pagination: {
            el: '.testimonial_slider_variant5 .swiper-pagination',
            clickable: true,
        },
        lazy: {
            loadPrevNext: true,
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 20 },
            576: { slidesPerView: 1, spaceBetween: 20 },
            768: { slidesPerView: 2, spaceBetween: 40 },
        },
    });

    // Testimonial Slider Variant 6
    initializeSwiper('.testimonial_slider_variant6_swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        effect: 'slide',
        navigation: {
            nextEl: '.testimonial_v6_next',
            prevEl: '.testimonial_v6_prev',
        },
        pagination: {
            el: '.testimonial_v6_pagination',
            clickable: true,
        },
        lazy: {
            loadPrevNext: true,
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 20 },
            576: { slidesPerView: 1, spaceBetween: 20 },
            768: { slidesPerView: 1, spaceBetween: 25 },
            992: { slidesPerView: 2, spaceBetween: 30 },
            1200: { slidesPerView: 2, spaceBetween: 30 },
        },
    });

    // Testimonial Slider Variant 7
    initializeSwiper('.testimonial_slider_variant7_swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        effect: 'slide',
        navigation: {
            nextEl: '.testimonial_slider_variant7 .testimonial-nav-next',
            prevEl: '.testimonial_slider_variant7 .testimonial-nav-prev',
        },
        pagination: {
            el: '.testimonial_slider_variant7 .swiper-pagination',
            clickable: true,
        },
        lazy: {
            loadPrevNext: true,
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 15 },
            576: { slidesPerView: 1, spaceBetween: 15 },
            768: { slidesPerView: 1, spaceBetween: 20 },
            992: { slidesPerView: 2, spaceBetween: 30 },
        },
    });

    // Testimonial Slider Variant 8
    initializeSwiper('.testimonial_slider_variant8__carousel', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        autoplay: {
            delay: 10000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.testimonial_slider_variant8 .swiper-button-next',
            prevEl: '.testimonial_slider_variant8 .swiper-button-prev',
        },
        pagination: {
            el: '.testimonial_slider_variant8 .swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 15 },
            576: { slidesPerView: 1, spaceBetween: 20 },
            768: { slidesPerView: 1, spaceBetween: 25 },
            992: { slidesPerView: 2, spaceBetween: 30 },
        },
    });

    // Testimonial Slider Variant 9
    initializeSwiper('.testimonial_slider_variant9__carousel', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 0,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.array-next',
            prevEl: '.array-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            768: { slidesPerView: 1 },
            992: { slidesPerView: 1 },
            1200: { slidesPerView: 1 },
        },
    });

    // Testimonial Slider Variant 10
    initializeSwiper('.testimonial_slider_variant10__carousel', {
        loop: true,
        slidesPerView: 2,
        spaceBetween: 20,
        autoplay: {
            delay: 10000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.testimonial_slider_variant10 .swiper-button-next',
            prevEl: '.testimonial_slider_variant10 .swiper-button-prev',
        },
        pagination: {
            el: '.testimonial_slider_variant10 .swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 15 },
            576: { slidesPerView: 1, spaceBetween: 15 },
            768: { slidesPerView: 2, spaceBetween: 20 },
            992: { slidesPerView: 2, spaceBetween: 20 },
        },
    });

    // Testimonial Slider Variant 11
    initializeSwiper('.testimonial_slider_variant11__carousel', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 20,
        autoplay: {
            delay: 10000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.variant11-next',
            prevEl: '.variant11-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            576: { slidesPerView: 1, spaceBetween: 10 },
            768: { slidesPerView: 1, spaceBetween: 15 },
        },
    });

    // Blog Slider Variant 1
    initializeSwiper('.blog_slider_variant1_swiper', {
        slidesPerView: 3,
        spaceBetween: 20,
        navigation: {
            nextEl: '.blog_slider_variant1 .swiper-button-next',
            prevEl: '.blog_slider_variant1 .swiper-button-prev',
        },
        pagination: {
            el: '.blog_slider_variant1 .swiper-pagination',
            clickable: true,
        },
        lazy: true,
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 10 },
            576: { slidesPerView: 2, spaceBetween: 15 },
            768: { slidesPerView: 3, spaceBetween: 20 },
        },
    });

    // Blog Slider Variant 2
    const blogSlider2 = initializeSwiper('.blog_slider_variant2_swiper', {
        slidesPerView: 3,
        spaceBetween: 20,
        navigation: {
            nextEl: '.blog_slider_variant2 .swiper-button-next',
            prevEl: '.blog_slider_variant2 .swiper-button-prev',
        },
        pagination: {
            el: '.blog_slider_variant2 .swiper-pagination',
            type: 'fraction',
        },
        lazy: true,
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 10 },
            576: { slidesPerView: 2, spaceBetween: 15 },
            768: { slidesPerView: 3, spaceBetween: 20 },
        },
    });
    if (blogSlider2) {
        const categories = document.querySelectorAll('.blog_slider_variant2_category');
        const slides = document.querySelectorAll('.blog_slider_variant2_swiper .swiper-slide');
        categories.forEach(category => {
            category.addEventListener('click', () => {
                categories.forEach(cat => cat.classList.remove('active'));
                category.classList.add('active');
                const selectedCategory = category.getAttribute('data-category');
                slides.forEach(slide => {
                    const slideCategory = slide.getAttribute('data-category');
                    slide.style.display = (selectedCategory === 'all' || selectedCategory === slideCategory) ? 'block' : 'none';
                });
                blogSlider2.update();
            });
        });
    }

    // Blog Slider Variant 3
    initializeSwiper('.blog_slider_variant3_swiper', {
        slidesPerView: 3,
        spaceBetween: 20,
        navigation: {
            nextEl: '.blog_slider_variant3 .swiper-button-next',
            prevEl: '.blog_slider_variant3 .swiper-button-prev',
        },
        pagination: {
            el: '.blog_slider_variant3 .swiper-pagination',
            clickable: true,
        },
        lazy: {
            loadPrevNext: true,
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 10 },
            576: { slidesPerView: 2, spaceBetween: 15 },
            768: { slidesPerView: 2, spaceBetween: 20 },
        },
    });

    // Slider Variant 1
    initializeSwiper('.slider_variant1-container .swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.slider_variant1-next',
            prevEl: '.slider_variant1-prev',
        },
        pagination: {
            el: '.slider_variant1-pagination',
            clickable: true,
        },
    });
});
// === End Swiper Slider Initialization ===

// === Pricing Toggle ===
const pricingToggle = document.getElementById('pricingToggle');
if (pricingToggle) {
    pricingToggle.addEventListener('change', function () {
        const monthlyPrices = document.querySelectorAll('.price.monthly');
        const yearlyPrices = document.querySelectorAll('.price.yearly');
        if (this.checked) {
            monthlyPrices.forEach(price => price.classList.add('hidden'));
            yearlyPrices.forEach(price => price.classList.remove('hidden'));
        } else {
            monthlyPrices.forEach(price => price.classList.remove('hidden'));
            yearlyPrices.forEach(price => price.classList.add('hidden'));
        }
    });
}
// === End Pricing Toggle ===

// === Header Slider ===
let currentSlide = 0;
const slides = document.querySelectorAll('.newheader-variant1-slider-image');
const dots = document.querySelectorAll('.newheader-variant1-slider-dots .dot');

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
    });
    dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
    });
    currentSlide = index;
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
}

function goToSlide(index) {
    showSlide(index);
}
// === End Header Slider ===

// === Header and Mobile Menu ===
document.addEventListener('DOMContentLoaded', () => {
    const headerWrapper = document.querySelector('.header_variant4-wrapper');
    const header = document.querySelector('.header_variant4');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const panels = document.querySelectorAll('.mm-panel');

    // Dynamic dropdowns
    const dropdownTriggers = document.querySelectorAll('.nav-item.dropdown');
    const dropdowns = Array.from(dropdownTriggers).map(trigger => ({
        trigger: trigger.id,
        menu: trigger.querySelector('.header_variant4-mega-submenu, .header_variant4-sub-menu').id
    }));

    // Safe event listener
    const addEvent = (el, event, callback) => {
        if (el) el.addEventListener(event, callback);
    };

    // Dropdown menu management
    dropdowns.forEach(({ trigger, menu }) => {
        const triggerEl = document.getElementById(trigger);
        const menuEl = document.getElementById(menu);
        let closeTimeout;

        addEvent(triggerEl, 'mouseenter', () => {
            clearTimeout(closeTimeout);
            dropdowns.forEach(d => {
                const otherMenu = document.getElementById(d.menu);
                if (otherMenu !== menuEl) {
                    otherMenu.style.cssText = 'display: none; opacity: 0; visibility: hidden;';
                }
            });
            menuEl.style.cssText = 'display: block; opacity: 1; visibility: visible;';
            headerWrapper.classList.add('scrolled');
            header.classList.add('scrolled');
        });

        addEvent(triggerEl, 'mouseleave', (e) => {
            closeTimeout = setTimeout(() => {
                if (!menuEl.contains(e.relatedTarget) && !triggerEl.contains(e.relatedTarget)) {
                    hideMenu(menuEl);
                }
            }, 200);
        });

        addEvent(menuEl, 'mouseenter', () => {
            clearTimeout(closeTimeout);
        });

        addEvent(menuEl, 'mouseleave', (e) => {
            closeTimeout = setTimeout(() => {
                if (!triggerEl.contains(e.relatedTarget) && !menuEl.contains(e.relatedTarget)) {
                    hideMenu(menuEl);
                }
            }, 200);
        });

        // Preserve sub-link click events
        const subLinks = menuEl.querySelectorAll('.sub-link');
        subLinks.forEach(link => {
            addEvent(link, 'click', (e) => {
                e.stopPropagation();
            });
        });
    });

    // Hide menu and manage scrolled class
    const hideMenu = (menuEl) => {
        menuEl.style.cssText = 'display: none; opacity: 0; visibility: hidden;';
        if (window.scrollY <= 50 && !dropdowns.some(d => document.getElementById(d.menu).style.visibility === 'visible')) {
            headerWrapper.classList.remove('scrolled');
            header.classList.remove('scrolled');
        }
    };

    // Mobile menu management
    const toggleMobileMenu = () => {
        mobileMenu.classList.toggle('active');
        mobileMenuToggle.classList.toggle('active');
        mobileMenuOverlay.classList.toggle('active');
        if (!mobileMenu.classList.contains('active')) resetPanels();
    };

    const resetPanels = () => {
        panels.forEach(panel => {
            panel.classList.remove('active', 'mm-panel--parent', 'mm-panel--opened');
            if (panel.id === 'mm-main') panel.classList.add('active', 'mm-panel--opened');
        });
    };

    addEvent(mobileMenuToggle, 'click', toggleMobileMenu);
    addEvent(mobileMenuOverlay, 'click', toggleMobileMenu);
    ['mobileMenuClose', 'mobileMenuCloseReservation', 'mobileMenuCloseTracking', 'mobileMenuCloseServices'].forEach(id => {
        addEvent(document.getElementById(id), 'click', (e) => {
            e.preventDefault();
            toggleMobileMenu();
        });
    });

    // Panel navigation
    document.querySelectorAll('.mm-btn--next').forEach(button => {
        addEvent(button, 'click', (e) => {
            e.preventDefault();
            const targetId = button.getAttribute('href').substring(1);
            const targetPanel = document.getElementById(targetId);
            const parentPanelId = targetPanel.getAttribute('data-mm-parent');
            const parentPanel = document.getElementById(parentPanelId);
            if (targetPanel && parentPanel) {
                panels.forEach(panel => panel.classList.remove('active', 'mm-panel--parent', 'mm-panel--opened'));
                parentPanel.classList.add('mm-panel--parent');
                targetPanel.classList.add('active', 'mm-panel--opened');
            }
        });
    });

    document.querySelectorAll('.mm-btn--prev').forEach(button => {
        addEvent(button, 'click', (e) => {
            e.preventDefault();
            const targetId = button.getAttribute('href').substring(1);
            const targetPanel = document.getElementById(targetId);
            if (targetPanel) {
                panels.forEach(panel => panel.classList.remove('active', 'mm-panel--parent', 'mm-panel--opened'));
                targetPanel.classList.add('active', 'mm-panel--opened');
            }
        });
    });

    // Scroll-based header changes
    addEvent(window, 'scroll', () => {
        const isMenuVisible = dropdowns.some(d => document.getElementById(d.menu).style.visibility === 'visible');
        if (window.scrollY > 50 && !isMenuVisible) {
            headerWrapper.classList.add('scrolled');
            header.classList.add('scrolled');
        } else if (window.scrollY <= 50 && !isMenuVisible) {
            headerWrapper.classList.remove('scrolled');
            header.classList.remove('scrolled');
        }
    });

    // Close mobile menu on resize
    addEvent(window, 'resize', () => {
        if (window.innerWidth >= 768 && mobileMenu && mobileMenuOverlay) {
            mobileMenu.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            resetPanels();
        }
    });
});
// === End Header and Mobile Menu ===

// === FAQ and Tabbed Functionality ===
document.addEventListener('DOMContentLoaded', () => {
    // Minimalist Accordion
    document.querySelectorAll('.faq_minimalist .faq-question').forEach(item => {
        item.addEventListener('click', () => {
            const answer = item.nextElementSibling;
            const isActive = answer.classList.contains('active');
            document.querySelectorAll('.faq_minimalist .faq-answer.active').forEach(activeAnswer => {
                activeAnswer.classList.remove('active');
                activeAnswer.previousElementSibling.classList.remove('active');
            });
            if (!isActive) {
                answer.classList.add('active');
                item.classList.add('active');
            }
        });
    });

    // Colorline Accordion
    document.querySelectorAll('.faq_colorline .faq-question').forEach(item => {
        item.addEventListener('click', () => {
            const answer = item.nextElementSibling;
            const parent = item.parentElement;
            const isActive = answer.classList.contains('active');
            document.querySelectorAll('.faq_colorline .faq-answer.active').forEach(activeAnswer => {
                activeAnswer.classList.remove('active');
                activeAnswer.parentElement.classList.remove('active');
            });
            if (!isActive) {
                answer.classList.add('active');
                parent.classList.add('active');
            }
        });
    });

    // Dark Accordion
    document.querySelectorAll('.faq_dark .faq-question').forEach(item => {
        item.addEventListener('click', () => {
            const answer = item.nextElementSibling;
            const parent = item.parentElement;
            const isActive = answer.classList.contains('active');
            document.querySelectorAll('.faq_dark .faq-answer.active').forEach(activeAnswer => {
                activeAnswer.classList.remove('active');
                activeAnswer.parentElement.classList.remove('active');
            });
            if (!isActive) {
                answer.classList.add('active');
                parent.classList.add('active');
            }
        });
    });

    // Retro Accordion
    document.querySelectorAll('.faq_retro .faq-question').forEach(item => {
        item.addEventListener('click', () => {
            const answer = item.nextElementSibling;
            const parent = item.parentElement;
            const isActive = answer.classList.contains('active');
            document.querySelectorAll('.faq_retro .faq-answer.active').forEach(activeAnswer => {
                activeAnswer.classList.remove('active');
                activeAnswer.parentElement.classList.remove('active');
            });
            if (!isActive) {
                answer.classList.add('active');
                parent.classList.add('active');
            }
        });
    });

    // Geometric Accordion
    document.querySelectorAll('.faq_geometric .faq-question').forEach(item => {
        item.addEventListener('click', () => {
            const answer = item.nextElementSibling;
            const parent = item.parentElement;
            const isActive = answer.classList.contains('active');
            document.querySelectorAll('.faq_geometric .faq-answer.active').forEach(activeAnswer => {
                activeAnswer.classList.remove('active');
                activeAnswer.parentElement.classList.remove('active');
            });
            if (!isActive) {
                answer.classList.add('active');
                parent.classList.add('active');
            }
        });
    });

    // Tabbed
    document.querySelectorAll('.faq_tabbed .faq-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            const tabId = tab.getAttribute('data-tab');
            document.querySelectorAll('.faq_tabbed .faq-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.faq_tabbed .faq-content-panel').forEach(panel => panel.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Vintage Tabbed
    document.querySelectorAll('.faq_vintage .faq-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            const tabId = tab.getAttribute('data-tab');
            document.querySelectorAll('.faq_vintage .faq-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.faq_vintage .faq-content-panel').forEach(panel => panel.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Neon Tabbed
    document.querySelectorAll('.faq_neon .faq-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            const tabId = tab.getAttribute('data-tab');
            document.querySelectorAll('.faq_neon .faq-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.faq_neon .faq-content-panel').forEach(panel => panel.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Vintage Minimalist Tabbed
    document.querySelectorAll('.faq_vintage_minimalist .faq-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            const tabId = tab.getAttribute('data-tab');
            document.querySelectorAll('.faq_vintage_minimalist .faq-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.faq_vintage_minimalist .faq-content-panel').forEach(panel => panel.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });
});
// === End FAQ and Tabbed Functionality ===

// === News Sliders ===
document.addEventListener('DOMContentLoaded', () => {
    // News Slider Variant 2
    new Swiper('.news_variant2 .swiper', {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.news_variant2 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.news_variant2 .swiper-button-next',
            prevEl: '.news_variant2 .swiper-button-prev',
        },
        breakpoints: {
            320: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            992: { slidesPerView: 3 },
        },
    });

    // News Slider Variant 3
    new Swiper('.news_variant3 .swiper', {
        slidesPerView: 2,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: '.news_variant3 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.news_variant3 .swiper-button-next',
            prevEl: '.news_variant3 .swiper-button-prev',
        },
        breakpoints: {
            320: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1200: { slidesPerView: 2 },
        },
    });

    // News Slider Variant 4
    new Swiper('.news_variant4 .swiper', {
        slidesPerView: 4,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: '.news_variant4 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.news_variant4 .swiper-button-next',
            prevEl: '.news_variant4 .swiper-button-prev',
        },
        breakpoints: {
            320: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            992: { slidesPerView: 3 },
            1200: { slidesPerView: 4 },
        },
    });

    // News Slider Variant 5
    new Swiper('.news_variant5 .swiper', {
        slidesPerView: 2,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.news_variant5 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.news_variant5 .swiper-button-next',
            prevEl: '.news_variant5 .swiper-button-prev',
        },
        breakpoints: {
            320: { slidesPerView: 1 },
            768: { slidesPerView: 1 },
            992: { slidesPerView: 2 },
        },
    });

    // News Slider Variant 6
    new Swiper('.news_variant6 .swiper', {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.news_variant6 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.news_variant6 .swiper-button-next',
            prevEl: '.news_variant6 .swiper-button-prev',
        },
        breakpoints: {
            320: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            992: { slidesPerView: 3 },
        },
    });

    // News Slider Variant 7
    new Swiper('.news_variant7 .swiper', {
        slidesPerView: 2,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.news_variant7 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.news_variant7 .swiper-button-next',
            prevEl: '.news_variant7 .swiper-button-prev',
        },
        breakpoints: {
            320: { slidesPerView: 1 },
            768: { slidesPerView: 1 },
            1200: { slidesPerView: 2 },
        },
    });
});
// === End News Sliders ===

// === Counter Animation ===
function animateCounter(id, end, duration) {
    let start = 0;
    const element = document.getElementById(id);
    if (!element) return;
    const increment = end / (duration / 16);
    const update = () => {
        start += increment;
        if (start >= end) {
            element.textContent = Math.floor(end);
            return;
        }
        element.textContent = Math.floor(start);
        requestAnimationFrame(update);
    };
    requestAnimationFrame(update);
}
// === End Counter Animation ===

// === Blog Category Filter ===
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.blog-list .category-filter .nav-link');
    if (buttons.length === 0) {
        return;
    }
    buttons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault(); // Bağlantının varsayılan davranışını engelle
            document.querySelectorAll('.blog-list .category-filter .nav-link').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const filter = button.getAttribute('data-filter') || '';
            document.querySelectorAll('.blog-list .grid-item').forEach(item => {
                const category = item.getAttribute('data-category') || '';
                item.classList.toggle('hidden', !(filter === 'all' || category === filter));
            });
        });
    });
});
// === End Blog Category Filter ===

// === Counter and Box Animation ===
document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.count');
    const boxes2 = document.querySelectorAll('.counter-variant2 .counter-box');
    const bars = document.querySelectorAll('.counter-variant3 .counter-box');
    const speed = 200;

    const animateCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const increment = target / speed;

        if (count < target) {
            counter.innerText = Math.ceil(count + increment);
            setTimeout(() => animateCounter(counter), 20);
        } else {
            counter.innerText = target;
        }
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('count')) {
                    animateCounter(entry.target);
                } else if (entry.target.classList.contains('counter-box')) {
                    entry.target.classList.add('visible');
                }
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    counters.forEach(counter => observer.observe(counter));
    boxes2.forEach(box => observer.observe(box));
    bars.forEach(bar => observer.observe(bar));

    document.querySelectorAll('.blog-list .grid-item').forEach(item => item.classList.remove('hidden'));
});
// === End Counter and Box Animation ===

// === References Sliders ===
document.addEventListener('DOMContentLoaded', () => {
    // References Variant 1 Slider
    new Swiper('.references-variant1-slider', {
        slidesPerView: 2,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: '.references-variant1-pagination',
            clickable: true,
        },
        breakpoints: {
            768: { slidesPerView: 3, spaceBetween: 30 },
            992: { slidesPerView: 4, spaceBetween: 30 },
        },
    });

    // References Variant 2 Slider
    new Swiper('.references-variant2-slider', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        navigation: {
            nextEl: '.references-variant2-button-next',
            prevEl: '.references-variant2-button-prev',
        },
        breakpoints: {
            992: { slidesPerView: 2, spaceBetween: 30 },
        },
    });

    // References Variant 3 Slider (Marquee)
    new Swiper('.references-variant3-slider', {
        slidesPerView: 2,
        spaceBetween: 0,
        speed: 6000,
        loop: true,
        allowTouchMove: false,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },
        breakpoints: {
            768: { slidesPerView: 3 },
            992: { slidesPerView: 4 },
            1200: { slidesPerView: 4 },
        },
    });
});
// === End References Sliders ===

// === Team Sliders ===
document.addEventListener('DOMContentLoaded', () => {
    // Team Swiper 2
    new Swiper('.team-swiper-2', {
        slidesPerView: 2,
        spaceBetween: 20,
        navigation: {
            nextEl: '.team-variant2 .swiper-button-next',
            prevEl: '.team-variant2 .swiper-button-prev',
        },
        breakpoints: {
            992: { slidesPerView: 4 },
        },
    });

    // Team Swiper 3
    new Swiper('.team-swiper-3', {
        slidesPerView: 2,
        spaceBetween: 20,
        navigation: {
            nextEl: '.team-variant3 .swiper-button-next',
            prevEl: '.team-variant3 .swiper-button-prev',
        },
        breakpoints: {
            992: { slidesPerView: 4 },
        },
    });
});
// === End Team Sliders ===

// === Fancybox Initialization ===
if (typeof Fancybox !== 'undefined') {
    Fancybox.bind("[data-fancybox]", {
        Thumbs: {
            autoStart: true,
        },
    });
}
// === End Fancybox Initialization ===

// === Gallery Category Filter ===
document.addEventListener('DOMContentLoaded', () => {
    // Initialize gallery filter on page load
    const initializeGalleryFilter = () => {
        const filterButtons = document.querySelectorAll('.gallery-filter-btn');
        if (filterButtons.length === 0) {
            return;
        }

        // Show all items by default (for "Tümünü Göster" button)
        const showAllItems = () => {
            const items = document.querySelectorAll('.gallery-item');
            items.forEach((item) => {
                item.classList.add('show');
                item.parentElement.style.display = 'block';
            });
        };

        // Show items by category
        const showItemsByCategory = (category) => {
            document.querySelectorAll('.gallery-item').forEach(item => {
                const itemCategory = item.getAttribute('gallery-data-category');
                if (itemCategory === category) {
                    item.classList.add('show');
                    item.parentElement.style.display = 'block';
                } else {
                    item.classList.remove('show');
                    item.parentElement.style.display = 'none';
                }
            });
        };

        // Add click event listeners
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                document.querySelectorAll('.gallery-filter-btn').forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                button.classList.add('active');

                const filter = button.getAttribute('gallery-data-filter');
                if (filter === 'all') {
                    showAllItems();
                } else {
                    showItemsByCategory(filter);
                }
            });
        });

        // Initialize with "Tümünü Göster" active
        const allButton = document.querySelector('.gallery-filter-btn[gallery-data-filter="all"]');
        if (allButton) {
            showAllItems();
        } else {
            showAllItems();
        }
    };

    // Initialize when DOM is ready
    initializeGalleryFilter();
});
// === End Gallery Category Filter ===

    // === Request Form Stepper (Variant 3) ===
    document.addEventListener('DOMContentLoaded', function() {
        // Stepper form functionality for Variant 3
        const stepperButtons = document.querySelectorAll('[data-next], [data-prev]');
        const formSteps = document.querySelectorAll('.request_form_variant3_step_content');
        const stepperSteps = document.querySelectorAll('.request_form_variant3_step');

        stepperButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const targetStep = this.getAttribute('data-next') || this.getAttribute('data-prev');

                // Update form steps
                formSteps.forEach(step => {
                    step.classList.remove('request_form_variant3_step_active');
                    if (step.getAttribute('data-step') === targetStep) {
                        step.classList.add('request_form_variant3_step_active');
                    }
                });

                // Update stepper indicators
                stepperSteps.forEach(step => {
                    step.classList.remove('request_form_variant3_step_active');
                    if (step.getAttribute('data-step') === targetStep) {
                        step.classList.add('request_form_variant3_step_active');
                    }
                });

                // Update review values in step 3
                if (targetStep === '3') {
                    updateReviewValues();
                }
            });
        });

        // Function to update review values
        function updateReviewValues() {
            const nameInput = document.querySelector('.request_form_variant3_form input[name="name"]');
            const emailInput = document.querySelector('.request_form_variant3_form input[name="email"]');
            const phoneInput = document.querySelector('.request_form_variant3_form input[name="phone"]');
            const topicSelect = document.querySelector('.request_form_variant3_form select[name="topic"]');
            const messageTextarea = document.querySelector('.request_form_variant3_form textarea[name="message"]');

            const reviewName = document.getElementById('review_name');
            const reviewEmail = document.getElementById('review_email');
            const reviewPhone = document.getElementById('review_phone');
            const reviewTopic = document.getElementById('review_topic');
            const reviewMessage = document.getElementById('review_message');

            if (nameInput && reviewName) {
                reviewName.textContent = nameInput.value || 'Belirtilmemiş';
            }

            if (emailInput && reviewEmail) {
                reviewEmail.textContent = emailInput.value || 'Belirtilmemiş';
            }

            if (phoneInput && reviewPhone) {
                reviewPhone.textContent = phoneInput.value || 'Belirtilmemiş';
            }

            if (topicSelect && reviewTopic) {
                reviewTopic.textContent = topicSelect.value || 'Belirtilmemiş';
            }

            if (messageTextarea && reviewMessage) {
                reviewMessage.textContent = messageTextarea.value || 'Belirtilmemiş';
            }
        }
    });

// === Request Form Enhancements ===
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth focus animations to all form inputs
    const formInputs = document.querySelectorAll('.request_form_variant1_input, .request_form_variant2_input, .request_form_variant3_input, .request_form_variant4_input, .request_form_variant5_input, .request_form_variant6_input, .request_form_variant7_input');

    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });

    // Add loading states to all form buttons
    const formButtons = document.querySelectorAll('.request_form_variant1_button, .request_form_variant2_button, .request_form_variant3_button, .request_form_variant4_button, .request_form_variant5_button, .request_form_variant6_button, .request_form_variant7_button');

    formButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.type === 'submit') {
                this.classList.add('loading');
                this.disabled = true;

                // Re-enable after 3 seconds (fallback)
                setTimeout(() => {
                    this.classList.remove('loading');
                    this.disabled = false;
                }, 3000);
            }
        });
    });

    // Add phone number formatting
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.startsWith('0')) {
                    value = value.replace(/(\d{4})(\d{3})(\d{2})(\d{2})/, '$1 $2 $3 $4');
                } else {
                    value = value.replace(/(\d{3})(\d{3})(\d{2})(\d{2})/, '$1 $2 $3 $4');
                }
            }
            this.value = value;
        });
    });

    // Add email validation
    const emailInputs = document.querySelectorAll('input[type="email"]');
    emailInputs.forEach(input => {
        input.addEventListener('blur', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && !emailRegex.test(this.value)) {
                this.classList.add('error');
                this.setAttribute('title', 'Geçerli bir e-posta adresi girin');
            } else {
                this.classList.remove('error');
                this.removeAttribute('title');
            }
        });
    });

    // Add character counter for textareas
    const textareas = document.querySelectorAll('.request_form_variant1_textarea, .request_form_variant2_textarea, .request_form_variant3_textarea, .request_form_variant4_textarea, .request_form_variant5_textarea, .request_form_variant6_textarea, .request_form_variant7_textarea');
    textareas.forEach(textarea => {
        const maxLength = 500;
        const counter = document.createElement('div');
        counter.className = 'char-counter';
        counter.style.cssText = 'text-align: right; font-size: 0.75rem; color: #718096; margin-top: 0.25rem;';

        // Check if parentElement exists before appending
        if (textarea.parentElement) {
            textarea.parentElement.appendChild(counter);
        } else {
            // Textarea parent element not found, skipping counter
            return;
        }

        function updateCounter() {
            const remaining = maxLength - textarea.value.length;
            counter.textContent = `${remaining} karakter kaldı`;
            counter.style.color = remaining < 50 ? '#e53e3e' : '#718096';
        }

        textarea.addEventListener('input', updateCounter);
        updateCounter();
    });
});

// === Form Validation Enhancement ===
document.addEventListener('DOMContentLoaded', function() {
    // Custom validation messages
    const forms = document.querySelectorAll('.request_form_variant1_form, .request_form_variant2_form, .request_form_variant3_form, .request_form_variant4_form, .request_form_variant5_form, .request_form_variant6_form, .request_form_variant7_form');

    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredInputs = this.querySelectorAll('input[required], select[required], textarea[required]');
            let isValid = true;

            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('error');
                    isValid = false;
                } else {
                    input.classList.remove('error');
                }
            });

            if (!isValid) {
                e.preventDefault();

                // Scroll to first error
                const firstError = this.querySelector('.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });
    });

    // Real-time validation
    const allInputs = document.querySelectorAll('input, select, textarea');
    allInputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.classList.add('error');
            } else {
                this.classList.remove('error');
            }
        });

        input.addEventListener('input', function() {
            if (this.classList.contains('error') && this.value.trim()) {
                this.classList.remove('error');
            }
        });
    });
});

// === AOS Animation Enhancement ===
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
    }

    // Fallback animation for elements without AOS
    const animatedElements = document.querySelectorAll('[data-aos]');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });

    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'all 0.8s ease';
        observer.observe(element);
    });
});

// === Counter Animation ===
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.counter_v1_number, .counter_v2_number, .counter_v3_number, .counter_v4_number');

    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.ceil(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };

        updateCounter();
    };

    // Intersection Observer for scroll animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                entry.target.classList.add('animated');
                animateCounter(entry.target);
            }
        });
    }, {
        threshold: 0.5
    });

    counters.forEach(counter => {
        observer.observe(counter);
    });
});
