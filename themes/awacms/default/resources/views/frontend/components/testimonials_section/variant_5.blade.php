<section class="testimonial_slider_variant5"
style="background-color: {{ isset($bgColor) ? $bgColor : '#2d1866' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\')' : '' }}">

    <div class="testimonial-container-2">
        <h1 class="testimonial_slider_variant5_title fw-700 fs-30 alt-font text-dark-gray">
            {{ $title }}
        </h1>
        <p class="testimonial_slider_variant5_description fs-15">
            {{ $subtitle }}
        </p>
        <div class="swiper testimonial_slider_variant5_swiper">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                    <div class="swiper-slide">
                        @include('frontend.components.testimonials_section.components.variant_5_item', ['testimonial' => $testimonial])
                    </div>
                @endforeach
            </div>

            <div class="swiper-pagination"></div>
        </div>
        <div class="all-reviews-btn-container text-center pt-5">
            <a href="{{ url('tr/musteri-yorumlari') }}" class="all-reviews-btn text-center text-white">Tüm Yorumlar</a>
        </div>
    </div>
</section>