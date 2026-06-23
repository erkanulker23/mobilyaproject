<section class="blog_slider_variant3" aria-labelledby="blog-title-3">
    <div class="container">
        <div class="blog_slider_v3_header">
            <h2 id="blog-title-3">{{ $title ?? 'Son Blog Yazıları' }}</h2>
            <p class="subtitle">{{ $subtitle ?? 'En güncel içeriklerimizi keşfedin' }}</p>
        </div>
        @if($posts->count() > 0)
            <div class="swiper blog_slider_v3_swiper" role="region" aria-label="Blog yazıları kaydırıcısı">
                <div class="swiper-wrapper">
                    @foreach($posts as $post)
                        <div class="swiper-slide">
                            <article class="blog_card_v3" itemscope itemtype="https://schema.org/BlogPosting">
                                <a href="{{ $post->url }}" class="blog_card_v3_wrapper">
                                    <div class="blog_card_v3_image">
                                        <img src="{{ $post->listingImage }}"
                                             alt="{{ $post->title }}"
                                             width="600"
                                             height="400"
                                             loading="lazy"
                                             itemprop="image">
                                        <div class="blog_card_v3_overlay"></div>
                                    </div>
                                    <div class="blog_card_v3_content">
                                        <span class="blog_card_v3_category" itemprop="articleSection">{{ $post->category->name ?? 'Blog' }}</span>
                                        <h3 class="blog_card_v3_title" itemprop="headline">{{ $post->title }}</h3>
                                        <time class="blog_card_v3_date" datetime="{{ $post->date ?? now()->format('Y-m-d') }}" itemprop="datePublished">
                                            {{ $post->date ?? now()->format('d M Y') }}
                                        </time>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev blog_slider_v3_prev" tabindex="0" role="button" aria-label="Önceki yazı">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="swiper-button-next blog_slider_v3_next" tabindex="0" role="button" aria-label="Sonraki yazı">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        @else
            <p class="no-posts">Henüz blog yazısı bulunmamaktadır.</p>
        @endif
    </div>
</section>

<script>
    const blogSlider3 = new Swiper('.blog_slider_v3_swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: { delay: 5000, disableOnInteraction: false },
        navigation: { nextEl: '.blog_slider_v3_next', prevEl: '.blog_slider_v3_prev' },
        keyboard: { enabled: true },
        a11y: { enabled: true },
        breakpoints: {
            1200: { slidesPerView: 3, spaceBetween: 30 },
            768: { slidesPerView: 2, spaceBetween: 24 }
        }
    });
</script>
