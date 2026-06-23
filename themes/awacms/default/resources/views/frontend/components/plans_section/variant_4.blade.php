<section class="pricing_variant4" aria-labelledby="pricing-title-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-center mb-5" data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "easing": "easeOutQuad" }'>
                <h2 id="pricing-title-4" class="pricing_variant4_title">{{ $title ?? 'Fiyatlandırma Planları' }}</h2>
                <span class="pricing_variant4_subtitle">{{ $subtitle ?? 'Premium paketlerimizle işinizi bir üst seviyeye taşıyın' }}</span>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($plans as $plan)
            <div class="col">
                <article class="pricing_variant4_card {{ $loop->iteration === 2 ? 'popular' : '' }}"
                         itemscope
                         itemtype="https://schema.org/Offer">
                    <div class="pricing_variant4_header">
                        <span class="badge {{ $loop->iteration === 2 ? 'popular' : '' }}">{{ $plan->title }}</span>

                        <h3 itemprop="priceSpecification" itemscope itemtype="https://schema.org/PriceSpecification">
                            <sup itemprop="priceCurrency" content="{{ $plan->currency }}">{{ $plan->currency }}</sup><span itemprop="price" content="{{ $plan->monthly_price }}">{{ Number::format($plan->monthly_price, locale: 'tr') }}</span>
                        </h3>

                        @if($plan->subtitle)
                        <p itemprop="description">{{ $plan->subtitle }}</p>
                        @endif
                        <span>Aylık faturalandırma</span>
                    </div>
                    <div class="pricing_variant4_body">
                        <ul role="list">
                            @foreach($plan->features as $feature)
                            <li role="listitem">{{ $feature->name }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ $plan->button_url ?? '#' }}"
                           class="btn"
                           aria-label="{{ $plan->title }} planını seç"
                           itemprop="url">
                            {{ $plan->button_text ?? 'Planı Seç' }}
                        </a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>



