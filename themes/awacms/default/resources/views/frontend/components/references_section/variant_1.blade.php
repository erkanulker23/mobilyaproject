<section class="references-variant1-modern" aria-label="References Variant 1"
style="background-color: {{ isset($bgColor) ? $bgColor : '#f9fafb' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\');background-size:cover;background-position:center' : '' }}">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                @if($subtitle)
                <span class="references-variant1-modern-subtitle">{{ $subtitle }}</span>
                @endif
                <h2 class="references-variant1-modern-title">{{ $title }}</h2>
            </div>
        </div>

        <div class="references-variant1-modern-grid">
            @foreach($references as $reference)
            <div class="references-variant1-modern-card">
                <div class="references-variant1-modern-card-inner">
                    <img src="{{ $reference->logo }}" alt="{{ $reference->title }}" title="{{ $reference->title }}" loading="lazy">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

