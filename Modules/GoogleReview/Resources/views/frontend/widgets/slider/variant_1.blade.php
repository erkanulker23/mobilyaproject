<div class="google-review-widget slider-layout variant-1" data-widget-id="{{ $widget->id }}">
    <div class="review-widget-container">
        @if($widget->name)
            <div class="widget-header">
                <h2 class="widget-title">{{ $widget->name }}</h2>
            </div>
        @endif

        <div class="reviews-slider"
             data-autoplay="{{ $settings['autoplay'] ? 'true' : 'false' }}"
             data-autoplay-speed="{{ $settings['autoplay_speed'] ?? 3000 }}"
             data-show-navigation="{{ $settings['show_navigation'] ? 'true' : 'false' }}"
             data-show-pagination="{{ $settings['show_pagination'] ? 'true' : 'false' }}">

            <div class="slider-wrapper">
                @foreach($reviews as $review)
                    <div class="review-slide">
                        <div class="slide-inner">
                            @if($settings['show_rating'])
                                <div class="review-rating centered">
                                    {!! $review->getStarsHtml() !!}
                                </div>
                            @endif

                            <div class="review-content">
                                <p>{{ $review->review_text }}</p>
                            </div>

                            <div class="review-author">
                                @if($settings['show_avatar'])
                                    <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar">
                                @endif
                                <div class="author-info">
                                    @if($settings['show_reviewer_name'])
                                        <h4 class="reviewer-name">{{ $review->display_name }}</h4>
                                    @endif
                                    @if($settings['show_date'])
                                        <span class="review-date">{{ $review->review_date->format('d.m.Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($settings['show_navigation'])
                <button class="slider-nav prev" aria-label="Previous">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-nav next" aria-label="Next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            @endif

            @if($settings['show_pagination'])
                <div class="slider-pagination"></div>
            @endif
        </div>
    </div>
</div>

