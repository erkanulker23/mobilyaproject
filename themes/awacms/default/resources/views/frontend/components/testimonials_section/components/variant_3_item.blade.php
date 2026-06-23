<div class="swiper-slide">
    <article class="testimonial_slider_variant3_card" itemscope itemtype="https://schema.org/Review">
        <meta itemprop="itemReviewed" content="{{ $title }}">
        <div class="testimonial_slider_variant3_card_content">
            <div class="testimonial_slider_variant3_card_rating" aria-hidden="true">
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
            <p class="testimonial_slider_variant3_card_text" itemprop="reviewBody">
                {{ Str::words($testimonial->description, 30, '...') }}
            </p>
            <div class="testimonial_slider_variant3_card_user" itemprop="author" itemscope itemtype="https://schema.org/Person">
                <div class="testimonial_slider_variant3_card_user_name" itemprop="name">
                    {{ $testimonial->name }}
                </div>
                <span class="testimonial_slider_variant3_card_user_role">

                    {{ $testimonial->company }}
                </span>
            </div>
            <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                <meta itemprop="ratingValue" content="{{ $testimonial->rating }}">
                <meta itemprop="bestRating" content="5">
            </div>
        </div>
    </article>
</div>

