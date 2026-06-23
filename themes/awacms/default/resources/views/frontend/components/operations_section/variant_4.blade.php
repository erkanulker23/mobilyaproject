<section class="operation_variant4"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="operation-title-4">

    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <span class="operation_v4_badge">Nasıl Çalışır?</span>
                <h2 id="operation-title-4" class="operation_v4_title">{{ $title }}</h2>
                <p class="operation_v4_subtitle">{{ $subtitle }}</p>
            </div>
        </div>

        <div class="row g-4">
            @php
                $colors = ['#3b82f6', '#10b981', '#f59e0b', '#ec4899'];
            @endphp

            @foreach($operations as $operation)
            <div class="col-lg-3 col-md-6">
                <div class="operation_v4_box" style="--operation-color: {{ $colors[$loop->index % 4] }};">
                    <div class="operation_v4_header" style="background: {{ $colors[$loop->index % 4] }};">
                        <div class="operation_v4_badge_number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>

                        @if($operation->image)
                        <div class="operation_v4_image">
                            <img src="{{ $operation->image }}" alt="{{ $operation->title }}" loading="lazy" />
                        </div>
                        @elseif($operation->icon)
                        <div class="operation_v4_icon">
                            <i class="{{ $operation->icon }}"></i>
                        </div>
                        @endif
                    </div>

                    <div class="operation_v4_body">
                        <h3 class="operation_v4_box_title">{{ $operation->title }}</h3>
                        <p class="operation_v4_box_description">{{ $operation->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
