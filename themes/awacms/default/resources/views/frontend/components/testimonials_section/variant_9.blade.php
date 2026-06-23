<section class="testimonial_slider_variant9"
style="background-color: {{ isset($bgColor) ? $bgColor : '#2d1866' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\')' : '' }}">

    <div class="shape">
        <div class="shape-1"></div>
        <div class="shape-2"></div>
    </div>
    <div class="container">
        <div class="section-title text-center">
            <div class="sub-title">
                <span>{{ $subtitle ?? 'Our Testimonial' }}</span>
            </div>
            <h2 class="fw-700 fs-30 alt-font text-dark-gray">{{ $title }}</h2>
            <p>{{ $description ?? 'Accelerate innovation with world-class tech teams...' }}</p>
        </div>
        <div class="testimonial_slider_variant9__inner overflow-hidden">
            <div class="swiper testimonial_slider_variant9__carousel">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                        <div class="swiper-slide">
                            @include('frontend.components.testimonials_section.components.variant_9_item', ['testimonial' => $testimonial])
                        </div>
                    @endforeach
                </div>
                <div class="array-button">
                    <button class="array-prev"><i class="fas fa-chevron-left"></i></button>
                    <button class="array-next"><i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="all-reviews-btn-container text-center m-5">
            <a href="{{ url('tr/musteri-yorumlari') }}" class="all-reviews-btn">Tüm Yorumlar</a>
        </div>
    </div>
</section>