<article class="pricing-card {{ $loop->iteration === 2 ? 'highlighted' : '' }}"
         role="listitem"
         itemscope
         itemtype="https://schema.org/Offer">
    @if($loop->iteration === 2)
    <span class="badge">En Popüler</span>
    @endif

    <h3 itemprop="name">{{ $plan->title }}</h3>

    <div class="price monthly {{ $type === 'monthly' ? '' : 'hidden' }}" itemprop="priceSpecification" itemscope itemtype="https://schema.org/PriceSpecification">
        <span itemprop="priceCurrency" content="{{ $plan->currency }}">{{ $plan->currency }}</span>
        <span itemprop="price" content="{{ $plan->monthly_price }}">{{ Number::format($plan->monthly_price, locale: 'tr') }}</span>
        <span>/ay</span>
    </div>
    <div class="price yearly {{ $type === 'yearly' ? '' : 'hidden' }}" itemprop="priceSpecification" itemscope itemtype="https://schema.org/PriceSpecification">
        <span itemprop="priceCurrency" content="{{ $plan->currency }}">{{ $plan->currency }}</span>
        <span itemprop="price" content="{{ $plan->yearly_price }}">{{ Number::format($plan->yearly_price, locale: 'tr') }}</span>
        <span>/yıl</span>
    </div>

    <ul class="features" role="list">
        @foreach($plan->features as $feature)
        <li role="listitem">{{ $feature->name }}</li>
        @endforeach
    </ul>

    <button class="plan-button"
            onclick="window.location.href='{{ $plan->button_url ?? '#' }}'"
            aria-label="{{ $plan->title }} planını seç">
        {{ $plan->button_text ?? 'Planı Seç' }}
    </button>
</article>
