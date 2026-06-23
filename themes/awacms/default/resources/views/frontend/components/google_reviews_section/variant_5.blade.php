<section class="google-reviews-section variant-5" @if($bgColor) style="background-color: {{ $bgColor }};" @endif>
    @if($bgImage)
    <div class="section-bg" style="background-image: url('{{ $bgImage }}');"></div>
    @endif

    <div class="container">
        @if($title || $subtitle)
        <div class="section-header text-center">
            @if($subtitle)
            <span class="section-subtitle modern">{{ $subtitle }}</span>
            @endif
            @if($title)
            <h2 class="section-title modern">{{ $title }}</h2>
            @endif
        </div>
        @endif

        <div class="swiper google-reviews-swiper-v5">
            <div class="swiper-wrapper">
                @foreach($reviews as $review)
                <div class="swiper-slide">
                    <div class="review-card modern-card-v5">
                        <div class="card-badge">
                            <span class="badge-stars">{!! $review->getStarsHtml() !!}</span>
                        </div>

                        <div class="review-content-v5">
                            <p>{{ $review->review_text }}</p>
                        </div>

                        <div class="review-footer-v5">
                            <div class="reviewer-profile-v5">
                                <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar-v5">
                                <div class="reviewer-details-v5">
                                    <h4 class="reviewer-name-v5">{{ $review->display_name }}</h4>
                                    <span class="review-date-v5">{{ $review->review_date->format('d M Y') }}</span>
                                </div>
                            </div>
                            @if($review->business)
                            <div class="google-verified">
                                <i class="fab fa-google"></i>
                                <span>Doğrulandı</span>
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
.google-reviews-section.variant-5 {
    padding: 80px 0;
    position: relative;
    background: #f5f5f5;
}

.variant-5 .section-bg {
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

.variant-5 .section-header {
    margin-bottom: 50px;
    position: relative;
    z-index: 1;
}

.variant-5 .section-subtitle.modern {
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #EA4335;
    margin-bottom: 10px;
    display: block;
}

.variant-5 .section-title.modern {
    font-size: 38px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
}

.google-reviews-swiper-v5 {
    position: relative;
    padding: 10px 10px 60px;
}

.variant-5 .review-card.modern-card-v5 {
    background: white;
    border-radius: 18px;
    padding: 30px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(0,0,0,0.05);
    position: relative;
    overflow: hidden;
}

.variant-5 .review-card.modern-card-v5::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #4285F4, #EA4335, #FBBC05, #34A853);
}

.variant-5 .review-card.modern-card-v5:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 45px rgba(234, 67, 53, 0.15);
}

.variant-5 .card-badge {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.variant-5 .badge-stars {
    display: flex;
    gap: 3px;
}

.variant-5 .badge-stars i {
    color: #FBBC05;
    font-size: 18px;
}

.variant-5 .review-content-v5 {
    flex: 1;
    margin-bottom: 20px;
    max-height: 150px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #EA4335 #f0f0f0;
}

.variant-5 .review-content-v5::-webkit-scrollbar {
    width: 6px;
}

.variant-5 .review-content-v5::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}

.variant-5 .review-content-v5::-webkit-scrollbar-thumb {
    background: #EA4335;
    border-radius: 10px;
}

.variant-5 .review-content-v5 p {
    font-size: 15px;
    line-height: 1.7;
    color: #4a4a4a;
    margin: 0;
    padding-right: 10px;
}

.variant-5 .review-footer-v5 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 2px solid #f5f5f5;
    gap: 15px;
}

.variant-5 .reviewer-profile-v5 {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
}

.variant-5 .review-avatar-v5 {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #f0f0f0;
}

.variant-5 .reviewer-details-v5 {
    flex: 1;
}

.variant-5 .reviewer-name-v5 {
    font-size: 16px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 3px 0;
}

.variant-5 .review-date-v5 {
    font-size: 12px;
    color: #999;
}

.variant-5 .google-verified {
    display: flex;
    align-items: center;
    gap: 5px;
    background: #34A853;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.variant-5 .google-verified i {
    font-size: 14px;
}

.google-reviews-swiper-v5 .swiper-button-next,
.google-reviews-swiper-v5 .swiper-button-prev {
    width: 48px;
    height: 48px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border: 2px solid #EA4335;
}

.google-reviews-swiper-v5 .swiper-button-next::after,
.google-reviews-swiper-v5 .swiper-button-prev::after {
    font-size: 16px;
    color: #EA4335;
    font-weight: 900;
    font-family: 'Font Awesome 6 Free';
}

.google-reviews-swiper-v5 .swiper-button-next::after {
    content: '\f054';
}

.google-reviews-swiper-v5 .swiper-button-prev::after {
    content: '\f053';
}

.google-reviews-swiper-v5 .swiper-pagination {
    bottom: 20px;
}

.google-reviews-swiper-v5 .swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background: #EA4335;
    opacity: 0.3;
}

.google-reviews-swiper-v5 .swiper-pagination-bullet-active {
    opacity: 1;
    width: 25px;
    border-radius: 5px;
}

.variant-5 .review-cta-section {
    text-align: center;
    margin-top: 40px;
}

.variant-5 .review-cta-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: white;
    color: #EA4335;
    padding: 15px 35px;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    border: 2px solid #EA4335;
    box-shadow: 0 4px 15px rgba(234, 67, 53, 0.2);
    transition: all 0.3s ease;
}

.variant-5 .review-cta-button:hover {
    background: #EA4335;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(234, 67, 53, 0.3);
}

.variant-5 .review-cta-button i {
    font-size: 20px;
}

@media (max-width: 768px) {
    .variant-5 .section-title.modern {
        font-size: 28px;
    }

    .variant-5 .review-footer-v5 {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.google-reviews-swiper-v5', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.google-reviews-swiper-v5 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.google-reviews-swiper-v5 .swiper-button-next',
            prevEl: '.google-reviews-swiper-v5 .swiper-button-prev',
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
