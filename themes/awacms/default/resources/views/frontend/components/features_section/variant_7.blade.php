<section class="features_variant7"
         aria-labelledby="features-title-7"
         @if(isset($bgColor) || !empty($bgImage))
         style="@if(isset($bgColor))background-color: {{ $bgColor }};@endif @if(!empty($bgImage))background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center;@endif"
         @endif>
    <div class="container">
        <div class="features_variant7_header">
            <h2 id="features-title-7" class="features_variant7_title"
                data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "easing": "easeOutQuad" }'>
                {{ $title ?? 'Özelliklerimiz' }}
            </h2>
            <p class="features_variant7_description">
                {{ $subtitle ?? 'Yenilikçi çözümlerimizle tanışın.' }}
            </p>
        </div>
        <div class="features_variant7_grid"
            data-anime='{ "el": "childs", "scale": [0.9, 1], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'>
            @foreach($features as $feature)
                <article class="features_variant7_card" itemscope itemtype="https://schema.org/Service">
                    @if($feature->image)
                        <img src="{{ $feature->image }}"
                             class="features_variant7_img"
                             alt="{{ $feature->title }}"
                             width="60"
                             height="60"
                             loading="lazy"
                             itemprop="image" />
                    @elseif($feature->icon)
                        <div class="features_variant7_icon" role="img" aria-label="{{ $feature->title }} ikonu">
                            <i class="{{ $feature->icon }}"></i>
                        </div>
                    @endif
                    <h3 class="features_variant7_card_title" itemprop="name">{{ $feature->title }}</h3>
                    <p class="features_variant7_card_description" itemprop="description">{{ $feature->description }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
