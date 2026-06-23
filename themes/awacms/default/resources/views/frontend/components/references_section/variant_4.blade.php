<section class="references-variant4" aria-label="References Variant 4"
style="background-color: {{ isset($bgColor) ? $bgColor : '#fafafa' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\');background-size:cover;background-position:center' : '' }}">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-6 text-center">
                @if($subtitle)
                <span class="references-variant4-subtitle">{{ $subtitle }}</span>
                @endif
                <h2 class="references-variant4-title">{{ $title }}</h2>
            </div>
        </div>

        <div class="references-variant4-grid">
            @foreach($references as $reference)
            <div class="references-variant4-item">
                <img src="{{ $reference->logo }}" alt="{{ $reference->title }}" title="{{ $reference->title }}">
            </div>
            @endforeach
        </div>
    </div>
</section>

