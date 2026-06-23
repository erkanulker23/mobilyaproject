<section class="features_variant1"
         aria-labelledby="features-title-1"
         @if(isset($bgColor) || !empty($bgImage))
         style="@if(isset($bgColor))background-color: {{ $bgColor }};@endif @if(!empty($bgImage))background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center;@endif"
         @endif>
    <div class="container">
        <div class="features_variant1_header">
            <h2 id="features-title-1" class="features_variant1_title"
                data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                {{ $title ?? 'Özelliklerimiz' }}
            </h2>
            <p class="features_variant1_description">
                {{ $subtitle ?? 'Modern ve kullanıcı dostu özelliklerimizle tanışın.' }}
            </p>
        </div>
        <div class="features_variant1_grid"
            data-anime='{ "el": "childs", "willchange": "transform", "scale":[0.95,1], "opacity": [0, 1], "duration": 800, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'>
            @foreach($features as $feature)
                <article class="features_variant1_card" itemscope itemtype="https://schema.org/Service">
                    <div class="features_variant1_icon_wrapper">
                        @if($feature->image)
                            <img src="{{ $feature->image }}"
                                 class="features_variant1_img"
                                 alt="{{ $feature->title }}"
                                 width="70"
                                 height="70"
                                 loading="lazy"
                                 itemprop="image" />
                        @elseif($feature->icon)
                            <div class="features_variant1_icon" role="img" aria-label="{{ $feature->title }} ikonu">
                                <i class="{{ $feature->icon }}"></i>
                            </div>
                        @endif
                    </div>
                    <h3 class="features_variant1_card_title" itemprop="name">{{ $feature->title }}</h3>
                    <p class="features_variant1_card_description" itemprop="description">{{ $feature->description }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
