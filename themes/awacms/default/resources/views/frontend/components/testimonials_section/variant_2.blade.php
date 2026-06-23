<section class="testimonial_slider_variant2"
style="background-color: {{ isset($bgColor) ? $bgColor : '#2d1866' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\')' : '' }}">

    <div class="container">
        <h1 class="testimonial_slider_variant2_title fw-700 fs-30 alt-font text-dark-gray">
            {{ $title }}
        </h1>
        <p class="testimonial_slider_variant2_description fs-15">
            {{ $subtitle }}
        </p>
        <div class="swiper testimonial_slider_variant2_swiper">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                    <div class="swiper-slide">
                        @include('frontend.components.testimonials_section.components.variant_2_item', ['testimonial' => $testimonial])
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev testimonial-nav-prev">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="swiper-button-next testimonial-nav-next">
                <i class="fas fa-chevron-right"></i>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="all-reviews-btn-container text-center">
            <a href="{{ url('tr/musteri-yorumlari') }}" class="all-reviews-btn text-white">Tüm Yorumlar</a>
        </div>
    </div>
</section>