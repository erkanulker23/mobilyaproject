<div class="swiper-slide">
    <div class="features-two__single">
        <div class="features-two__single-img">
            <div class="features-two__single-img-inner">
                <img src="{{ $serviceCategory->detailsImage }}"
                     alt="{{ $serviceCategory->name }}"
                     width="600" height="400"
                     loading="lazy"
                     style="object-fit: cover; display: block; width: 100%; height: auto;">

                <div class="features-two__single-content">
                    <span>#</span>
                    <h2><a href="{{ $serviceCategory->url }}" title="{{ $serviceCategory->name }}">{{ $serviceCategory->name }}</a></h2>

                    <div class="features-two__single-content-bottom">
                        <p>{{ Str::words($serviceCategory->shortDescription, 14, '...') }}</p>

                        <div class="btn-box">
                            <a href="{{ $serviceCategory->url }}" title="{{ $serviceCategory->name }}" aria-label="Hizmet Detaylarını Görüntüle">
                               <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
