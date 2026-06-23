<!-- start slider item -->
<div class="swiper-slide">
    <!-- start interactive banner item -->
    <div class="interactive-banner-style-09 border-radius-6px overflow-hidden position-relative">
        <img src="{{ $serviceCategory->detailsImage }}" alt="{{ $serviceCategory->name }}" width="100%" height="auto" />
        <div class="opacity-extra-medium bg-gradient-dark-transparent"></div>
        <div class="image-content h-100 w-100 ps-15 pe-15 pt-13 pb-13 md-p-10 d-flex justify-content-bottom align-items-start flex-column">

            <!-- Kategori etiketi -->
            <div class="hover-label-icon position-relative z-index-9">
                <div class="label bg-base-color fw-600 text-white text-uppercase border-radius-30px ps-20px pe-20px fs-12 ls-05px">
                    #
                </div>
            </div>

            <!-- Başlık ve içerik -->
            <div class="mt-auto d-flex align-items-start w-100 z-index-1 position-relative overflow-hidden flex-column">
                <span class="text-white fw-600 fs-20" title="{{ $serviceCategory->name }}">
                    {{ $serviceCategory->name }}
                </span>

                <!-- Açıklayıcı bağlantı metni -->
                <a href="{{ $serviceCategory->url }}"
                    class="content-title-hover fs-13 lh-24 fw-500 ls-05px text-uppercase text-white opacity-6 text-decoration-line-bottom"
                    aria-label="{{ $serviceCategory->name }} sayfasına git">
                    Hizmet Detaylarını Görüntüle
                </a>

                <!-- Ok simgesi içeren buton -->
                <a href="{{ $serviceCategory->url }}"
                    class="content-arrow lh-42px rounded-circle bg-white w-50px h-50px ms-20px text-center d-flex align-items-center justify-content-center"
                    aria-label="{{ $serviceCategory->name }} sayfasına git">
                    <i class="fa-solid fa-chevron-right text-dark-gray fs-16"></i>
                </a>
            </div>

            <!-- Arka plan efektleri -->
            <div class="position-absolute left-0px top-0px w-100 h-100 bg-gradient-regal-blue-transparent opacity-9"></div>
            <div class="box-overlay bg-gradient-base-color-transparent"></div>

            <!-- Genel tıklanabilir alan -->
            <a href="{{ $serviceCategory->url }}"
                class="position-absolute z-index-1 top-0px left-0px h-100 w-100"
                aria-label="{{ $serviceCategory->name }} sayfasına git"></a>

        </div>
    </div>
    <!-- end interactive banner item -->
</div>
<!-- end slider item -->
