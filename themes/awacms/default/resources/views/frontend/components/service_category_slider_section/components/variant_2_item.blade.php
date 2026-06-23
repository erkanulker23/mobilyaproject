<!-- start slider item -->
<div class="swiper-slide">
    <div class="interactive-banner-style-06">
        <div class="interactive-banners-image">
            <img src="{{ $serviceCategory->detailsImage }}" alt="{{ $serviceCategory->name }}"
                width="460px"
                height="360px"
                loading="lazy"
            />
            <div class="overlay-bg bg-gradient-black-bottom-transparent opacity-light"></div>

            <!-- Açıklayıcı bağlantı metni -->
            <a href="{{ $serviceCategory->url }}"
                class="banners-icon text-white icon-hover-base-color position-absolute top-60px left-60px lg-top-30px lg-left-30px"
                title="{{ $serviceCategory->name }}"
                aria-label="{{ $serviceCategory->name }} hizmet sayfasına git">
                <i class="line-icon-Structure icon-large text-white"></i>
            </a>
        </div>

        <div class="interactive-banners-content p-60px lg-p-30px">
            <div class="h-100 w-100 last-paragraph-no-margin">
                <a href="{{ $serviceCategory->url }}"
                    class="fs-22 d-block text-white mb-10px fw-500"
                    title="{{ $serviceCategory->name }}"
                    aria-label="{{ $serviceCategory->name }} detaylarını görüntüle">
                    {{ $serviceCategory->name }}
                </a>

                <p class="interactive-banners-content-text text-white w-95 lg-w-100">
                    {{ $serviceCategory->shortDescription }}
                </p>
            </div>
        </div>

        <div class="box-overlay bg-gradient-dark-transparent"></div>
    </div>
</div>
<!-- end slider item -->
