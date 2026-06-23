<section class="blog_slider_variant4" aria-labelledby="blog-title-4">
    <div class="container">
        <div class="blog_slider_v4_header">
            <h2 id="blog-title-4">{{ $title ?? 'Son Blog Yazıları' }}</h2>
            <p class="subtitle">{{ $subtitle ?? 'En güncel içeriklerimizi keşfedin' }}</p>
        </div>
        @if($posts->count() > 0)
            <div class="swiper blog_slider_v4_swiper" role="region" aria-label="Blog yazıları kaydırıcısı">
                <div class="swiper-wrapper">
                    @foreach($posts as $post)
                        <div class="swiper-slide">
                            <article class="blog_card_v4" itemscope itemtype="https://schema.org/BlogPosting">
                                <div class="blog_card_v4_content">
                                    <span class="blog_card_v4_category" itemprop="articleSection">{{ $post->category->name ?? 'Blog' }}</span>
                                    <h3 class="blog_card_v4_title" itemprop="headline">
                                        <a href="{{ $post->url }}">{{ $post->title }}</a>
                                    </h3>
                                    <time class="blog_card_v4_date" datetime="{{ $post->date ?? now()->format('Y-m-d') }}" itemprop="datePublished">
                                        {{ $post->date ?? now()->format('d M Y') }}
                                    </time>
                                    <p class="blog_card_v4_description" itemprop="description">{{ Str::words($post->shortDescription, 25, '...') }}</p>
                                    <a href="{{ $post->url }}" class="blog_card_v4_link" aria-label="{{ $post->title }} yazısını oku">
                                        Yazıyı Oku <span class="blog_card_v4_arrow">→</span>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev blog_slider_v4_prev" tabindex="0" role="button" aria-label="Önceki yazı">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="swiper-button-next blog_slider_v4_next" tabindex="0" role="button" aria-label="Sonraki yazı">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        @else
            <p class="no-posts">Henüz blog yazısı bulunmamaktadır.</p>
        @endif
    </div>
</section>

<script>
    const blogSlider4 = new Swiper('.blog_slider_v4_swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: { delay: 5000, disableOnInteraction: false },
        navigation: { nextEl: '.blog_slider_v4_next', prevEl: '.blog_slider_v4_prev' },
        keyboard: { enabled: true },
        a11y: { enabled: true },
        breakpoints: {
            1200: { slidesPerView: 2, spaceBetween: 40 },
            768: { slidesPerView: 1, spaceBetween: 30 }
        }
    });
</script>

