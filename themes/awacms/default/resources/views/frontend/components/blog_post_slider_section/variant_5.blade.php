<section class="blog_slider_variant5" aria-labelledby="blog-title-5">
    <div class="container-fluid px-0">
        <div class="container">
            <div class="blog_slider_v5_header">
                <h2 id="blog-title-5">{{ $title ?? 'Son Blog Yazıları' }}</h2>
                <p class="subtitle">{{ $subtitle ?? 'En güncel içeriklerimizi keşfedin' }}</p>
                <div class="blog_slider_v5_controls">
                    <div class="swiper-button-prev blog_slider_v5_prev" tabindex="0" role="button" aria-label="Önceki yazı">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="swiper-button-next blog_slider_v5_next" tabindex="0" role="button" aria-label="Sonraki yazı">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
        @if($posts->count() > 0)
            <div class="swiper blog_slider_v5_swiper" role="region" aria-label="Blog yazıları kaydırıcısı">
                <div class="swiper-wrapper">
                    @foreach($posts as $post)
                        <div class="swiper-slide">
                            <article class="blog_card_v5" itemscope itemtype="https://schema.org/BlogPosting">
                                <a href="{{ $post->url }}" class="blog_card_v5_link">
                                    <div class="blog_card_v5_image">
                                        <img src="{{ $post->listingImage }}"
                                             alt="{{ $post->title }}"
                                             width="400"
                                             height="500"
                                             loading="lazy"
                                             itemprop="image">
                                        <div class="blog_card_v5_overlay"></div>
                                    </div>
                                    <div class="blog_card_v5_content">
                                        <span class="blog_card_v5_category" itemprop="articleSection">{{ $post->category->name ?? 'Blog' }}</span>
                                        <h3 class="blog_card_v5_title" itemprop="headline">{{ $post->title }}</h3>
                                        <time class="blog_card_v5_date" datetime="{{ $post->date ?? now()->format('Y-m-d') }}" itemprop="datePublished">
                                            {{ $post->date ?? now()->format('d M Y') }}
                                        </time>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="container">
                <p class="no-posts">Henüz blog yazısı bulunmamaktadır.</p>
            </div>
        @endif
    </div>
</section>

<script>
    const blogSlider5 = new Swiper('.blog_slider_v5_swiper', {
        slidesPerView: 2,
        spaceBetween: 20,
        loop: true,
        autoplay: { delay: 5000, disableOnInteraction: false },
        navigation: { nextEl: '.blog_slider_v5_next', prevEl: '.blog_slider_v5_prev' },
        keyboard: { enabled: true },
        a11y: { enabled: true },
        breakpoints: {
            1400: { slidesPerView: 5, spaceBetween: 24 },
            1200: { slidesPerView: 4, spaceBetween: 20 },
            992: { slidesPerView: 3, spaceBetween: 20 },
            768: { slidesPerView: 2, spaceBetween: 16 },
            576: { slidesPerView: 2, spaceBetween: 12 },
            0: { slidesPerView: 1, spaceBetween: 12 }
        }
    });
</script>
