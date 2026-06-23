<section class="references-v3-modern" style="background-color: {{ isset($bgColor) ? $bgColor : '#ffffff' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\');background-size:cover;background-position:center' : '' }}">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                @if($subtitle)
                <span class="references-v3-subtitle">{{ $subtitle }}</span>
                @endif
                <h2 class="references-v3-title">{{ $title ?? 'Referanslarımız' }}</h2>
            </div>
        </div>

        @if($references && count($references) > 0)
        <div class="references-v3-carousel">
            <div class="swiper references-v3-swiper">
                <div class="swiper-wrapper">
                    @foreach($references as $reference)
                    <div class="swiper-slide">
                        <div class="reference-v3-card">
                            <div class="reference-v3-logo-container">
                                <img src="{{ $reference->logo }}" alt="{{ $reference->title }}" loading="lazy">
                            </div>
                            <h3 class="reference-v3-name">{{ $reference->title }}</h3>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination references-v3-pagination"></div>
            </div>
        </div>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.references-v3-swiper', {
        slidesPerView: 2,
        spaceBetween: 24,
        loop: {{ count($references) >= 4 ? 'true' : 'false' }},
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.references-v3-pagination',
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 3,
                spaceBetween: 24,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 6,
                spaceBetween: 30,
            },
        },
    });
});
</script>

<style>
.references-v3-modern {
    padding: 80px 0;
}

.references-v3-subtitle {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #667eea;
    margin-bottom: 10px;
}

.references-v3-title {
    font-size: 38px;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
}

.references-v3-carousel {
    margin-top: 48px;
}

.references-v3-swiper {
    padding: 20px 10px 80px !important;
}

.reference-v3-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 32px 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
    text-align: center;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.reference-v3-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    border-color: #667eea;
}

.reference-v3-logo-container {
    width: 100%;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}

.reference-v3-logo-container img {
    max-width: 100%;
    max-height: 80px;
    width: auto;
    height: auto;
    object-fit: contain;
    filter: grayscale(100%);
    opacity: 0.6;
    transition: all 0.3s ease;
}

.reference-v3-card:hover .reference-v3-logo-container img {
    filter: grayscale(0%);
    opacity: 1;
    transform: scale(1.05);
}

.reference-v3-name {
    font-size: 14px;
    font-weight: 600;
    color: #6b7280;
    margin: 0;
    transition: color 0.3s ease;
}

.reference-v3-card:hover .reference-v3-name {
    color: #667eea;
}

.references-v3-pagination {
    margin-top: 50px !important;
    position: static !important;
}

.references-v3-pagination .swiper-pagination-bullet {
    width: 10px !important;
    height: 10px !important;
    background: #667eea;
    opacity: 0.3;
}

.references-v3-pagination .swiper-pagination-bullet-active {
    opacity: 1;
    width: 24px !important;
    border-radius: 5px;
}

@media (max-width: 768px) {
    .references-v3-modern {
        padding: 60px 0;
    }

    .references-v3-title {
        font-size: 28px;
    }

    .reference-v3-card {
        padding: 24px 16px;
    }
}
</style>
