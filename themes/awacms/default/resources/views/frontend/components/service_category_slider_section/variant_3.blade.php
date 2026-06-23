<section class="service-category-v3" style="background-color: {{ isset($bgColor) ? $bgColor : '#ffffff' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\');background-size:cover;background-position:center' : '' }}">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="service-cat-v3-title">{{ $title ?? 'Hizmet Kategorilerimiz' }}</h2>
                @if($subtitle)
                <p class="service-cat-v3-subtitle">{{ $subtitle }}</p>
                @endif
            </div>
        </div>

        @if($serviceCategories && count($serviceCategories) > 0)
        <div class="swiper service-cat-swiper-v3">
            <div class="swiper-wrapper">
                @foreach($serviceCategories as $category)
                <div class="swiper-slide">
                    <a href="{{ $category->url }}" class="service-cat-v3-card">
                        <div class="service-cat-v3-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <h3 class="service-cat-v3-name">{{ $category->name }}</h3>
                        <div class="service-cat-v3-arrow">→</div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination service-cat-v3-pagination"></div>
        </div>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.service-cat-swiper-v3', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: {{ count($serviceCategories) >= 3 ? 'true' : 'false' }},
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.service-cat-v3-pagination',
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });
});
</script>

<style>
.service-category-v3 {
    padding: 80px 0;
}

.service-cat-v3-title {
    font-size: 36px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 12px;
}

.service-cat-v3-subtitle {
    font-size: 16px;
    color: #6b7280;
}

.service-cat-swiper-v3 {
    padding: 20px 10px 70px;
}

.service-cat-v3-card {
    display: flex;
    flex-direction: column;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 36px 28px;
    border-radius: 16px;
    text-decoration: none;
    transition: all 0.3s ease;
    height: 200px;
    position: relative;
    overflow: hidden;
}

.service-cat-v3-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
    transform: rotate(45deg);
    transition: all 0.5s ease;
}

.service-cat-v3-card:hover::before {
    top: 100%;
}

.service-cat-v3-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(102, 126, 234, 0.3);
}

.service-cat-v3-number {
    font-size: 48px;
    font-weight: 700;
    color: rgba(255,255,255,0.2);
    margin-bottom: 16px;
}

.service-cat-v3-name {
    font-size: 22px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
    flex: 1;
}

.service-cat-v3-arrow {
    font-size: 28px;
    color: #ffffff;
    align-self: flex-end;
    opacity: 0.8;
}

.service-cat-v3-pagination .swiper-pagination-bullet {
    width: 10px !important;
    height: 10px !important;
    background: #667eea;
    opacity: 0.3;
}

.service-cat-v3-pagination .swiper-pagination-bullet-active {
    opacity: 1;
    width: 24px !important;
    border-radius: 5px;
}
</style>
