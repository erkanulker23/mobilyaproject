/**
 * Google Review Widget JavaScript
 * Handles slider functionality and masonry layout
 */

class GoogleReviewWidget {
    constructor(element) {
        this.element = element;
        this.widgetId = element.dataset.widgetId;
        this.init();
    }

    init() {
        // Initialize based on layout type
        if (this.element.classList.contains('slider-layout')) {
            this.initSlider();
        }

        if (this.element.classList.contains('masonry-layout')) {
            this.initMasonry();
        }

        // Add responsive behavior
        this.handleResize();
    }

    /**
     * Initialize Slider
     */
    initSlider() {
        const slider = this.element.querySelector('.reviews-slider');
        if (!slider) return;

        const wrapper = slider.querySelector('.slider-wrapper');
        const slides = wrapper.querySelectorAll('.review-slide');
        const prevBtn = slider.querySelector('.slider-nav.prev');
        const nextBtn = slider.querySelector('.slider-nav.next');
        const paginationContainer = slider.querySelector('.slider-pagination');

        let currentSlide = 0;
        let autoplayInterval = null;

        // Settings
        const autoplay = slider.dataset.autoplay === 'true';
        const autoplaySpeed = parseInt(slider.dataset.autoplaySpeed) || 3000;
        const showNavigation = slider.dataset.showNavigation === 'true';
        const showPagination = slider.dataset.showPagination === 'true';

        // Create pagination dots
        if (showPagination && paginationContainer) {
            slides.forEach((_, index) => {
                const dot = document.createElement('span');
                dot.className = 'pagination-dot';
                if (index === 0) dot.classList.add('active');
                dot.addEventListener('click', () => goToSlide(index));
                paginationContainer.appendChild(dot);
            });
        }

        // Go to specific slide
        const goToSlide = (index) => {
            if (index < 0) index = slides.length - 1;
            if (index >= slides.length) index = 0;

            currentSlide = index;
            wrapper.style.transform = `translateX(-${currentSlide * 100}%)`;

            // Update pagination
            if (showPagination && paginationContainer) {
                paginationContainer.querySelectorAll('.pagination-dot').forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentSlide);
                });
            }

            // Reset autoplay
            if (autoplay) {
                clearInterval(autoplayInterval);
                startAutoplay();
            }
        };

        // Navigation
        if (showNavigation) {
            if (prevBtn) {
                prevBtn.addEventListener('click', () => goToSlide(currentSlide - 1));
            }
            if (nextBtn) {
                nextBtn.addEventListener('click', () => goToSlide(currentSlide + 1));
            }
        }

        // Autoplay
        const startAutoplay = () => {
            if (!autoplay) return;
            autoplayInterval = setInterval(() => {
                goToSlide(currentSlide + 1);
            }, autoplaySpeed);
        };

        // Touch/Swipe support
        let touchStartX = 0;
        let touchEndX = 0;

        slider.addEventListener('touchstart', (e) => {
            touchStartX = e.touches[0].clientX;
        });

        slider.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].clientX;
            handleSwipe();
        });

        const handleSwipe = () => {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe left - next
                    goToSlide(currentSlide + 1);
                } else {
                    // Swipe right - prev
                    goToSlide(currentSlide - 1);
                }
            }
        };

        // Pause autoplay on hover
        if (autoplay) {
            slider.addEventListener('mouseenter', () => {
                clearInterval(autoplayInterval);
            });

            slider.addEventListener('mouseleave', () => {
                startAutoplay();
            });

            startAutoplay();
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                goToSlide(currentSlide - 1);
            } else if (e.key === 'ArrowRight') {
                goToSlide(currentSlide + 1);
            }
        });
    }

    /**
     * Initialize Masonry Layout
     */
    initMasonry() {
        const masonry = this.element.querySelector('.reviews-masonry');
        if (!masonry) return;

        // Set column count based on viewport
        const updateColumns = () => {
            const width = window.innerWidth;
            const columns = masonry.dataset.columns || 3;

            if (width < 768) {
                masonry.style.columnCount = 1;
            } else if (width < 1024) {
                masonry.style.columnCount = 2;
            } else {
                masonry.style.columnCount = columns;
            }
        };

        updateColumns();
        window.addEventListener('resize', updateColumns);
    }

    /**
     * Handle responsive behavior
     */
    handleResize() {
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                this.updateLayout();
            }, 250);
        });
    }

    /**
     * Update layout on resize
     */
    updateLayout() {
        // Grid adjustments
        if (this.element.classList.contains('grid-layout')) {
            const grid = this.element.querySelector('.reviews-grid');
            if (grid && window.innerWidth < 768) {
                grid.style.gridTemplateColumns = '1fr';
            }
        }
    }
}

/**
 * Initialize all widgets on page
 */
document.addEventListener('DOMContentLoaded', () => {
    const widgets = document.querySelectorAll('.google-review-widget');
    widgets.forEach(widget => {
        new GoogleReviewWidget(widget);
    });
});

/**
 * AJAX Widget Loader
 * Load widget content via AJAX
 */
class GoogleReviewWidgetLoader {
    static async load(widgetId, container) {
        try {
            container.classList.add('review-widget-loading');

            const response = await fetch(`/google-reviews/widget/${widgetId}/json`);
            const data = await response.json();

            // Render the widget
            this.render(data, container);

            container.classList.remove('review-widget-loading');

            // Initialize the widget
            new GoogleReviewWidget(container);
        } catch (error) {
            // Failed to load Google Review widget
            container.innerHTML = '<div class="review-widget-error">Failed to load reviews</div>';
        }
    }

    static render(data, container) {
        // This is a basic implementation
        // You can customize the rendering based on your needs
        const { widget, reviews, settings } = data;

        let html = `<div class="review-widget-container">`;

        if (widget.name) {
            html += `<div class="widget-header"><h2 class="widget-title">${widget.name}</h2></div>`;
        }

        html += `<div class="reviews-grid">`;

        reviews.forEach(review => {
            html += `
                <div class="review-card">
                    <div class="card-inner">
                        <div class="review-header">
                            ${settings.show_avatar ? `<img src="${review.avatar_url}" alt="${review.reviewer_name}" class="review-avatar">` : ''}
                            <div class="reviewer-info">
                                ${settings.show_reviewer_name ? `<h3 class="reviewer-name">${review.reviewer_name}</h3>` : ''}
                                ${settings.show_date ? `<span class="review-date">${review.review_date}</span>` : ''}
                            </div>
                        </div>
                        ${settings.show_rating ? `<div class="review-rating">${review.stars_html}</div>` : ''}
                        <div class="review-content"><p>${review.review_text}</p></div>
                    </div>
                </div>
            `;
        });

        html += `</div></div>`;

        container.innerHTML = html;
    }
}

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { GoogleReviewWidget, GoogleReviewWidgetLoader };
}

