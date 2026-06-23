<section class="blog_slider_variant1" aria-labelledby="blog-title-1">
    <div class="container">
        <div class="blog_slider_v1_header">
            <h2 id="blog-title-1">{{ $title ?? 'Son Blog Yazıları' }}</h2>
            <p class="subtitle">{{ $subtitle ?? 'En güncel içeriklerimizi keşfedin' }}</p>
        </div>
        @if($posts->count() > 0)
            <div class="swiper blog_slider_v1_swiper" role="region" aria-label="Blog yazıları kaydırıcısı">
                <div class="swiper-wrapper">
                    @foreach($posts as $post)
                        <div class="swiper-slide">
                            <article class="blog_card_v1" itemscope itemtype="https://schema.org/BlogPosting">
                                <a href="{{ $post->url }}" class="blog_card_v1_image">
                                    <img src="{{ $post->listingImage }}"
                                         alt="{{ $post->title }}"
                                         width="400"
                                         height="280"
                                         loading="lazy"
                                         itemprop="image">
                                </a>
                                <div class="blog_card_v1_content">
                                    <div class="blog_card_v1_meta">
                                        <span class="blog_card_v1_category" itemprop="articleSection">{{ $post->category->name ?? 'Blog' }}</span>
                                        <time class="blog_card_v1_date" datetime="{{ $post->date ?? now()->format('Y-m-d') }}" itemprop="datePublished">
                                            {{ $post->date ?? now()->format('d M Y') }}
                                        </time>
                                    </div>
                                    <h3 class="blog_card_v1_title" itemprop="headline">
                                        <a href="{{ $post->url }}">{{ $post->title }}</a>
                                    </h3>
                                    <p class="blog_card_v1_description" itemprop="description">{{ Str::words($post->shortDescription, 15, '...') }}</p>
                                    <a href="{{ $post->url }}" class="blog_card_v1_link" aria-label="{{ $post->title }} yazısını oku">
                                        Devamını Oku →
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination blog_slider_v1_pagination"></div>
                <div class="swiper-button-prev blog_slider_v1_prev" tabindex="0" role="button" aria-label="Önceki yazı">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="swiper-button-next blog_slider_v1_next" tabindex="0" role="button" aria-label="Sonraki yazı">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        @else
            <p class="no-posts">Henüz blog yazısı bulunmamaktadır.</p>
        @endif
    </div>
</section>

<script>
    const blogSlider1 = new Swiper('.blog_slider_v1_swiper', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        autoplay: { delay: 5000, disableOnInteraction: false },
        pagination: { el: '.blog_slider_v1_pagination', clickable: true },
        navigation: { nextEl: '.blog_slider_v1_next', prevEl: '.blog_slider_v1_prev' },
        keyboard: { enabled: true },
        a11y: { enabled: true },
        breakpoints: {
            1200: { slidesPerView: 3, spaceBetween: 30 },
            992: { slidesPerView: 3, spaceBetween: 24 },
            768: { slidesPerView: 2, spaceBetween: 20 },
            576: { slidesPerView: 1, spaceBetween: 16 }
        }
    });
</script>
