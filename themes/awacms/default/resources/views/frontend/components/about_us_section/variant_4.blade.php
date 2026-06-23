<section class="about_variant4"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="about-title-4">
    
    <div class="about_v4_split">
        <div class="about_v4_left">
            @if($image)
            <div class="about_v4_image" style="background-image: url('{{ $image }}');"></div>
            @else
            <div class="about_v4_image about_v4_placeholder">
                <i class="fas fa-users"></i>
            </div>
            @endif
        </div>
        
        <div class="about_v4_right">
            <div class="about_v4_content">
                <span class="about_v4_label">Biz Kimiz?</span>
                <h2 id="about-title-4" class="about_v4_title">{{ $title }}</h2>
                <p class="about_v4_subtitle">{{ $subtitle }}</p>
                <div class="about_v4_description">{!! $description !!}</div>
                
                @if(!empty($list))
                <div class="about_v4_list">
                    @foreach($list as $item)
                    <div class="about_v4_list_item">
                        <div class="about_v4_list_number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="about_v4_list_text">{{ $item['title'] }}</div>
                    </div>
                    @endforeach
                </div>
                @endif
                
                @if($buttonText && $buttonLink)
                <a href="{{ $buttonLink }}" class="about_v4_button">
                    {{ $buttonText }}
                    <i class="fas fa-arrow-right"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</section>

