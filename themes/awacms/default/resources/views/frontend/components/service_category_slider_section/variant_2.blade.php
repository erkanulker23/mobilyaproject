<section class="service-category-v2" style="background-color: {{ isset($bgColor) ? $bgColor : '#111827' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\');background-size:cover;background-position:center' : '' }}">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8">
                @if($subtitle)
                <span class="service-cat-v2-subtitle">{{ $subtitle }}</span>
                @endif
                <h2 class="service-cat-v2-title">{{ $title ?? 'Hizmetlerimiz' }}</h2>
            </div>
        </div>

        @if($serviceCategories && count($serviceCategories) > 0)
        <div class="swiper service-cat-swiper-v2">
            <div class="swiper-wrapper">
                @foreach($serviceCategories as $category)
                <div class="swiper-slide">
                    <div class="service-cat-v2-card">
                        <div class="service-cat-v2-overlay"></div>
                        @if($category->detailsImage)
                        <img src="{{ $category->detailsImage }}" alt="{{ $category->name }}" class="service-cat-v2-bg">
                        @endif
                        <div class="service-cat-v2-content">
                            <h3 class="service-cat-v2-card-title">{{ $category->name }}</h3>
                            <a href="{{ $category->url }}" class="service-cat-v2-link">Keşfet →</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="service-cat-v2-pagination"></div>
        </div>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.service-cat-swiper-v2', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: {{ count($serviceCategories) >= 3 ? 'true' : 'false' }},
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.service-cat-v2-pagination',
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 24,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
    });
});
</script>

<style>
.service-category-v2 {
    padding: 80px 0;
}

.service-cat-v2-subtitle {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #9ca3af;
    margin-bottom: 10px;
    display: block;
}

.service-cat-v2-title {
    font-size: 40px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
}

.service-cat-swiper-v2 {
    padding: 20px 10px 70px;
}

.service-cat-v2-card {
    position: relative;
    height: 400px;
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;
}

.service-cat-v2-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.service-cat-v2-card:hover .service-cat-v2-bg {
    transform: scale(1.1);
}

.service-cat-v2-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.8) 100%);
    z-index: 1;
}

.service-cat-v2-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 32px;
    z-index: 2;
    transform: translateY(0);
    transition: transform 0.3s ease;
}

.service-cat-v2-card-title {
    font-size: 24px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 16px;
}

.service-cat-v2-link {
    display: inline-flex;
    align-items: center;
    font-size: 15px;
    font-weight: 600;
    color: #ffffff;
    text-decoration: none;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.service-cat-v2-card:hover .service-cat-v2-link {
    opacity: 1;
    transform: translateY(0);
}

.service-cat-v2-pagination {
    margin-top: 40px;
}

.service-cat-v2-pagination .swiper-pagination-bullet {
    width: 10px !important;
    height: 10px !important;
    background: #ffffff;
    opacity: 0.4;
}

.service-cat-v2-pagination .swiper-pagination-bullet-active {
    opacity: 1;
    width: 24px !important;
    border-radius: 5px;
}

@media (max-width: 768px) {
    .service-cat-v2-card {
        height: 320px;
    }
}
</style>
