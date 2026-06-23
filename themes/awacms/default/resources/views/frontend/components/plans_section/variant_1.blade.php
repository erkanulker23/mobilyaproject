<section class="pricing_variant1"
         aria-labelledby="pricing-title-1"
         @if(isset($bgColor) || !empty($bgImage))
         style="@if(isset($bgColor))background-color: {{ $bgColor }};@endif @if(!empty($bgImage))background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center;@endif"
         @endif>
    <div class="container">
        <h2 id="pricing-title-1">{{ $title ?? 'Fiyatlandırma Planları' }}</h2>
        <p class="subtitle">{{ $subtitle ?? 'Size uygun planı seçin ve hemen başlayın' }}</p>

        <div class="pricing-toggle" role="group" aria-label="Fiyatlandırma dönem seçici">
            <span class="toggle-label" id="label-monthly">Aylık</span>
            <label class="switch">
                <input type="checkbox"
                       id="pricingToggle"
                       aria-labelledby="label-monthly label-yearly"
                       aria-checked="false">
                <span class="slider round"></span>
            </label>
            <span class="toggle-label" id="label-yearly">Yıllık <span style="background: #10b981; color: white; font-size: 11px; padding: 2px 8px; border-radius: 12px; margin-left: 5px;">20% İndirim</span></span>
        </div>

        <div class="pricing-plans" role="list">
            @foreach($plans as $plan)
                @include('frontend.components.plans_section.components.variant_1_item', [
                    'plan' => $plan,
                    'type' => 'yearly',
                    'loop' => $loop
                ])
            @endforeach
        </div>
    </div>
</section>

