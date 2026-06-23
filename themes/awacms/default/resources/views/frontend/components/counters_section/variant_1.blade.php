<section class="counter_variant1"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         role="region"
         aria-labelledby="counter-title-1">

    <div class="container">
        <div class="counter_v1_header text-center">
            <h2 id="counter-title-1" class="counter_v1_title">{{ $title }}</h2>
            <p class="counter_v1_subtitle">{{ $subtitle }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($counters as $counter)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter_v1_box">
                    @if($counter->image)
                    <div class="counter_v1_image">
                        <img src="{{ $counter->image }}"
                             alt="{{ $counter->title }}"
                             loading="lazy" />
                    </div>
                    @elseif($counter->icon)
                    <div class="counter_v1_icon">
                        <i class="{{ $counter->icon }}"></i>
                    </div>
                    @endif

                    <div class="counter_v1_number" data-target="{{ $counter->value }}">0</div>
                    <h3 class="counter_v1_label">{{ $counter->title }}</h3>

                    @if($counter->description)
                    <p class="counter_v1_description">{{ $counter->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
