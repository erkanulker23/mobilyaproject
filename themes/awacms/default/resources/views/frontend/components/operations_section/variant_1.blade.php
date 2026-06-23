<section class="operation_variant1"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="operation-title-1">

    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 id="operation-title-1" class="operation_v1_title">{{ $title }}</h2>
                <p class="operation_v1_subtitle">{{ $subtitle }}</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="operation_v1_timeline">
                    @foreach($operations as $index => $operation)
                    <div class="operation_v1_item {{ $loop->iteration % 2 == 0 ? 'right' : 'left' }}">
                        <div class="operation_v1_number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>

                        <div class="operation_v1_content">
                            @if($operation->image)
                            <div class="operation_v1_image">
                                <img src="{{ $operation->image }}" alt="{{ $operation->title }}" loading="lazy" />
                            </div>
                            @elseif($operation->icon)
                            <div class="operation_v1_icon">
                                <i class="fa-solid {{ str_replace('fas ', '', $operation->icon) }}"></i>
                            </div>
                            @endif

                            <h3 class="operation_v1_item_title">{{ $operation->title }}</h3>
                            <p class="operation_v1_description">{{ $operation->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
