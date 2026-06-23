<div class="swiper-slide">
    <div class="services__item">
        <div class="services__thumb-wrap">
            <div class="services__thumb"
                style="mask-image: url('{{ theme_asset('images/crm/mask_img.svg') }}');
                       -webkit-mask-image: url('{{ theme_asset('images/crm/mask_img.svg') }}');
                       mask-size: cover;
                       -webkit-mask-size: cover;">
                <img src="{{ $serviceCategory->detailsImage }}" alt="{{ $serviceCategory->name }}">

                <a href="{{ $serviceCategory->url }}"
                   class="btn btn-two border-btn"
                   title="{{ $serviceCategory->name }} detaylarını inceleyin"
                   aria-label="{{ $serviceCategory->name }} hizmeti hakkında daha fazla bilgi">
                    DETAY
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"
                         data-inject-url="https://themeadapt.com/tf/logistex/assets/img/icon/right_arrow.svg"
                         class="injectable">
                        <path d="M1 12.0969L12.0969 0.999996M12.0969 0.999996H1M12.0969 0.999996V12.0969"
                              stroke="currentcolor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
            </div>
            <div class="services__icon bg-customwebbg">
                <i class="fa-regular fa-bookmark" aria-hidden="true"></i>
            </div>
        </div>

        <div class="services__content">
            <h3 class="title">
                <a href="{{ $serviceCategory->url }}"
                   title="{{ $serviceCategory->name }} sayfasına git"
                   aria-label="{{ $serviceCategory->name }} hizmet detaylarını görüntüle">
                    {{ $serviceCategory->name }}
                </a>
            </h3>
            <p>{{ $serviceCategory->shortDescription }}.</p>
        </div>
    </div>
</div>
