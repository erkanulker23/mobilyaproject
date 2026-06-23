<section class="testimonial_slider_variant3"
style="background-color: {{ isset($bgColor) ? $bgColor : '#2d1866' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\')' : '' }}">

    <div class="container">
        <h1 class="testimonial_slider_variant3_title fw-700 fs-30 alt-font text-dark-gray">
            {{ $title }}
        </h1>
        <p class="testimonial_slider_variant3_description fs-15">
            {{ $subtitle }}
        </p>
        <div class="swiper testimonial_slider_variant3_swiper">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                    @include('frontend.components.testimonials_section.components.variant_3_item', ['testimonial' => $testimonial])
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
        <div class="all-reviews-btn-container text-center p-4">
            <a href="{{ url('tr/musteri-yorumlari') }}" class="all-reviews-btn text-center text-white">Tüm Yorumlar</a>
        </div>
    </div>
</section>
