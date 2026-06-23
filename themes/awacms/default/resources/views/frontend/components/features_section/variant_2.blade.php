<section class="features_variant2"
         aria-labelledby="features-title-2"
         @if(isset($bgColor) || !empty($bgImage))
         style="@if(isset($bgColor))background-color: {{ $bgColor }};@endif @if(!empty($bgImage))background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center;@endif"
         @endif>
    <div class="container">
        <div class="features_variant2_header">
            <h2 id="features-title-2" class="features_variant2_title"
                data-anime='{ "translateX": [-30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "easing": "easeOutQuad" }'>
                {{ $title ?? 'Özelliklerimiz' }}
            </h2>
            <p class="features_variant2_description">
                {{ $subtitle ?? 'Güçlü ve modern özelliklerimizle fark yaratın.' }}
            </p>
        </div>
        <div class="features_variant2_container"
            data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 200, "easing": "easeOutQuad" }'>
            @foreach($features as $feature)
                <article class="features_variant2_card" itemscope itemtype="https://schema.org/Service">
                    <div class="features_variant2_left">
                        @if($feature->image)
                            <img src="{{ $feature->image }}"
                                 class="features_variant2_img"
                                 alt="{{ $feature->title }}"
                                 width="80"
                                 height="80"
                                 loading="lazy"
                                 itemprop="image" />
                        @elseif($feature->icon)
                            <div class="features_variant2_icon" role="img" aria-label="{{ $feature->title }} ikonu">
                                <i class="{{ $feature->icon }}"></i>
                            </div>
                        @endif
                    </div>
                    <div class="features_variant2_right">
                        <h3 class="features_variant2_card_title" itemprop="name">{{ $feature->title }}</h3>
                        <p class="features_variant2_card_description" itemprop="description">{{ $feature->description }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
