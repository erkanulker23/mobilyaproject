<section class="features_variant9"
         aria-labelledby="features-title-9"
         @if(isset($bgColor) || !empty($bgImage))
         style="@if(isset($bgColor))background-color: {{ $bgColor }};@endif @if(!empty($bgImage))background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center;@endif"
         @endif>
    <div class="container">
        <div class="features_variant9_header">
            <h2 id="features-title-9" class="features_variant9_title"
                data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "easing": "easeOutQuad" }'>
                {{ $title ?? 'Özelliklerimiz' }}
            </h2>
            <p class="features_variant9_description">
                {{ $subtitle ?? 'Eşsiz özelliklerimizi keşfedin.' }}
            </p>
        </div>
        <div class="features_variant9_grid"
            data-anime='{ "el": "childs", "scale": [0.95, 1], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'>
            @foreach($features as $feature)
                <article class="features_variant9_card" itemscope itemtype="https://schema.org/Service">
                    <div class="features_variant9_icon_wrapper">
                        @if($feature->image)
                            <img src="{{ $feature->image }}"
                                 class="features_variant9_img"
                                 alt="{{ $feature->title }}"
                                 width="60"
                                 height="60"
                                 loading="lazy"
                                 itemprop="image" />
                        @elseif($feature->icon)
                            <div class="features_variant9_icon" role="img" aria-label="{{ $feature->title }} ikonu">
                                <i class="{{ $feature->icon }}"></i>
                            </div>
                        @endif
                    </div>
                    <h3 class="features_variant9_card_title" itemprop="name">{{ $feature->title }}</h3>
                    <p class="features_variant9_card_description" itemprop="description">{{ $feature->description }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
