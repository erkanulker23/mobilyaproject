<section class="services-variant1"
         aria-labelledby="services-title-1"
         @if(isset($bgColor) || !empty($bgImage))
         style="@if(isset($bgColor))background-color: {{ $bgColor }};@endif @if(!empty($bgImage))background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center;@endif"
         @endif>
        <div class="container-fluid">
            <div class="row align-items-center mb-6 services-variant1-top">
                <div class="col-12">
                    <div class="services-variant1-title">
                        <h2 id="services-title-1" class="text-dark-gray fw-700 mb-0 ls-minus-1px">{{ $title ?? 'Hizmetlerimiz' }}</h2>
                        <p class="w-90 mx-auto subtitle">{{ $subtitle ?? 'Profesyonel hizmetlerimizle tanışın' }}</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col-lg-8 col-md-12 position-relative">
                    <div class="swiper services-variant1-swiper" role="region" aria-label="Hizmetler kaydırıcısı">
                        <div class="swiper-wrapper">
                        @foreach($servicePosts as $service)
                            @include('frontend.components.service_post_slider_section.components.variant_1_item', ['servicePost' => $service])
                        @endforeach
                        </div>
                    </div>
                    <div class="col-lg-2 d-flex justify-content-center justify-content-lg-end button-container">
                        <button class="swiper-button-prev services-variant1-swiper-prev" aria-label="Önceki hizmet"></button>
                        <button class="swiper-button-next services-variant1-swiper-next" aria-label="Sonraki hizmet"></button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 description-column">
                    <h3>Uzmanlığımız</h3>
                    <p>Yıllara dayanan deneyimimizle, işletmenizin büyümesine ve başarısına yardımcı olacak özelleştirilmiş çözümler sunuyoruz. Uzman ekibimiz, sonuç odaklı stratejiler geliştirmeye kendini adamıştır.</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        const swiper1 = new Swiper('.services-variant1-swiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.services-variant1-swiper-next',
                prevEl: '.services-variant1-swiper-prev',
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
                    slidesPerView: 3,
                    spaceBetween: 28,
                },
                992: {
                    slidesPerView: 2,
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
