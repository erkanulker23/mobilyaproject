<section class="testimonial_slider_variant11"
style="background-color: {{ isset($bgColor) ? $bgColor : '#2d1866' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\')' : '' }}">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="label">
                    <i class="fas fa-dollar-sign"></i>
                    {{ $label ?? 'OUR TESTIMONIAL' }}
                </div>
                <h2 class="fw-700 fs-30 alt-font text-dark-gray">{{ $title }}</h2>
                <p class="description">{{ $description ?? 'With over 1250 satisfied clients, our finance, consulting services have earned reliable, personalized guidance, and impactful results.' }}</p>
                <a href="{{ $contactUrl ?? '#' }}" class="contact-btn">CONTACT NOW <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="col-md-6">
                <div class="swiper testimonial_slider_variant11__carousel">
                    <div class="swiper-wrapper">
                        @foreach($testimonials as $testimonial)
                            <div class="swiper-slide">
                                @include('frontend.components.testimonials_section.components.variant_11_item', ['testimonial' => $testimonial])
                            </div>
                        @endforeach
                    </div>

                    <div class="swiper-button-prev variant11-prev">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="swiper-button-next variant11-next">
                            <i class="fas fa-chevron-right"></i>
                        </div>

                </div>
            </div>
        </div>
        <div class="all-reviews-btn-container text-center mt-5">
            <a href="{{ url('tr/musteri-yorumlari') }}" class="all-reviews-btn text-center text-white">Tüm Yorumlar</a>
        </div>
    </div>
</section>

