<section class="testimonial_slider_variant8"
         aria-labelledby="testimonial-title-8"
         style="background-color: {{ isset($bgColor) ? $bgColor : '#2d1866' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\')' : '' }}">

    <div class="container">
        <div class="sec-title">
            <div class="sub-title">
                <h4>{{ $subtitle ?? 'Testimonials' }}</h4>
            </div>
            <h2 id="testimonial-title-8" class="fw-700 fs-30 alt-font text-dark-gray">{{ $title ?? 'Müşterilerimiz Ne Diyor?' }}</h2>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="swiper testimonial_slider_variant8__carousel">
                    <div class="swiper-wrapper">
                        @foreach($testimonials as $testimonial)
                            <div class="swiper-slide">
                                @include('frontend.components.testimonials_section.components.variant_8_item', ['testimonial' => $testimonial, 'title' => $title])
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Önceki yorum">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Sonraki yorum">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
        <div class="all-reviews-btn-container text-center mt-5">
            <a href="{{ url('tr/musteri-yorumlari') }}" class="all-reviews-btn" aria-label="Tüm müşteri yorumlarını görüntüle">Tüm Yorumlar</a>
        </div>
    </div>
</section>
