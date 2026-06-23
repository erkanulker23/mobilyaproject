<section class="google-reviews-section variant-2" @if($bgColor) style="background-color: {{ $bgColor }};" @endif>
    @if($bgImage)
    <div class="section-bg" style="background-image: url('{{ $bgImage }}');"></div>
    @endif

    <div class="container">
        @if($title || $subtitle)
        <div class="section-header text-center">
            @if($title)
            <h2 class="section-title classic">{{ $title }}</h2>
            @endif
            @if($subtitle)
            <div class="title-divider"></div>
            <p class="section-subtitle">{{ $subtitle }}</p>
            @endif
        </div>
        @endif

        <div class="swiper google-reviews-swiper-v2">
            <div class="swiper-wrapper">
                @foreach($reviews as $review)
                <div class="swiper-slide">
                    <div class="review-card classic-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>

                        <div class="review-rating centered">
                            {!! $review->getStarsHtml() !!}
                        </div>

                        <div class="review-content">
                            <p>{{ $review->review_text }}</p>
                        </div>

                        <div class="review-footer">
                            <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar small">
                            <div class="reviewer-info">
                                <h4 class="reviewer-name">{{ $review->display_name }}</h4>
                                <span class="review-date">{{ $review->review_date->format('d.m.Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

        @if($reviewUrl && $reviewUrl !== '#')
        <div class="review-cta-section">
            <a href="{{ $reviewUrl }}" target="_blank" rel="nofollow noopener" class="review-cta-button">
                <i class="fab fa-google"></i>
                <span>Bizi Değerlendirin</span>
            </a>
        </div>
        @endif
    </div>
</section>

<style>
.google-reviews-section.variant-2 {
    padding: 80px 0;
    position: relative;
    background: #fff;
}

.variant-2 .section-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0.05;
    z-index: 0;
}

.variant-2 .section-header {
    margin-bottom: 50px;
    position: relative;
    z-index: 1;
}

.variant-2 .section-title.classic {
    font-size: 40px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 15px 0;
}

.variant-2 .title-divider {
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #4285F4 0%, #34A853 100%);
    margin: 0 auto 15px;
    border-radius: 2px;
}

.variant-2 .section-subtitle {
    font-size: 16px;
    color: #666;
    margin: 0;
}

.google-reviews-swiper-v2 {
    position: relative;
    padding: 10px 10px 60px;
}

.variant-2 .review-card.classic-card {
    background: linear-gradient(135deg, #fff 0%, #f9f9f9 100%);
    border-radius: 15px;
    padding: 40px 30px 30px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 2px solid #f0f0f0;
    position: relative;
}

.variant-2 .review-card.classic-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 35px rgba(0,0,0,0.15);
    border-color: #34A853;
}

.variant-2 .quote-icon {
    text-align: center;
    margin-bottom: 20px;
}

.variant-2 .quote-icon i {
    font-size: 40px;
    color: #4285F4;
    opacity: 0.2;
}

.variant-2 .review-rating.centered {
    display: flex;
    justify-content: center;
    gap: 4px;
    margin-bottom: 20px;
}

.variant-2 .review-rating i {
    color: #FBBC05;
    font-size: 20px;
}

.variant-2 .review-content {
    flex: 1;
    margin-bottom: 25px;
    text-align: center;
    max-height: 160px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #34A853 #f0f0f0;
}

.variant-2 .review-content::-webkit-scrollbar {
    width: 6px;
}

.variant-2 .review-content::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}

.variant-2 .review-content::-webkit-scrollbar-thumb {
    background: #34A853;
    border-radius: 10px;
}

.variant-2 .review-content p {
    font-size: 15px;
    line-height: 1.8;
    color: #4a4a4a;
    margin: 0;
    font-style: italic;
    padding: 0 10px;
}

.variant-2 .review-footer {
    display: flex;
    align-items: center;
    gap: 15px;
    padding-top: 20px;
    border-top: 2px solid #f0f0f0;
    justify-content: center;
}

.variant-2 .review-avatar.small {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #34A853;
}

.variant-2 .reviewer-info {
    text-align: left;
}

.variant-2 .reviewer-name {
    font-size: 16px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 3px 0;
}

.variant-2 .review-date {
    font-size: 13px;
    color: #999;
}

.google-reviews-swiper-v2 .swiper-button-next,
.google-reviews-swiper-v2 .swiper-button-prev {
    width: 45px;
    height: 45px;
    background: #4285F4;
    border-radius: 10px;
}

.google-reviews-swiper-v2 .swiper-button-next::after,
.google-reviews-swiper-v2 .swiper-button-prev::after {
    font-size: 16px;
    color: white;
    font-weight: 900;
    font-family: 'Font Awesome 6 Free';
}

.google-reviews-swiper-v2 .swiper-button-next::after {
    content: '\f054';
}

.google-reviews-swiper-v2 .swiper-button-prev::after {
    content: '\f053';
}

.google-reviews-swiper-v2 .swiper-pagination {
    bottom: 20px;
}

.google-reviews-swiper-v2 .swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background: #34A853;
    opacity: 0.3;
}

.google-reviews-swiper-v2 .swiper-pagination-bullet-active {
    opacity: 1;
    width: 25px;
    border-radius: 5px;
}

.variant-2 .review-cta-section {
    text-align: center;
    margin-top: 40px;
}

.variant-2 .review-cta-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #4285F4;
    color: white;
    padding: 15px 35px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(66, 133, 244, 0.3);
    transition: all 0.3s ease;
}

.variant-2 .review-cta-button:hover {
    background: #34A853;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(52, 168, 83, 0.4);
    color: white;
}

.variant-2 .review-cta-button i {
    font-size: 20px;
}

@media (max-width: 768px) {
    .variant-2 .section-title.classic {
        font-size: 30px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.google-reviews-swiper-v2', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 5500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.google-reviews-swiper-v2 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.google-reviews-swiper-v2 .swiper-button-next',
            prevEl: '.google-reviews-swiper-v2 .swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 25,
            },
        },
    });
});
</script>
