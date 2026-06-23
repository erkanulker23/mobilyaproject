<section class="features_variant3"
         aria-labelledby="features-title-3"
         @if(isset($bgColor) || !empty($bgImage))
         style="@if(isset($bgColor))background-color: {{ $bgColor }};@endif @if(!empty($bgImage))background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center;@endif"
         @endif>
    <div class="container">
        <div class="features_variant3_header">
            <h2 id="features-title-3" class="features_variant3_title"
                data-anime='{ "scale": [0.8, 1], "opacity": [0,1], "duration": 600, "delay": 0, "easing": "easeOutQuad" }'>
                {{ $title ?? 'Özelliklerimiz' }}
            </h2>
            <p class="features_variant3_description">
                {{ $subtitle ?? 'Modern çözümlerimizle tanışın.' }}
            </p>
        </div>
        <div class="features_variant3_grid"
            data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'>
            @foreach($features as $feature)
                <article class="features_variant3_card" itemscope itemtype="https://schema.org/Service">
                    <div class="features_variant3_card_top">
                        @if($feature->image)
                            <img src="{{ $feature->image }}"
                                 class="features_variant3_img"
                                 alt="{{ $feature->title }}"
                                 width="60"
                                 height="60"
                                 loading="lazy"
                                 itemprop="image" />
                        @elseif($feature->icon)
                            <div class="features_variant3_icon" role="img" aria-label="{{ $feature->title }} ikonu">
                                <i class="{{ $feature->icon }}"></i>
                            </div>
                        @endif
                    </div>
                    <h3 class="features_variant3_card_title" itemprop="name">{{ $feature->title }}</h3>
                    <p class="features_variant3_card_description" itemprop="description">{{ $feature->description }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
