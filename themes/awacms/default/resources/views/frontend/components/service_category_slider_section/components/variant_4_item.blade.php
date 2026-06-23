<div class="swiper-slide">
    <div class="services-box-style-01 hover-box last-paragraph-no-margin">
        <div class="position-relative box-image border-radius-6px">
            <a href="{{ $serviceCategory->url }}"
                title="{{ $serviceCategory->name }}"
                aria-label="{{ $serviceCategory->name }} sayfasına git">
                <img class="w-100 border-radius-6px"
                    src="{{ $serviceCategory->detailsImage }}"
                    alt="{{ $serviceCategory->name }}"
                    width="100%"
                    height="auto">
            </a>
            <div class="box-overlay bg-dark-black"></div>
        </div>

        <div class="pt-30px pb-30px bg-white text-center">
            <a href="{{ $serviceCategory->url }}"
                title="{{ $serviceCategory->name }}"
                aria-label="{{ $serviceCategory->name }} hizmet detaylarını görüntüle"
                class="d-inline-block text-dark-black fs-19 fw-600">
                {{ $serviceCategory->name }} - Detayları Gör
            </a>
        </div>
    </div>
</div>
