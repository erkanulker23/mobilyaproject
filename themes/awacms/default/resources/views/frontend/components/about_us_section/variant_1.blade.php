<section class="about_variant1"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="about-title-1">

    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about_v1_image_wrapper">
                    @if($image)
                    <img src="{{ $image }}"
                         alt="{{ $title }}"
                         class="about_v1_image"
                         loading="lazy" />
                    @else
                    <div class="about_v1_placeholder">
                        <i class="fas fa-image"></i>
                        <p>Hakkımızda Görseli</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="about_v1_content">
                    <span class="about_v1_badge">Hakkımızda</span>
                    <h2 id="about-title-1" class="about_v1_title">{{ $title }}</h2>
                    <p class="about_v1_subtitle">{{ $subtitle }}</p>
                    <div class="about_v1_description">{!! $description !!}</div>

                    @if(!empty($list))
                    <ul class="about_v1_list">
                        @foreach($list as $item)
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>{{ $item['title'] }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                    @if($buttonText && $buttonLink)
                    <a href="{{ $buttonLink }}" class="about_v1_button" aria-label="{{ $buttonText }}">
                        {{ $buttonText }}
                        <i class="fas fa-arrow-right ms-2" aria-hidden="true"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
