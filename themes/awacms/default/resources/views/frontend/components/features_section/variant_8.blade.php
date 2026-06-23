<section class="features_variant8"
         aria-labelledby="features-title-8"
         @if(isset($bgColor) || !empty($bgImage))
         style="@if(isset($bgColor))background-color: {{ $bgColor }};@endif @if(!empty($bgImage))background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center;@endif"
         @endif>
    <div class="container">
        <div class="features_variant8_header">
            <h2 id="features-title-8" class="features_variant8_title"
                data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "easing": "easeOutQuad" }'>
                {{ $title ?? 'Özelliklerimiz' }}
            </h2>
            <p class="features_variant8_description">
                {{ $subtitle ?? 'Kapsamlı özelliklerimizi inceleyin.' }}
            </p>
        </div>
        <div class="features_variant8_grid"
            data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'>
            @foreach($features as $feature)
                <article class="features_variant8_card" itemscope itemtype="https://schema.org/Service">
                    <div class="features_variant8_content">
                        <h3 class="features_variant8_card_title" itemprop="name">{{ $feature->title }}</h3>
                        <p class="features_variant8_card_description" itemprop="description">{{ $feature->description }}</p>
                    </div>
                    <div class="features_variant8_top">
                        @if($feature->image)
                            <img src="{{ $feature->image }}"
                                 class="features_variant8_img"
                                 alt="{{ $feature->title }}"
                                 width="80"
                                 height="80"
                                 loading="lazy"
                                 itemprop="image" />
                        @elseif($feature->icon)
                            <div class="features_variant8_icon" role="img" aria-label="{{ $feature->title }} ikonu">
                                <i class="{{ $feature->icon }}"></i>
                            </div>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
