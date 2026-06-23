<section class="testimonial_slider_variant1" aria-labelledby="testimonial-title-1">
    <div class="container">
        <h2 id="testimonial-title-1" class="testimonial_slider_variant1_title">{{ $title ?? 'Müşterilerimiz Ne Diyor?' }}</h2>
        <p class="testimonial_slider_variant1_description fs-15">
            {{ $subtitle ?? 'Müşterilerimizin deneyimlerini okuyun' }}
        </p>
        <div class="swiper testimonial_slider_variant1_swiper">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                    @include('frontend.components.testimonials_section.components.variant_1_item', ['testimonial' => $testimonial, 'title' => $title])
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="all-reviews-btn-container text-center mt-5">
            <a href="{{ url('tr/musteri-yorumlari') }}" class="all-reviews-btn" aria-label="Tüm müşteri yorumlarını görüntüle">Tüm Yorumlar</a>
        </div>
    </div>
</section>
