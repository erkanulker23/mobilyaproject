<section class="google-reviews-section variant-4" @if($bgColor) style="background-color: {{ $bgColor }};" @endif>
    @if($bgImage)
    <div class="section-bg" style="background-image: url('{{ $bgImage }}');"></div>
    @endif

    <div class="container">
        @if($title || $subtitle)
        <div class="section-header text-center">
            @if($subtitle)
            <span class="section-subtitle elegant">{{ $subtitle }}</span>
            @endif
            @if($title)
            <h2 class="section-title elegant">{{ $title }}</h2>
            @endif
        </div>
        @endif

        <div class="swiper google-reviews-swiper-v4">
            <div class="swiper-wrapper">
                @foreach($reviews as $review)
                <div class="swiper-slide">
                    <div class="review-card elegant-card">
                        <div class="card-header-section">
                            <div class="google-icon">
                                <svg width="28" height="28" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                                    <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                                    <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                                    <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                                </svg>
                            </div>
                            <div class="review-rating centered">
                                {!! $review->getStarsHtml() !!}
                            </div>
                        </div>

                        <div class="review-content elegant">
                            <div class="quote-left">"</div>
                            <p>{{ $review->review_text }}</p>
                            <div class="quote-right">"</div>
                        </div>

                        <div class="review-author-section">
                            <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar">
                            <div class="author-info">
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
.google-reviews-section.variant-4 {
    padding: 80px 0;
    position: relative;
    background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
}

.variant-4 .section-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0.07;
    z-index: 0;
}

.variant-4 .section-header {
    margin-bottom: 50px;
    position: relative;
    z-index: 1;
}

.variant-4 .section-subtitle.elegant {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 3px;
    color: #34A853;
    margin-bottom: 10px;
    display: block;
}

.variant-4 .section-title.elegant {
    font-size: 42px;
    font-weight: 800;
    color: #1a1a1a;
    margin: 0;
}

.google-reviews-swiper-v4 {
    position: relative;
    padding: 10px 10px 60px;
}

.variant-4 .review-card.elegant-card {
    background: white;
    border-radius: 25px;
    padding: 40px 35px;
    box-shadow: 0 15px 45px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
    text-align: center;
    border: 1px solid rgba(0,0,0,0.05);
}

.variant-4 .review-card.elegant-card:hover {
    transform: scale(1.03);
    box-shadow: 0 20px 60px rgba(52, 168, 83, 0.15);
}

.variant-4 .card-header-section {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}

.variant-4 .google-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border-radius: 10px;
}

.variant-4 .review-rating.centered {
    display: flex;
    gap: 4px;
}

.variant-4 .review-rating i {
    color: #FBBC05;
    font-size: 20px;
}

.variant-4 .review-content.elegant {
    flex: 1;
    margin-bottom: 25px;
    position: relative;
    max-height: 180px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #34A853 #f0f0f0;
}

.variant-4 .review-content::-webkit-scrollbar {
    width: 6px;
}

.variant-4 .review-content::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}

.variant-4 .review-content::-webkit-scrollbar-thumb {
    background: #34A853;
    border-radius: 10px;
}

.variant-4 .quote-left,
.variant-4 .quote-right {
    font-size: 60px;
    font-family: Georgia, serif;
    color: rgba(66, 133, 244, 0.15);
    line-height: 0;
    position: relative;
    display: inline-block;
}

.variant-4 .quote-left {
    margin-right: 10px;
}

.variant-4 .quote-right {
    margin-left: 10px;
}

.variant-4 .review-content p {
    font-size: 16px;
    line-height: 1.8;
    color: #4a4a4a;
    margin: 20px 0;
    display: inline;
    padding: 0 10px;
}

.variant-4 .review-author-section {
    display: flex;
    align-items: center;
    gap: 15px;
    padding-top: 25px;
    border-top: 2px solid #f0f0f0;
    justify-content: center;
}

.variant-4 .review-avatar {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #34A853;
    box-shadow: 0 4px 15px rgba(52, 168, 83, 0.3);
}

.variant-4 .author-info {
    text-align: left;
}

.variant-4 .reviewer-name {
    font-size: 17px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 3px 0;
}

.variant-4 .review-date {
    font-size: 13px;
    color: #999;
    font-weight: 500;
}

.google-reviews-swiper-v4 .swiper-button-next,
.google-reviews-swiper-v4 .swiper-button-prev {
    width: 55px;
    height: 55px;
    background: linear-gradient(135deg, #4285F4 0%, #34A853 100%);
    border-radius: 50%;
    box-shadow: 0 4px 15px rgba(66, 133, 244, 0.3);
}

.google-reviews-swiper-v4 .swiper-button-next::after,
.google-reviews-swiper-v4 .swiper-button-prev::after {
    font-size: 18px;
    color: white;
    font-weight: 900;
    font-family: 'Font Awesome 6 Free';
}

.google-reviews-swiper-v4 .swiper-button-next::after {
    content: '\f054';
}

.google-reviews-swiper-v4 .swiper-button-prev::after {
    content: '\f053';
}

.google-reviews-swiper-v4 .swiper-pagination {
    bottom: 20px;
}

.google-reviews-swiper-v4 .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background: #34A853;
    opacity: 0.3;
}

.google-reviews-swiper-v4 .swiper-pagination-bullet-active {
    opacity: 1;
    background: linear-gradient(90deg, #4285F4 0%, #34A853 100%);
}

.variant-4 .review-cta-section {
    text-align: center;
    margin-top: 40px;
}

.variant-4 .review-cta-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #4285F4 0%, #34A853 100%);
    color: white;
    padding: 15px 35px;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 8px 25px rgba(66, 133, 244, 0.3);
    transition: all 0.3s ease;
}

.variant-4 .review-cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(66, 133, 244, 0.4);
    color: white;
}

.variant-4 .review-cta-button i {
    font-size: 20px;
}

@media (max-width: 768px) {
    .variant-4 .section-title.elegant {
        font-size: 32px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.google-reviews-swiper-v4', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        centeredSlides: false,
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.google-reviews-swiper-v4 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.google-reviews-swiper-v4 .swiper-button-next',
            prevEl: '.google-reviews-swiper-v4 .swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
        },
        effect: 'slide',
    });
});
</script>
