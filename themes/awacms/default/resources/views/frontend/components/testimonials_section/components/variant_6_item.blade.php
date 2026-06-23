<article class="testimonial_v6_card" itemscope itemtype="https://schema.org/Review">
    <meta itemprop="itemReviewed" content="{{ $title ?? 'Service' }}">

    <div class="testimonial_v6_card_header">
        <div class="testimonial_v6_author">
            <div class="testimonial_v6_avatar">
                @if($testimonial->image)
                    <img src="{{ $testimonial->image }}" alt="{{ $testimonial->name }}" loading="lazy" width="60" height="60">
                @else
                    <div class="testimonial_v6_avatar_placeholder">
                        <i class="fas fa-user"></i>
                    </div>
                @endif
            </div>
            <div class="testimonial_v6_author_info" itemprop="author" itemscope itemtype="https://schema.org/Person">
                <h3 class="testimonial_v6_author_name" itemprop="name">{{ $testimonial->name }}</h3>
                <span class="testimonial_v6_author_company">{{ $testimonial->company }}</span>
            </div>
        </div>

        <div class="testimonial_v6_rating" aria-hidden="true">
            @php
                $rating = round($testimonial->rating * 2) / 2;
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
    </div>

    <div class="testimonial_v6_card_body">
        <div class="testimonial_v6_quote_icon">
            <i class="fas fa-quote-left"></i>
        </div>
        <p class="testimonial_v6_text" itemprop="reviewBody">
            {{ Str::words($testimonial->description, 30, '...') }}
        </p>
    </div>

    <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
        <meta itemprop="ratingValue" content="{{ $testimonial->rating }}">
        <meta itemprop="bestRating" content="5">
    </div>
</article>
