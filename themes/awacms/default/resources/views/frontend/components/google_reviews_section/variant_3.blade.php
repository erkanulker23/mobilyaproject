<section class="google-reviews-section variant-3" @if($bgColor) style="background-color: {{ $bgColor }};" @endif>
    @if($bgImage)
    <div class="section-bg" style="background-image: url('{{ $bgImage }}');"></div>
    @endif

    <div class="container">
        @if($title || $subtitle)
        <div class="section-header minimal">
            @if($subtitle)
            <p class="section-subtitle-top">{{ $subtitle }}</p>
            @endif
            @if($title)
            <h2 class="section-title">{{ $title }}</h2>
            @endif
        </div>
        @endif

        <div class="swiper google-reviews-swiper-v3">
            <div class="swiper-wrapper">
                @foreach($reviews as $review)
                <div class="swiper-slide">
                    <div class="review-card minimal-card">
                        <div class="card-accent"></div>

                        <div class="review-rating">
                            {!! $review->getStarsHtml() !!}
                        </div>

                        <div class="review-content minimal">
                            <p>{{ $review->review_text }}</p>
                        </div>

                        <div class="review-author">
                            <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar tiny">
                            <span class="reviewer-name">{{ $review->display_name }}</span>
                            <span class="separator">•</span>
                            <span class="review-date">{{ $review->review_date->format('d.m.Y') }}</span>
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
.google-reviews-section.variant-3 {
    padding: 80px 0;
    position: relative;
    background: #fafbfc;
}

.variant-3 .section-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0.06;
    z-index: 0;
}

.variant-3 .section-header.minimal {
    margin-bottom: 50px;
    position: relative;
    z-index: 1;
    border-left: 5px solid #4285F4;
    padding-left: 25px;
}

.variant-3 .section-subtitle-top {
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #4285F4;
    margin: 0 0 10px 0;
}

.variant-3 .section-title {
    font-size: 36px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
}

.google-reviews-swiper-v3 {
    position: relative;
    padding: 10px 10px 60px;
}

.variant-3 .review-card.minimal-card {
    background: #fff;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid #e9ecef;
    position: relative;
    overflow: hidden;
}

.variant-3 .review-card.minimal-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border-color: #4285F4;
}

.variant-3 .card-accent {
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #4285F4 0%, #34A853 100%);
}

.variant-3 .review-rating {
    display: flex;
    gap: 3px;
    margin-bottom: 15px;
}

.variant-3 .review-rating i {
    color: #FBBC05;
    font-size: 16px;
}

.variant-3 .review-content.minimal {
    flex: 1;
    margin-bottom: 15px;
    max-height: 140px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #4285F4 #f0f0f0;
}

.variant-3 .review-content::-webkit-scrollbar {
    width: 5px;
}

.variant-3 .review-content::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}

.variant-3 .review-content::-webkit-scrollbar-thumb {
    background: #4285F4;
    border-radius: 10px;
}

.variant-3 .review-content p {
    font-size: 14px;
    line-height: 1.7;
    color: #555;
    margin: 0;
    padding-right: 8px;
}

.variant-3 .review-author {
    display: flex;
    align-items: center;
    gap: 10px;
    padding-top: 15px;
    border-top: 1px solid #e9ecef;
}

.variant-3 .review-avatar.tiny {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e9ecef;
}

.variant-3 .reviewer-name {
    font-size: 14px;
    font-weight: 600;
    color: #1a1a1a;
}

.variant-3 .separator {
    color: #ccc;
    font-size: 12px;
}

.variant-3 .review-date {
    font-size: 13px;
    color: #999;
}

.google-reviews-swiper-v3 .swiper-button-next,
.google-reviews-swiper-v3 .swiper-button-prev {
    width: 42px;
    height: 42px;
    background: white;
    border: 2px solid #4285F4;
    border-radius: 8px;
}

.google-reviews-swiper-v3 .swiper-button-next::after,
.google-reviews-swiper-v3 .swiper-button-prev::after {
    font-size: 14px;
    color: #4285F4;
    font-weight: 900;
    font-family: 'Font Awesome 6 Free';
}

.google-reviews-swiper-v3 .swiper-button-next::after {
    content: '\f054';
}

.google-reviews-swiper-v3 .swiper-button-prev::after {
    content: '\f053';
}

.google-reviews-swiper-v3 .swiper-pagination {
    bottom: 20px;
}

.google-reviews-swiper-v3 .swiper-pagination-bullet {
    width: 8px;
    height: 8px;
    background: #4285F4;
    opacity: 0.3;
    border-radius: 2px;
}

.google-reviews-swiper-v3 .swiper-pagination-bullet-active {
    opacity: 1;
    width: 20px;
    border-radius: 4px;
}

.variant-3 .review-cta-section {
    text-align: center;
    margin-top: 40px;
}

.variant-3 .review-cta-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: white;
    color: #4285F4;
    padding: 15px 35px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    border: 2px solid #4285F4;
    box-shadow: 0 4px 15px rgba(66, 133, 244, 0.15);
    transition: all 0.3s ease;
}

.variant-3 .review-cta-button:hover {
    background: #4285F4;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(66, 133, 244, 0.3);
}

.variant-3 .review-cta-button i {
    font-size: 20px;
}

@media (max-width: 768px) {
    .variant-3 .section-title {
        font-size: 28px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.google-reviews-swiper-v3', {
        slidesPerView: 1,
        spaceBetween: 25,
        loop: true,
        autoplay: {
            delay: 4500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.google-reviews-swiper-v3 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.google-reviews-swiper-v3 .swiper-button-next',
            prevEl: '.google-reviews-swiper-v3 .swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 25,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 25,
            },
        },
    });
});
</script>
