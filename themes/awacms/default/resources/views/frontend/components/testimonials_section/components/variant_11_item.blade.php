<div class="swiper-slide">
    <article class="testimonial_slider_variant11-card" itemscope itemtype="https://schema.org/Review">
        <meta itemprop="itemReviewed" content="{{ $title }}">
        <div class="logo">
            <i class="fas fa-sun"></i> {{ $testimonial->logo ?? 'Logoipsum' }}
        </div>
        <p itemprop="reviewBody">
            {{ Str::words($testimonial->description, 30, '...') }}
        </p>
        <div class="author" itemprop="author" itemscope itemtype="https://schema.org/Person">
            @if($testimonial->image)
                <img src="{{ $testimonial->image }}" alt="Müşteri {{ $testimonial->name }}" loading="lazy" width="40" height="40">
            @else
                <img src="https://via.placeholder.com/40" alt="Müşteri {{ $testimonial->name }}" loading="lazy" width="40" height="40">
            @endif
            <span itemprop="name">{{ $testimonial->name }}</span> / {{ $testimonial->company }}
        </div>
        <div class="ratings">
            <div class="rating-item">
                <img src="https://www.google.com/favicon.ico" alt="Google">
                Google Rating
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
                {{ number_format($testimonial->rating, 1) }}
            </div>
            <div class="rating-item">
                <img src="https://www.trustpilot.com/favicon.ico" alt="Trustpilot">
                Rated Trustpilot
                <div class="stars" aria-hidden="true">
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
                {{ number_format($testimonial->rating, 1) }}
            </div>
        </div>
        <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="{{ $testimonial->rating }}">
            <meta itemprop="bestRating" content="5">
        </div>
    </article>
</div>

<script>
  // Initialize Swiper after the DOM is fully loaded
  document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.testimonial_slider_variant11__carousel', {
      loop: true,
      slidesPerView: 1, // Tek kart göster
      spaceBetween: 20, // Kartlar arası boşluk
      autoplay: {
        delay: 10000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
  });
</script>
