<div class="swiper-slide">
    <article class="services-variant3-card" itemscope itemtype="https://schema.org/Service">
        <img src="{{ $servicePost->listingImage }}"
             alt="{{ $servicePost->title }}"
             width="400"
             height="300"
             loading="lazy"
             itemprop="image">
        <span class="category">{{ $servicePost->categories?->first()?->name ?? 'Hizmet' }}</span>
        <div class="overlay"></div>
        <div class="content">
            <i class="ti-eye" aria-hidden="true"></i>
            <div class="text">
                <h3 class="servicestitle" itemprop="name">
                    <a href="{{ $servicePost->url }}" class="text-decoration-none">{{ $servicePost->title }}</a>
                </h3>
                <p class="description" itemprop="description">{{ Str::words($servicePost->shortDescription, 14, '...') }}</p>
                <a href="{{ $servicePost->url }}"
                   class="more-info-btn"
                   aria-label="{{ $servicePost->title }} hakkında daha fazla bilgi"
                   itemprop="url">
                    <i class="ti-arrow-right" aria-hidden="true"></i> Daha Fazla Bilgi
                </a>
            </div>
        </div>
    </article>
</div>





