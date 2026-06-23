<div class="swiper-slide">
    <div class="project__item-two interactive-banner-style-09">
        <div class="project__thumb-two">
            <a href="{{ $serviceCategory->url }}"
                title="{{ $serviceCategory->name }}"
                aria-label="{{ $serviceCategory->name }} sayfasına git">
                <img src="{{ $serviceCategory->detailsImage }}"
                    alt="{{ $serviceCategory->name }}"
                    loading="lazy">
            </a>
        </div>

        <div class="project__content-two text-center">
            <h2 class="title">
                <a href="{{ $serviceCategory->url }}"
                    title="{{ $serviceCategory->name }}"
                    aria-label="{{ $serviceCategory->name }} detaylarını inceleyin">
                    {{ $serviceCategory->name }}
                </a>
            </h2>

            <!-- Daha fazla bilgi bağlantısı tıklanabilir hale getirildi -->
            <a href="{{ $serviceCategory->url }}"
                class="info-link text-dark fw-600 fs-16"
                title="{{ $serviceCategory->name }} hakkında daha fazla bilgi alın"
                aria-label="{{ $serviceCategory->name }} hakkında daha fazla bilgi alın">

            </a>
        </div>
    </div>
</div>
