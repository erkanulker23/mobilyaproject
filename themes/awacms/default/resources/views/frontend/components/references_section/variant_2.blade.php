<section class="references-variant2" aria-label="References Variant 2"
style="background-color: {{ isset($bgColor) ? $bgColor : '#f8f9fa' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\');background-size:cover;background-position:center' : '' }}">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                @if($subtitle)
                <span class="references-variant2-subtitle">{{ $subtitle }}</span>
                @endif
                <h2 class="references-variant2-title">{{ $title }}</h2>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($references as $reference)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="references-variant2-item">
                    <img src="{{ $reference->logo }}" alt="{{ $reference->title }}" title="{{ $reference->title }}">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
