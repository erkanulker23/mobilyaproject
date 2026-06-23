<section class="google-reviews-section variant-1" @if($bgColor) style="background-color: {{ $bgColor }};" @endif>
    @if($bgImage)
    <div class="section-bg" style="background-image: url('{{ $bgImage }}');"></div>
    @endif

    <div class="container">
        @if($title || $subtitle)
        <div class="section-header text-center">
            @if($subtitle)
            <span class="section-subtitle">{{ $subtitle }}</span>
            @endif
            @if($title)
            <h2 class="section-title">{{ $title }}</h2>
            @endif
        </div>
        @endif

        <div class="swiper google-reviews-swiper-v1">
            <div class="swiper-wrapper">
                @foreach($reviews as $review)
                <div class="swiper-slide">
                    <div class="review-card modern-card">
                        <div class="card-inner">
                            <div class="review-header">
                                <div class="avatar-wrapper">
                                    <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar">
                                </div>
                                <div class="reviewer-info">
                                    <h3 class="reviewer-name">{{ $review->display_name }}</h3>
                                    <span class="review-date">{{ $review->review_date->format('d.m.Y') }}</span>
                                </div>
                            </div>

                            <div class="review-rating">
                                {!! $review->getStarsHtml() !!}
                            </div>

                            <div class="review-content">
                                <p>{{ $review->review_text }}</p>
                            </div>

                            @if($review->business)
                            <div class="business-badge">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $review->business->name }}</span>
                            </div>
                            @endif
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
.google-reviews-section.variant-1 {
    padding: 80px 0;
    position: relative;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.variant-1 .section-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0.08;
    z-index: 0;
}

.variant-1 .section-header {
    margin-bottom: 50px;
    position: relative;
    z-index: 1;
}

.variant-1 .section-subtitle {
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #4285F4;
    margin-bottom: 10px;
    display: block;
}

.variant-1 .section-title {
    font-size: 38px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
}

.google-reviews-swiper-v1 {
    position: relative;
    padding: 10px 10px 60px;
}

.variant-1 .review-card.modern-card {
    background: #fff;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 2px solid transparent;
}

.variant-1 .review-card.modern-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 50px rgba(66, 133, 244, 0.15);
    border-color: #4285F4;
}

.variant-1 .card-inner {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.variant-1 .review-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.variant-1 .avatar-wrapper {
    flex-shrink: 0;
}

.variant-1 .review-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #4285F4;
    box-shadow: 0 4px 12px rgba(66, 133, 244, 0.3);
}

.variant-1 .reviewer-info {
    flex: 1;
}

.variant-1 .reviewer-name {
    font-size: 18px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 5px 0;
}

.variant-1 .review-date {
    font-size: 13px;
    color: #999;
    font-weight: 500;
}

.variant-1 .review-rating {
    display: flex;
    gap: 3px;
    margin-bottom: 15px;
}

.variant-1 .review-rating i {
    color: #FBBC05;
    font-size: 18px;
}

.variant-1 .review-content {
    flex: 1;
    margin-bottom: 15px;
    max-height: 150px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #4285F4 #f0f0f0;
}

.variant-1 .review-content::-webkit-scrollbar {
    width: 6px;
}

.variant-1 .review-content::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}

.variant-1 .review-content::-webkit-scrollbar-thumb {
    background: #4285F4;
    border-radius: 10px;
}

.variant-1 .review-content p {
    font-size: 15px;
    line-height: 1.7;
    color: #555;
    margin: 0;
    padding-right: 10px;
}

.variant-1 .business-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f8f9fa;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 13px;
    color: #666;
    font-weight: 500;
}

.variant-1 .business-badge i {
    color: #EA4335;
}

.google-reviews-swiper-v1 .swiper-button-next,
.google-reviews-swiper-v1 .swiper-button-prev {
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 50%;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.google-reviews-swiper-v1 .swiper-button-next::after,
.google-reviews-swiper-v1 .swiper-button-prev::after {
    font-size: 18px;
    color: #4285F4;
    font-weight: 900;
    font-family: 'Font Awesome 6 Free';
}

.google-reviews-swiper-v1 .swiper-button-next::after {
    content: '\f054';
}

.google-reviews-swiper-v1 .swiper-button-prev::after {
    content: '\f053';
}

.google-reviews-swiper-v1 .swiper-pagination {
    bottom: 20px;
}

.google-reviews-swiper-v1 .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background: #4285F4;
    opacity: 0.3;
}

.google-reviews-swiper-v1 .swiper-pagination-bullet-active {
    opacity: 1;
    width: 30px;
    border-radius: 6px;
}

.review-cta-section {
    text-align: center;
    margin-top: 40px;
}

.review-cta-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #4285F4 0%, #34A853 100%);
    color: white;
    padding: 15px 35px;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(66, 133, 244, 0.3);
    transition: all 0.3s ease;
}

.review-cta-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(66, 133, 244, 0.4);
    color: white;
}

.review-cta-button i {
    font-size: 20px;
}

@media (max-width: 768px) {
    .variant-1 .section-title {
        font-size: 28px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.google-reviews-swiper-v1', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.google-reviews-swiper-v1 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.google-reviews-swiper-v1 .swiper-button-next',
            prevEl: '.google-reviews-swiper-v1 .swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
    });
});
</script>
