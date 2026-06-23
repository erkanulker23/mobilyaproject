<section class="counter_variant3"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         role="region"
         aria-labelledby="counter-title-3">

    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 id="counter-title-3" class="counter_v3_title">{{ $title }}</h2>
                <p class="counter_v3_subtitle">{{ $subtitle }}</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($counters as $counter)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter_v3_item">
                    <div class="counter_v3_icon_wrapper">
                        @if($counter->image)
                        <div class="counter_v3_image">
                            <img src="{{ $counter->image }}"
                                 alt="{{ $counter->title }}"
                                 loading="lazy" />
                        </div>
                        @elseif($counter->icon)
                        <div class="counter_v3_icon">
                            <i class="{{ $counter->icon }}"></i>
                        </div>
                        @endif
                    </div>

                    <div class="counter_v3_content">
                        <div class="counter_v3_number" data-target="{{ $counter->value }}">0</div>
                        <h3 class="counter_v3_label">{{ $counter->title }}</h3>

                        @if($counter->description)
                        <p class="counter_v3_description">{{ $counter->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
