<section class="counter_variant2"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         role="region"
         aria-labelledby="counter-title-2">

    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 id="counter-title-2" class="counter_v2_title">{{ $title }}</h2>
                <p class="counter_v2_subtitle">{{ $subtitle }}</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($counters as $counter)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter_v2_card">
                    @if($counter->image)
                    <div class="counter_v2_image">
                        <img src="{{ $counter->image }}"
                             alt="{{ $counter->title }}"
                             loading="lazy" />
                    </div>
                    @elseif($counter->icon)
                    <div class="counter_v2_icon_overlay">
                        <i class="{{ $counter->icon }}"></i>
                    </div>
                    @endif

                    <div class="counter_v2_content">
                        <div class="counter_v2_number" data-target="{{ $counter->value }}">0</div>
                        <h3 class="counter_v2_label">{{ $counter->title }}</h3>

                        @if($counter->description)
                        <p class="counter_v2_description">{{ $counter->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
