<div class="swiper-slide">
    <article class="testimonial_slider_variant7_card" itemscope itemtype="https://schema.org/Review">
        <meta itemprop="itemReviewed" content="{{ $title }}">
        <div class="testimonial_slider_variant7_card_quote">
            <i class="fas fa-quote-right"></i>
        </div>
        <div class="testimonial_slider_variant7_card_image">
            @if($testimonial->image)
                <img src="{{ $testimonial->image }}" alt="Müşteri {{ $testimonial->name }}" loading="lazy" width="100" height="100">
            @else
                <img src="https://via.placeholder.com/100" alt="Müşteri {{ $testimonial->name }}" loading="lazy" width="100" height="100">
            @endif
            <div class="shape_img">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="40" cy="40" r="40" fill="#F68B21" fill-opacity="0.1"/>
                </svg>
            </div>
        </div>
        <div class="testimonial_slider_variant7_card_content">
            <div class="testimonial_slider_variant7_card_author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                <div class="testimonial_slider_variant7_card_author_rating" aria-hidden="true">
                    @php
                        $rating = round($testimonial->rating * 2) / 2; // 0.5 hassasiyeti için
                        $fullStars = floor($rating);
                        $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
                        $emptyStars = 5 - $fullStars - $halfStar;
                    @endphp
                    @for($i = 0; $i < $fullStars; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                    @if($halfStar)
                        <i class="fas fa-star-half-alt"></i>
                    @endif
                    @for($i = 0; $i < $emptyStars; $i++)
                        <i class="far fa-star"></i>
                    @endfor
                </div>
                <div class="testimonial_slider_variant7_card_author_name" itemprop="name">
                    {{ $testimonial->name }}
                </div>
                <span class="testimonial_slider_variant7_card_author_role">
                    {{ $testimonial->company }}
                </span>
            </div>
            <div class="testimonial_slider_variant7_card_text" itemprop="reviewBody">
                {{ Str::words($testimonial->description, 20, '...') }}
            </div>
            <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                <meta itemprop="ratingValue" content="{{ $testimonial->rating }}">
                <meta itemprop="bestRating" content="5">
            </div>
        </div>
    </article>
</div>

