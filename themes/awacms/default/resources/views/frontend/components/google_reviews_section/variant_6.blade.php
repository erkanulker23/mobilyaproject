<section class="google-reviews-section variant-6" @if($bgColor) style="background-color: {{ $bgColor }};" @endif>
    @if($bgImage)
    <div class="section-bg" style="background-image: url('{{ $bgImage }}');"></div>
    @endif

    <div class="container">
        @if($title || $subtitle)
        <div class="section-header">
            <div class="header-content-v6">
                @if($title)
                <h2 class="section-title premium">{{ $title }}</h2>
                @endif
                @if($subtitle)
                <p class="section-subtitle premium">{{ $subtitle }}</p>
                @endif
            </div>
            <div class="google-summary-v6">
                <div class="summary-icon-v6">
                    <svg width="35" height="35" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                    </svg>
                </div>
                <div class="summary-text-v6">
                    <span class="review-count-v6">{{ count($reviews) }} Müşteri Yorumu</span>
                    <span class="powered-by-v6">Google Değerlendirmeleri</span>
                </div>
            </div>
        </div>
        @endif

        <div class="swiper google-reviews-swiper-v6">
            <div class="swiper-wrapper">
                @foreach($reviews as $review)
                <div class="swiper-slide">
                    <div class="review-card premium-card">
                        <div class="card-decoration"></div>

                        <div class="review-header-v6">
                            <div class="reviewer-info-v6">
                                <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar-v6">
                                <div class="reviewer-meta-v6">
                                    <h4 class="reviewer-name-v6">{{ $review->display_name }}</h4>
                                    <div class="review-rating-v6">
                                        {!! $review->getStarsHtml() !!}
                                    </div>
                                </div>
                            </div>
                            <span class="review-date-v6">{{ $review->review_date->format('d.m.Y') }}</span>
                        </div>

                        <div class="review-content-v6">
                            <div class="quote-mark-v6">"</div>
                            <p>{{ $review->review_text }}</p>
                        </div>

                        @if($review->business)
                        <div class="business-tag-v6">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $review->business->name }}</span>
                        </div>
                        @endif
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
.google-reviews-section.variant-6 {
    padding: 80px 0;
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.variant-6 .section-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0.1;
    z-index: 0;
}

.variant-6 .section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    position: relative;
    z-index: 1;
    flex-wrap: wrap;
    gap: 25px;
}

.header-content-v6 {
    flex: 1;
}

.variant-6 .section-title.premium {
    font-size: 40px;
    font-weight: 800;
    color: white;
    margin: 0 0 8px 0;
    line-height: 1.2;
}

.variant-6 .section-subtitle.premium {
    font-size: 16px;
    color: rgba(255,255,255,0.9);
    margin: 0;
}

.google-summary-v6 {
    display: flex;
    align-items: center;
    gap: 15px;
    background: white;
    padding: 18px 28px;
    border-radius: 50px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.summary-icon-v6 {
    display: flex;
    align-items: center;
    justify-content: center;
}

.summary-text-v6 {
    display: flex;
    flex-direction: column;
}

.review-count-v6 {
    font-size: 18px;
    font-weight: 700;
    color: #1a1a1a;
}

.powered-by-v6 {
    font-size: 12px;
    color: #999;
}

.google-reviews-swiper-v6 {
    position: relative;
    padding: 10px 10px 60px;
}

.variant-6 .review-card.premium-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
}

.variant-6 .card-decoration {
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    border-radius: 0 20px 0 100px;
}

.variant-6 .review-card.premium-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 50px rgba(0,0,0,0.25);
}

.variant-6 .review-header-v6 {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}

.reviewer-info-v6 {
    display: flex;
    gap: 15px;
    align-items: center;
}

.variant-6 .review-avatar-v6 {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #667eea;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.reviewer-meta-v6 {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.reviewer-meta-v6 .reviewer-name-v6 {
    font-size: 17px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
}

.variant-6 .review-rating-v6 {
    display: flex;
    gap: 2px;
}

.variant-6 .review-rating-v6 i {
    color: #FBBC05;
    font-size: 16px;
}

.variant-6 .review-date-v6 {
    font-size: 13px;
    color: #999;
    font-weight: 500;
}

.variant-6 .review-content-v6 {
    flex: 1;
    margin-bottom: 15px;
    position: relative;
    max-height: 160px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #667eea #f0f0f0;
}

.variant-6 .review-content-v6::-webkit-scrollbar {
    width: 6px;
}

.variant-6 .review-content-v6::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}

.variant-6 .review-content-v6::-webkit-scrollbar-thumb {
    background: #667eea;
    border-radius: 10px;
}

.quote-mark-v6 {
    position: absolute;
    left: -10px;
    top: -15px;
    font-size: 70px;
    font-family: Georgia, serif;
    color: rgba(102, 126, 234, 0.1);
    line-height: 1;
}

.variant-6 .review-content-v6 p {
    font-size: 15px;
    line-height: 1.7;
    color: #555;
    margin: 0;
    padding-left: 20px;
    padding-right: 10px;
}

.business-tag-v6 {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.business-tag-v6 i {
    color: white;
}

.google-reviews-swiper-v6 .swiper-button-next,
.google-reviews-swiper-v6 .swiper-button-prev {
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 50%;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.google-reviews-swiper-v6 .swiper-button-next::after,
.google-reviews-swiper-v6 .swiper-button-prev::after {
    font-size: 18px;
    color: #667eea;
    font-weight: 900;
    font-family: 'Font Awesome 6 Free';
}

.google-reviews-swiper-v6 .swiper-button-next::after {
    content: '\f054';
}

.google-reviews-swiper-v6 .swiper-button-prev::after {
    content: '\f053';
}

.google-reviews-swiper-v6 .swiper-pagination {
    bottom: 20px;
}

.google-reviews-swiper-v6 .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background: white;
    opacity: 0.5;
}

.google-reviews-swiper-v6 .swiper-pagination-bullet-active {
    opacity: 1;
    width: 30px;
    border-radius: 6px;
}

.variant-6 .review-cta-section {
    text-align: center;
    margin-top: 40px;
}

.variant-6 .review-cta-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: white;
    color: #667eea;
    padding: 15px 35px;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
    transition: all 0.3s ease;
}

.variant-6 .review-cta-button:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.variant-6 .review-cta-button i {
    font-size: 20px;
}

@media (max-width: 992px) {
    .variant-6 .section-header {
        flex-direction: column;
        text-align: center;
    }

    .variant-6 .section-title.premium {
        font-size: 32px;
    }
}

@media (max-width: 576px) {
    .google-summary-v6 {
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.google-reviews-swiper-v6', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 5500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.google-reviews-swiper-v6 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.google-reviews-swiper-v6 .swiper-button-next',
            prevEl: '.google-reviews-swiper-v6 .swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 25,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
    });
});
</script>
