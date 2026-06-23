<section class="service-category-v4" style="background-color: {{ isset($bgColor) ? $bgColor : '#f3f4f6' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\');background-size:cover;background-position:center' : '' }}">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="service-cat-v4-title">{{ $title ?? 'Hizmetler' }}</h2>
            @if($subtitle)
            <p class="service-cat-v4-subtitle">{{ $subtitle }}</p>
            @endif
        </div>

        @if($serviceCategories && count($serviceCategories) > 0)
        <div class="swiper service-cat-swiper-v4">
            <div class="swiper-wrapper">
                @foreach($serviceCategories as $category)
                <div class="swiper-slide">
                    <div class="service-cat-v4-card">
                        @if($category->iconImage)
                        <div class="service-cat-v4-icon">
                            <img src="{{ $category->iconImage }}" alt="{{ $category->name }}">
                        </div>
                        @endif
                        <h3>{{ $category->name }}</h3>
                        <a href="{{ $category->url }}" class="service-cat-v4-btn">Detaylar →</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination service-cat-v4-pagination"></div>
        </div>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.service-cat-swiper-v4', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: {{ count($serviceCategories) >= 4 ? 'true' : 'false' }},
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.service-cat-v4-pagination',
            clickable: true,
        },
        breakpoints: {
            640: { slidesPerView: 2 },
            768: { slidesPerView: 3 },
            1024: { slidesPerView: 4 },
        },
    });
});
</script>

<style>
.service-category-v4 {
    padding: 80px 0;
}

.service-cat-v4-title {
    font-size: 36px;
    font-weight: 700;
    color: #111827;
}

.service-cat-v4-subtitle {
    font-size: 16px;
    color: #6b7280;
}

.service-cat-swiper-v4 {
    padding: 20px 10px 70px;
}

.service-cat-v4-card {
    background: white;
    padding: 32px 24px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.service-cat-v4-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}

.service-cat-v4-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 20px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.service-cat-v4-icon img {
    max-width: 40px;
    max-height: 40px;
}

.service-cat-v4-card h3 {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 16px;
}

.service-cat-v4-btn {
    color: #667eea;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
}

.service-cat-v4-pagination .swiper-pagination-bullet {
    width: 10px !important;
    height: 10px !important;
    background: #667eea;
    opacity: 0.3;
}

.service-cat-v4-pagination .swiper-pagination-bullet-active {
    opacity: 1;
    width: 24px !important;
    border-radius: 5px;
}
</style>
