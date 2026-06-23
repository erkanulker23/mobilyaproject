<section class="operation_variant2"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="operation-title-2">

    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <span class="operation_v2_badge">Süreç</span>
                <h2 id="operation-title-2" class="operation_v2_title">{{ $title }}</h2>
                <p class="operation_v2_subtitle">{{ $subtitle }}</p>
            </div>
        </div>

        <div class="operation_v2_steps">
            @foreach($operations as $operation)
            <div class="operation_v2_step">
                <div class="operation_v2_step_number">{{ $loop->iteration }}</div>

                @if($operation->image)
                <div class="operation_v2_image">
                    <img src="{{ $operation->image }}" alt="{{ $operation->title }}" loading="lazy" />
                </div>
                @elseif($operation->icon)
                <div class="operation_v2_icon">
                    <i class="{{ $operation->icon }}"></i>
                </div>
                @endif

                <h3 class="operation_v2_step_title">{{ $operation->title }}</h3>
                <p class="operation_v2_step_description">{{ $operation->description }}</p>
            </div>

            @if(!$loop->last)
            <div class="operation_v2_arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
