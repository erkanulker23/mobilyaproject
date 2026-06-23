<div class="swiper-slide">
    <article class="signle-testimonial-item d-flex testimonial_slider_variant9__item" itemscope itemtype="https://schema.org/Review">
        <meta itemprop="itemReviewed" content="{{ $title }}">
        <div class="image-wrapper">
            @if($testimonial->image)
                <img src="{{ $testimonial->image }}" alt="Müşteri {{ $testimonial->name }}" loading="lazy" width="191" height="191">
            @else
                <img src="https://via.placeholder.com/191" alt="Müşteri {{ $testimonial->name }}" loading="lazy" width="191" height="191">
            @endif
        </div>
        <div class="content">
            <div class="star text-center text-md-start" aria-hidden="true">
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
            <p itemprop="reviewBody">
                {{ Str::words($testimonial->description, 30, '...') }}
            </p>
            <div class="clints-infu pt-4 pt-lg-5 text-center text-md-start" itemprop="author" itemscope itemtype="https://schema.org/Person">
                <h5 itemprop="name">{{ $testimonial->name }}</h5>
                <span>{{ $testimonial->company }}</span>
            </div>
            <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                <meta itemprop="ratingValue" content="{{ $testimonial->rating }}">
                <meta itemprop="bestRating" content="5">
            </div>
        </div>
    </article>
</div>