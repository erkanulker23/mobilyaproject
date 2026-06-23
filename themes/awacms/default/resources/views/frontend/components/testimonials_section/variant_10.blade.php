<section class="testimonial_slider_variant10"
style="background-color: {{ isset($bgColor) ? $bgColor : '#2d1866' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\')' : '' }}">

    <div class="container">
        <h2 class="fw-700 fs-30 alt-font text-dark-gray">{{ $title }}</h2>
        <p class="subtitle">{{ $subtitle ?? 'Müşterilerimizin memnuniyetini keşfedin.' }}</p>
        <div class="swiper testimonial_slider_variant10__carousel">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                    <div class="swiper-slide">
                        @include('frontend.components.testimonials_section.components.variant_10_item', ['testimonial' => $testimonial])
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
        <div class="all-reviews-btn-container text-center mt-5">
            <a href="{{ url('tr/musteri-yorumlari') }}" class="all-reviews-btn">Tüm Yorumlar</a>
        </div>
    </div>
</section>
