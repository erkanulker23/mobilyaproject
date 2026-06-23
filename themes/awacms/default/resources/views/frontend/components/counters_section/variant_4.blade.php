<section class="counter_variant4"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         role="region"
         aria-labelledby="counter-title-4">

    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <span class="counter_v4_badge">İstatistikler</span>
                <h2 id="counter-title-4" class="counter_v4_title">{{ $title }}</h2>
                <p class="counter_v4_subtitle">{{ $subtitle }}</p>
            </div>
        </div>

        <div class="row g-4">
            @php
                $gradients = [
                    'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                    'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
                    'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
                    'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
                ];
            @endphp

            @foreach($counters as $index => $counter)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter_v4_card" style="background: {{ $gradients[$loop->index % 4] }};">
                    @if($counter->image)
                    <div class="counter_v4_image">
                        <img src="{{ $counter->image }}"
                             alt="{{ $counter->title }}"
                             loading="lazy" />
                    </div>
                    @elseif($counter->icon)
                    <div class="counter_v4_icon">
                        <i class="{{ $counter->icon }}"></i>
                    </div>
                    @endif

                    <div class="counter_v4_number" data-target="{{ $counter->value }}">0</div>
                    <h3 class="counter_v4_label">{{ $counter->title }}</h3>

                    @if($counter->description)
                    <p class="counter_v4_description">{{ $counter->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
