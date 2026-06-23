<section class="testimonial_slider_variant4"
style="background-color: {{ isset($bgColor) ? $bgColor : '#2d1866' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\')' : '' }}">

    <div class="container">
        <h1 class="testimonial_slider_variant4_title fw-700 fs-30 alt-font text-dark-gray">
            {{ $title }}
        </h1>
        <p class="testimonial_slider_variant4_description fs-15">
            {{ $subtitle }}
        </p>
        <div class="swiper testimonial_slider_variant4_swiper">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                    <div class="swiper-slide">
                        @include('frontend.components.testimonials_section.components.variant_4_item', ['testimonial' => $testimonial])
                    </div>
                @endforeach
            </div>

        <div class="all-reviews-btn-container text-center pt-5">
            <a href="{{ url('tr/musteri-yorumlari') }}" class="all-reviews-btn text-center text-dark">Tüm Yorumlar</a>
        </div>
    </div>
</section>