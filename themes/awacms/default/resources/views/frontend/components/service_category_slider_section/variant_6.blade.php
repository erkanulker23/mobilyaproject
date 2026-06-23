<section class="service-category-v6" style="background-color: {{ isset($bgColor) ? $bgColor : '#ffffff' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\');background-size:cover;background-position:center' : '' }}">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="service-cat-v6-title">{{ $title ?? 'Hizmet Kategorilerimiz' }}</h2>
            @if($subtitle)
            <p class="service-cat-v6-subtitle">{{ $subtitle }}</p>
            @endif
        </div>

        @if($serviceCategories && count($serviceCategories) > 0)
        <div class="swiper service-cat-swiper-v6">
            <div class="swiper-wrapper">
                @foreach($serviceCategories as $category)
                <div class="swiper-slide">
                    <div class="service-cat-v6-card">
                        @if($category->detailsImage)
                        <div class="service-cat-v6-image">
                            <img src="{{ $category->detailsImage }}" alt="{{ $category->name }}">
                        </div>
                        @endif
                        <div class="service-cat-v6-overlay">
                            <h3>{{ $category->name }}</h3>
                            <a href="{{ $category->url }}">Görüntüle</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination service-cat-v6-pagination"></div>
        </div>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.service-cat-swiper-v6', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: {{ count($serviceCategories) >= 3 ? 'true' : 'false' }},
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.service-cat-v6-pagination',
            clickable: true,
        },
        breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        },
    });
});
</script>

<style>
.service-category-v6 {
    padding: 80px 0;
}

.service-cat-v6-title {
    font-size: 36px;
    font-weight: 700;
    color: #1f2937;
}

.service-cat-v6-subtitle {
    font-size: 16px;
    color: #6b7280;
}

.service-cat-swiper-v6 {
    padding: 20px 10px 70px;
}

.service-cat-v6-card {
    position: relative;
    height: 350px;
    border-radius: 16px;
    overflow: hidden;
}

.service-cat-v6-image {
    width: 100%;
    height: 100%;
}

.service-cat-v6-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.service-cat-v6-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 100%);
    padding: 32px 24px;
    z-index: 2;
}

.service-cat-v6-overlay h3 {
    font-size: 22px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 12px;
}

.service-cat-v6-overlay a {
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.2s ease;
}

.service-cat-v6-overlay a:hover {
    color: #667eea;
}

.service-cat-v6-pagination .swiper-pagination-bullet {
    width: 10px !important;
    height: 10px !important;
    background: #667eea;
    opacity: 0.3;
}

.service-cat-v6-pagination .swiper-pagination-bullet-active {
    opacity: 1;
    width: 24px !important;
    border-radius: 5px;
}
</style>
