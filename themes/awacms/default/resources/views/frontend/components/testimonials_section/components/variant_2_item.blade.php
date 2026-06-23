<article class="testimonial_slider_variant2_card" itemscope itemtype="https://schema.org/Review">
    <meta itemprop="itemReviewed" content="{{ $title }}">
    <div class="testimonial_slider_variant2_card_quote">
        <img src="{{ asset('themes/awacms/default/images/crm/ca-testimonialquote4.1.svg') }}" alt="Müşteri Yorumu İkonu" loading="lazy">
    </div>
    <div class="testimonial_slider_variant2_card_content">
        <p class="testimonial_slider_variant2_card_text" itemprop="reviewBody">
            {{ Str::words($testimonial->description, 20, '...') }}
        </p>
        <div class="testimonial_slider_variant2_card_rating" aria-hidden="true">
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
        <div class="testimonial_slider_variant2_card_user" itemprop="author" itemscope itemtype="https://schema.org/Person">
            @if($testimonial->image)
                <img src="{{ $testimonial->image }}" class="testimonial_slider_variant2_card_user_image" alt="Müşteri {{ $testimonial->name }}" loading="lazy" width="100" height="100">
            @else
                <img src="https://via.placeholder.com/100" class="testimonial_slider_variant2_card_user_image" alt="Müşteri {{ $testimonial->name }}" loading="lazy" width="100" height="100">
            @endif
            <div class="testimonial_slider_variant2_card_user_info">
                <h2 class="testimonial_slider_variant2_card_user_name" itemprop="name">
                    {{ $testimonial->name }}
                </h2>
                <span class="testimonial_slider_variant2_card_user_company">
                    {{ $testimonial->company }}
                </span>
            </div>
        </div>
        <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="{{ $testimonial->rating }}">
            <meta itemprop="bestRating" content="5">
        </div>
    </div>
</article>

