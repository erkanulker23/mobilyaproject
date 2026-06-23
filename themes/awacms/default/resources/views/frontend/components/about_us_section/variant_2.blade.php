<section class="about_variant2"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="about-title-2">
    
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about_v2_content">
                    <h2 id="about-title-2" class="about_v2_title">{{ $title }}</h2>
                    <p class="about_v2_subtitle">{{ $subtitle }}</p>
                    <div class="about_v2_description">{!! $description !!}</div>
                    
                    @if(!empty($list))
                    <div class="about_v2_features">
                        @foreach($list as $item)
                        <div class="about_v2_feature">
                            <div class="about_v2_feature_icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="about_v2_feature_text">
                                <h4>{{ $item['title'] }}</h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    
                    @if($buttonText && $buttonLink)
                    <div class="about_v2_actions">
                        <a href="{{ $buttonLink }}" class="about_v2_button">
                            {{ $buttonText }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="about_v2_image_wrapper">
                    @if($image)
                    <img src="{{ $image }}" 
                         alt="{{ $title }}" 
                         class="about_v2_image"
                         loading="lazy" />
                    @else
                    <div class="about_v2_placeholder">
                        <i class="fas fa-building"></i>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

