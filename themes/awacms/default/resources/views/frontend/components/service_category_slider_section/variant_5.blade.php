<section class="service-category-v5" style="background-color: {{ isset($bgColor) ? $bgColor : '#1f2937' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\');background-size:cover;background-position:center' : '' }}">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="service-cat-v5-title">{{ $title ?? 'Hizmetlerimiz' }}</h2>
            @if($subtitle)
            <p class="service-cat-v5-subtitle">{{ $subtitle }}</p>
            @endif
        </div>

        @if($serviceCategories && count($serviceCategories) > 0)
        <div class="swiper service-cat-swiper-v5">
            <div class="swiper-wrapper">
                @foreach($serviceCategories as $category)
                <div class="swiper-slide">
                    <a href="{{ $category->url }}" class="service-cat-v5-card">
                        <div class="service-cat-v5-content">
                            <h3>{{ $category->name }}</h3>
                            <span>Keşfet →</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination service-cat-v5-pagination"></div>
        </div>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.service-cat-swiper-v5', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: {{ count($serviceCategories) >= 4 ? 'true' : 'false' }},
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.service-cat-v5-pagination',
            clickable: true,
        },
        breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 4 },
        },
    });
});
</script>

<style>
.service-category-v5 {
    padding: 80px 0;
}

.service-cat-v5-title {
    font-size: 38px;
    font-weight: 700;
    color: #ffffff;
}

.service-cat-v5-subtitle {
    font-size: 16px;
    color: rgba(255,255,255,0.8);
}

.service-cat-swiper-v5 {
    padding: 20px 10px 70px;
}

.service-cat-v5-card {
    display: block;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    padding: 48px 32px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.2);
    text-decoration: none;
    transition: all 0.3s ease;
    text-align: center;
}

.service-cat-v5-card:hover {
    background: rgba(255,255,255,0.15);
    transform: translateY(-6px);
}

.service-cat-v5-content h3 {
    font-size: 22px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 16px;
}

.service-cat-v5-content span {
    color: rgba(255,255,255,0.9);
    font-size: 15px;
    font-weight: 600;
}

.service-cat-v5-pagination .swiper-pagination-bullet {
    width: 10px !important;
    height: 10px !important;
    background: #ffffff;
    opacity: 0.4;
}

.service-cat-v5-pagination .swiper-pagination-bullet-active {
    opacity: 1;
    width: 24px !important;
    border-radius: 5px;
}
</style>
