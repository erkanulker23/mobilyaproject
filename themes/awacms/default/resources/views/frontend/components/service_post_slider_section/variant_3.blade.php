<section class="services-variant3"
         aria-labelledby="services-title-3"
         @if(isset($bgColor) || !empty($bgImage))
         style="@if(isset($bgColor))background-color: {{ $bgColor }};@endif @if(!empty($bgImage))background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center;@endif"
         @endif>
        <div class="container-fluid">
            <div class="row align-items-center mb-6 services-variant3-top">
                <div class="col-lg-12 col-md-12 md-mb-20px">
                    <div class="services-variant3-title">
                        <h2 id="services-title-3" class="text-dark-gray fw-700 mb-0 ls-minus-1px">{{ $title ?? 'Hizmetlerimiz' }}</h2>
                        <p class="w-90 subtitle">{{ $subtitle ?? 'Profesyonel hizmetlerimizle tanışın' }}</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 position-relative">
                    <div class="swiper services-variant3-swiper" role="region" aria-label="Hizmetler kaydırıcısı">
                        <div class="swiper-wrapper">
                        @foreach($servicePosts as $service)
                            @include('frontend.components.service_post_slider_section.components.variant_3_item', ['servicePost' => $service])
                        @endforeach
                        </div>
                    </div>
                    <div class="d-flex justify-content-center justify-content-lg-center button-container mt-4">
                        <button class="swiper-button-prev services-variant3-swiper-prev" aria-label="Önceki hizmet"></button>
                        <button class="swiper-button-next services-variant3-swiper-next" aria-label="Sonraki hizmet"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script>
        const swiper3 = new Swiper('.services-variant3-swiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.services-variant3-swiper-next',
                prevEl: '.services-variant3-swiper-prev',
            },
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            a11y: {
                enabled: true,
                prevSlideMessage: 'Önceki hizmet',
                nextSlideMessage: 'Sonraki hizmet',
            },
            breakpoints: {
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 28,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                576: {
                    slidesPerView: 1,
                    spaceBetween: 16,
                },
                0: {
                    slidesPerView: 1,
                    spaceBetween: 16,
                }
            },
            effect: 'slide'
        });
    </script>
