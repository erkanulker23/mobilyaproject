<section class="service-category-v1" style="background-color: {{ isset($bgColor) ? $bgColor : '#f9fafb' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\');background-size:cover;background-position:center' : '' }}">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                @if($subtitle)
                <span class="service-cat-v1-subtitle">Hizmetlerimiz</span>
                @endif
                <h2 class="service-cat-v1-title">{{ $title ?? 'Hizmet Kategorilerimiz' }}</h2>
                @if($subtitle)
                <p class="service-cat-v1-desc">{{ $subtitle }}</p>
                @endif
            </div>
        </div>

        @if($serviceCategories && count($serviceCategories) > 0)
        <div class="swiper service-cat-swiper-v1">
            <div class="swiper-wrapper">
                @foreach($serviceCategories as $category)
                <div class="swiper-slide">
                    <div class="service-cat-v1-card">
                        @if($category->iconImage)
                        <div class="service-cat-v1-icon">
                            <img src="{{ $category->iconImage }}" alt="{{ $category->name }}">
                        </div>
                        @endif
                        <h3 class="service-cat-v1-card-title">{{ $category->name }}</h3>
                        <p class="service-cat-v1-card-desc">{{ Str::limit($category->description ?? '', 80) }}</p>
                        <a href="{{ $category->url }}" class="service-cat-v1-link">Detaylar <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="swiper-button-next service-cat-v1-next"></div>
            <div class="swiper-button-prev service-cat-v1-prev"></div>
            <div class="swiper-pagination service-cat-v1-pagination"></div>
        </div>

        @if($buttonText && $buttonUrl)
        <div class="text-center mt-5">
            <a href="{{ $buttonUrl }}" class="service-cat-v1-btn">{{ $buttonText }}</a>
        </div>
        @endif
        @else
        <p class="text-center">Henüz hizmet kategorisi eklenmemiş.</p>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.service-cat-swiper-v1', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: {{ count($serviceCategories) >= 4 ? 'true' : 'false' }},
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.service-cat-v1-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.service-cat-v1-next',
            prevEl: '.service-cat-v1-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 24,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        },
    });
});
</script>

<style>
.service-category-v1 {
    padding: 80px 0;
}

.service-cat-v1-subtitle {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #667eea;
    margin-bottom: 10px;
}

.service-cat-v1-title {
    font-size: 36px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 16px;
}

.service-cat-v1-desc {
    font-size: 16px;
    color: #6b7280;
}

.service-cat-swiper-v1 {
    padding: 20px 10px 60px;
    position: relative;
}

.service-cat-v1-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 32px 24px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 2px solid transparent;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.service-cat-v1-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    border-color: #667eea;
}

.service-cat-v1-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 20px;
    background: #f3f4f6;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.service-cat-v1-card:hover .service-cat-v1-icon {
    background: #667eea;
}

.service-cat-v1-icon img {
    max-width: 50px;
    max-height: 50px;
    object-fit: contain;
    transition: filter 0.3s ease;
}

.service-cat-v1-card:hover .service-cat-v1-icon img {
    filter: brightness(0) invert(1);
}

.service-cat-v1-card-title {
    font-size: 20px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 12px;
    text-align: center;
}

.service-cat-v1-card-desc {
    font-size: 14px;
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 20px;
    text-align: center;
    flex: 1;
}

.service-cat-v1-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 600;
    color: #667eea;
    text-decoration: none;
    transition: all 0.2s ease;
}

.service-cat-v1-link:hover {
    color: #764ba2;
    gap: 8px;
}

.service-cat-v1-next,
.service-cat-v1-prev {
    width: 44px;
    height: 44px;
    background: #667eea;
    border-radius: 50%;
    color: #ffffff;
}

.service-cat-v1-next::after,
.service-cat-v1-prev::after {
    font-size: 16px;
    color: #ffffff;
}

.service-cat-v1-pagination .swiper-pagination-bullet {
    width: 10px !important;
    height: 10px !important;
    background: #667eea;
    opacity: 0.3;
}

.service-cat-v1-pagination .swiper-pagination-bullet-active {
    opacity: 1;
    width: 24px !important;
    border-radius: 5px;
}

.service-cat-v1-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #667eea;
    color: white;
    padding: 14px 32px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.service-cat-v1-btn:hover {
    background: #764ba2;
    color: white;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .service-category-v1 {
        padding: 60px 0;
    }

    .service-cat-v1-title {
        font-size: 28px;
    }
}
</style>
