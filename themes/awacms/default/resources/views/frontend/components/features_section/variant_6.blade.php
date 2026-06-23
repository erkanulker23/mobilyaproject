<section class="features_variant6"
         aria-labelledby="features-title-6"
         @if(isset($bgColor) || !empty($bgImage))
         style="@if(isset($bgColor))background-color: {{ $bgColor }};@endif @if(!empty($bgImage))background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center;@endif"
         @endif>
    <div class="container">
        <div class="features_variant6_header">
            <h2 id="features-title-6" class="features_variant6_title"
                data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "easing": "easeOutQuad" }'>
                {{ $title ?? 'Özelliklerimiz' }}
            </h2>
            <p class="features_variant6_description">
                {{ $subtitle ?? 'Güçlü özelliklerimizle fark yaratın.' }}
            </p>
        </div>
        <div class="features_variant6_grid"
            data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'>
            @foreach($features as $feature)
                <article class="features_variant6_card" itemscope itemtype="https://schema.org/Service">
                    <div class="features_variant6_icon_bg">
                        @if($feature->image)
                            <img src="{{ $feature->image }}"
                                 class="features_variant6_img"
                                 alt="{{ $feature->title }}"
                                 width="80"
                                 height="80"
                                 loading="lazy"
                                 itemprop="image" />
                        @elseif($feature->icon)
                            <div class="features_variant6_icon" role="img" aria-label="{{ $feature->title }} ikonu">
                                <i class="{{ $feature->icon }}"></i>
                            </div>
                        @endif
                    </div>
                    <div class="features_variant6_card_content">
                        <h3 class="features_variant6_card_title" itemprop="name">{{ $feature->title }}</h3>
                        <p class="features_variant6_card_description" itemprop="description">{{ $feature->description }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
