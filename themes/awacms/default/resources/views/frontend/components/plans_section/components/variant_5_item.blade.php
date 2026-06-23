<article class="pricing_variant5_item"
         itemscope
         itemtype="https://schema.org/Offer"
         data-aos="fade-up"
         data-aos-duration="600">
    <div class="pricing_variant5_item_header">
        <h3 class="pricing_variant5_item_title" itemprop="name">{{ $plan->title }}</h3>

        @if($plan->subtitle)
        <p class="pricing_variant5_item_description" itemprop="description">{{ $plan->subtitle }}</p>
        @endif

        <div class="pricing_variant5_item_price" itemprop="priceSpecification" itemscope itemtype="https://schema.org/PriceSpecification">
            <span class="pricing_variant5_item_amount" itemprop="price" content="{{ $type == 'monthly' ? $plan->monthly_price : $plan->yearly_price }}">
                {{ Number::format($type == 'monthly' ? $plan->monthly_price : $plan->yearly_price, locale: 'tr') }}
            </span>
            <span class="pricing_variant5_item_currency" itemprop="priceCurrency" content="{{ $plan->currency }}">{{ $plan->currency }}</span>
            <span class="pricing_variant5_item_period">{{ $type == 'monthly' ? '/Aylık' : '/Yıllık' }}</span>
        </div>
    </div>

    <div class="pricing_variant5_item_body">
        <ul class="pricing_variant5_item_features" role="list">
            @foreach($plan->features as $feature)
            <li class="pricing_variant5_item_feature" role="listitem">
                <svg class="pricing_variant5_item_icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $feature->name }}</span>
            </li>
            @endforeach
        </ul>

        <div class="pricing_variant5_item_footer">
            <a href="{{ $plan->button_url ?? '#' }}"
               class="pricing_variant5_item_button"
               aria-label="{{ $plan->title }} planını seç"
               itemprop="url">
                {{ $plan->button_text ?? 'Planı Seç' }}
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </a>
        </div>
    </div>
</article>
