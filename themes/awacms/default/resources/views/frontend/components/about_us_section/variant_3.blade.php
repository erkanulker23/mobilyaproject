<section class="about_variant3"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="about-title-3">

    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-5">
                @if($image)
                <div class="about_v3_image">
                    <img src="{{ $image }}" alt="{{ $title }}" loading="lazy" />
                </div>
                @endif
            </div>

            <div class="col-lg-7">
                <h2 id="about-title-3" class="about_v3_title">{{ $title }}</h2>
                <p class="about_v3_subtitle">{{ $subtitle }}</p>

                <div class="about_v3_description">{!! $description !!}</div>

                @if(!empty($list))
                <div class="about_v3_list">
                    @foreach($list as $item)
                    <div class="about_v3_item">
                        <i class="fas fa-check"></i>
                        <span>{{ $item['title'] }}</span>
                    </div>
                    @endforeach
                </div>
                @endif

                @if($buttonText && $buttonLink)
                <a href="{{ $buttonLink }}" class="about_v3_button">{{ $buttonText }}</a>
                @endif
            </div>
        </div>
    </div>
</section>
