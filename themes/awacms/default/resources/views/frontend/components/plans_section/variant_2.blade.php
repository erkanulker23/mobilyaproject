<section class="pricing_variant2" aria-labelledby="pricing-title-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-center mb-5" data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "easing": "easeOutQuad" }'>
                <h2 id="pricing-title-2" class="pricing_variant2_title">{{ $title ?? 'Fiyatlandırma Planları' }}</h2>
                <span class="pricing_variant2_subtitle">{{ $subtitle ?? 'Size uygun planı seçin ve hemen başlayın' }}</span>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($plans as $plan)
            <div class="col">
                <article class="pricing_variant2_card {{ $loop->iteration === 2 ? 'popular' : '' }}"
                         itemscope
                         itemtype="https://schema.org/Offer">
                    <div class="pricing_variant2_header">
                        <span class="badge {{ $loop->iteration === 2 ? 'popular' : '' }}">{{ $plan->title }}</span>

                        <h3 itemprop="priceSpecification" itemscope itemtype="https://schema.org/PriceSpecification">
                            <sup itemprop="priceCurrency" content="{{ $plan->currency }}">{{ $plan->currency }}</sup><span itemprop="price" content="{{ $plan->monthly_price }}">{{ Number::format($plan->monthly_price, locale: 'tr') }}</span>
                        </h3>

                        @if($plan->subtitle)
                        <p itemprop="description">{{ $plan->subtitle }}</p>
                        @endif

                        <a href="{{ $plan->button_url ?? '#' }}"
                           class="btn"
                           aria-label="{{ $plan->title }} planını seç"
                           itemprop="url">
                            {{ $plan->button_text ?? 'Planı Seç' }}
                        </a>

                        <span>Aylık faturalandırma</span>
                    </div>
                    <div class="pricing_variant2_body">
                        <ul role="list">
                            @foreach($plan->features as $feature)
                            <li role="listitem">{{ $feature->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
