<article class="pricing_variant2_item"
         itemscope
         itemtype="https://schema.org/Offer">
    <div class="pricing_variant2_item_header">
        <h3 class="pricing_variant2_item_title" itemprop="name">{{ $plan->title }}</h3>

        <div class="pricing_variant2_item_price" itemprop="priceSpecification" itemscope itemtype="https://schema.org/PriceSpecification">
            <sup class="pricing_variant2_item_currency" itemprop="priceCurrency" content="{{ $plan->currency }}">{{ $plan->currency }}</sup>
            <span class="pricing_variant2_item_amount" itemprop="price" content="{{ $type == 'monthly' ? $plan->monthly_price : $plan->yearly_price }}">
                {{ Number::format($type == 'monthly' ? $plan->monthly_price : $plan->yearly_price, locale: 'tr') }}
            </span>
            <span class="pricing_variant2_item_period">{{ $type == 'monthly' ? '/ay' : '/yıl' }}</span>
        </div>

        @if($plan->subtitle)
        <p class="pricing_variant2_item_description" itemprop="description">{{ $plan->subtitle }}</p>
        @endif
    </div>

    <div class="pricing_variant2_item_body">
        <ul class="pricing_variant2_item_features" role="list">
            @foreach($plan->features as $feature)
            <li class="pricing_variant2_item_feature" role="listitem">
                <svg class="pricing_variant2_item_icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $feature->name }}</span>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="pricing_variant2_item_footer">
        <a href="{{ $plan->button_url ?? '#' }}"
           class="pricing_variant2_item_button"
           aria-label="{{ $plan->title }} planını seç"
           itemprop="url">
            {{ $plan->button_text ?? 'Planı Seç' }}
        </a>
    </div>
</article>
