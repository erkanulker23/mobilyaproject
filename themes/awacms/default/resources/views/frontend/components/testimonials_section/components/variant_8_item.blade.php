<div class="swiper-slide">
    <article class="testimonial_slider_variant8__single" itemscope itemtype="https://schema.org/Review">
        <meta itemprop="itemReviewed" content="{{ $title ?? 'Service' }}">
        <div class="overlay-icon">
            <span class="icon-quote">"</span>
        </div>
        <div class="testimonial_slider_variant8__single-img">
            @if($testimonial->image)
                <img src="{{ $testimonial->image }}" alt="Müşteri {{ $testimonial->name }}" loading="lazy" width="70" height="70">
            @else
                <img src="https://via.placeholder.com/70" alt="Müşteri {{ $testimonial->name }}" loading="lazy" width="70" height="70">
            @endif
        </div>
        <div class="testimonial_slider_variant8__single-content">
            <div class="title-box">
                <h3>{{ $testimonial->title ?? 'Customer Review' }}</h3>
                <p itemprop="reviewBody">
                    {{ Str::words($testimonial->description, 30, '...') }}
                </p>
            </div>
            <div class="customer-info">
                <div class="company-name" itemprop="author" itemscope itemtype="https://schema.org/Person">
                    <h3 itemprop="name">{{ $testimonial->name }}</h3>
                    <span>{{ $testimonial->company }}</span>
                </div>
                <div class="rating-stars" aria-hidden="true">
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
            <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                <meta itemprop="ratingValue" content="{{ $testimonial->rating }}">
                <meta itemprop="bestRating" content="5">
            </div>
        </div>
    </article>
</div>

