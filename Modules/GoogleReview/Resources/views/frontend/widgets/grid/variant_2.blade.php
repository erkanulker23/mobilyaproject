<div class="google-review-widget grid-layout variant-2" data-widget-id="{{ $widget->id }}">
    <div class="review-widget-container">
        @if($widget->name)
            <div class="widget-header text-center">
                <h2 class="widget-title classic">{{ $widget->name }}</h2>
                <div class="title-divider"></div>
            </div>
        @endif

        <div class="reviews-grid classic-grid" style="grid-template-columns: repeat({{ $settings['columns'] ?? 3 }}, 1fr);">
            @foreach($reviews as $review)
                <div class="review-card classic-card">
                    <div class="quote-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>

                    @if($settings['show_rating'])
                        <div class="review-rating centered">
                            {!! $review->getStarsHtml() !!}
                        </div>
                    @endif

                    <div class="review-content">
                        <p>{{ $review->review_text }}</p>
                    </div>

                    <div class="review-footer">
                        @if($settings['show_avatar'])
                            <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar small">
                        @endif
                        <div class="reviewer-info">
                            @if($settings['show_reviewer_name'])
                                <h4 class="reviewer-name">{{ $review->display_name }}</h4>
                            @endif
                            @if($settings['show_date'])
                                <span class="review-date">{{ $review->review_date->format('d.m.Y') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

