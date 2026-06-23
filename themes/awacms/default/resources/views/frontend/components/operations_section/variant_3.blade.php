<section class="operation_variant3"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="operation-title-3">

    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 id="operation-title-3" class="operation_v3_title">{{ $title }}</h2>
                <p class="operation_v3_subtitle">{{ $subtitle }}</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($operations as $operation)
            <div class="col-lg-3 col-md-6">
                <div class="operation_v3_card">
                    <div class="operation_v3_circle">
                        <span class="operation_v3_number">{{ $loop->iteration }}</span>

                        @if($operation->image)
                        <div class="operation_v3_image">
                            <img src="{{ $operation->image }}" alt="{{ $operation->title }}" loading="lazy" />
                        </div>
                        @elseif($operation->icon)
                        <div class="operation_v3_icon">
                            <i class="{{ $operation->icon }}"></i>
                        </div>
                        @endif
                    </div>

                    <h3 class="operation_v3_card_title">{{ $operation->title }}</h3>
                    <p class="operation_v3_card_description">{{ $operation->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
