<div class="slider_variant1-container">
        <div class="swiper">
            <div class="swiper-wrapper">
            @foreach ($slider->slides as $slide)
                @include('frontend.components.slider.components.variant_1_item', ['slide' => $slide])
            @endforeach
            </div>
            <!-- Navigation Buttons -->
            <div class="slider_variant1-prev"><i class="fas fa-chevron-left"></i></div>
            <div class="slider_variant1-next"><i class="fas fa-chevron-right"></i></div>
            <!-- Pagination -->
            <div class="slider_variant1-pagination"></div>
        </div>
    </div>
