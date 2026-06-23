<section class="testimonial_slider_variant6"
         aria-labelledby="testimonial-title-6"
         style="background-color: {{ isset($bgColor) ? $bgColor : '#f8fafc' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\'); background-size: cover; background-position: center;' : '' }}">

    <div class="container">
        <div class="testimonial_v6_header text-center">
            <span class="testimonial_v6_badge">{{ $subtitle ?? 'Testimonials' }}</span>
            <h2 id="testimonial-title-6" class="testimonial_v6_title">{{ $title ?? 'What Our Clients Say' }}</h2>
        </div>

        @if($testimonials->count() > 0)
            <div class="swiper testimonial_slider_variant6_swiper">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                        <div class="swiper-slide">
                            @include('frontend.components.testimonials_section.components.variant_6_item', ['testimonial' => $testimonial, 'title' => $title])
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev testimonial_v6_prev" tabindex="0" role="button" aria-label="Previous testimonial">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <div class="swiper-button-next testimonial_v6_next" tabindex="0" role="button" aria-label="Next testimonial">
                    <i class="fas fa-arrow-right"></i>
                </div>
                <div class="swiper-pagination testimonial_v6_pagination"></div>
            </div>
        @endif

        <div class="all-reviews-btn-container text-center mt-5">
            <a href="{{ url('tr/musteri-yorumlari') }}" class="all-reviews-btn" aria-label="View all testimonials">Tüm Yorumlar</a>
        </div>
    </div>
</section>
