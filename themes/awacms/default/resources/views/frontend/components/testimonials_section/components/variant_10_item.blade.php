<div class="swiper-slide">
    <article class="testimonial_slider_variant10-card" itemscope itemtype="https://schema.org/Review">
        <meta itemprop="itemReviewed" content="{{ $title }}">
        <div class="header-container">
            <div class="image-wrapper">
                @if($testimonial->image)
                    <img src="{{ $testimonial->image }}" alt="Müşteri {{ $testimonial->name }}" loading="lazy" width="191" height="191">
                @else
                    <img src="https://via.placeholder.com/191" alt="Müşteri {{ $testimonial->name }}" loading="lazy" width="191" height="191">
                @endif
            </div>
            <div class="stars" aria-hidden="true">
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
        </div>
        <p itemprop="reviewBody">
            {{ Str::words($testimonial->description, 30, '...') }}
        </p>
        <div class="author" itemprop="author" itemscope itemtype="https://schema.org/Person">
            <span itemprop="name">{{ $testimonial->name }}</span> / {{ $testimonial->company }}
        </div>
        <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="{{ $testimonial->rating }}">
            <meta itemprop="bestRating" content="5">
        </div>
    </article>
</div>