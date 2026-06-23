<div class="swiper-slide">
    <article class="testimonial_slider_variant1_card" itemscope itemtype="https://schema.org/Review">
        <meta itemprop="itemReviewed" content="{{ $title ?? 'Service' }}">
        <div class="testimonial_slider_variant1_card_quote" aria-hidden="true">
            <img src="https://rifatogludepolama.com/themes/awacms/default/images/crm/ca-testimonialquote4.1.svg"
                 alt="Müşteri Yorumu İkonu"
                 loading="lazy"
                 width="50"
                 height="50">
        </div>
        <div class="testimonial_slider_variant1_card_content">
            <p class="testimonial_slider_variant1_card_text" itemprop="reviewBody">
                {{ Str::words($testimonial->description, 30, '...') }}
            </p>
            <div class="testimonial_slider_variant1_card_rating" aria-hidden="true">
                @for($i = 0; $i < round($testimonial->rating); $i++)
                    <i class="bi bi-star-fill"></i>
                @endfor
                @for($i = round($testimonial->rating); $i < 5; $i++)
                    <i class="bi bi-star"></i>
                @endfor
            </div>
            <div class="testimonial_slider_variant1_card_user">
                @if($testimonial->image)
                    <img src="{{ $testimonial->image }}"
                         class="testimonial_slider_variant1_card_user_image"
                         alt="{{ $testimonial->name }}"
                         loading="lazy"
                         width="60"
                         height="60">
                @endif
                <div class="testimonial_slider_variant1_card_user_info" itemprop="author" itemscope itemtype="https://schema.org/Person">
                    <h3 class="testimonial_slider_variant1_card_user_name" itemprop="name">{{ $testimonial->name }}</h3>
                    <span class="testimonial_slider_variant1_card_user_company">{{ $testimonial->company }}</span>
                </div>
            </div>
            <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                <meta itemprop="ratingValue" content="{{ $testimonial->rating }}">
                <meta itemprop="bestRating" content="5">
            </div>
        </div>
    </article>
</div>
