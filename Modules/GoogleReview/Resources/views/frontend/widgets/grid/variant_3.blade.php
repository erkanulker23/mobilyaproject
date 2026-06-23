<div class="google-review-widget grid-layout variant-3" data-widget-id="{{ $widget->id }}">
    <div class="review-widget-container">
        @if($widget->name)
            <div class="widget-header minimal">
                <h2 class="widget-title">{{ $widget->name }}</h2>
            </div>
        @endif

        <div class="reviews-grid minimal-grid" style="grid-template-columns: repeat({{ $settings['columns'] ?? 3 }}, 1fr);">
            @foreach($reviews as $review)
                <div class="review-card minimal-card">
                    @if($settings['show_rating'])
                        <div class="review-rating">
                            {!! $review->getStarsHtml() !!}
                        </div>
                    @endif

                    <div class="review-content minimal">
                        <p>{{ $review->review_text }}</p>
                    </div>

                    <div class="review-author">
                        @if($settings['show_avatar'])
                            <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar tiny">
                        @endif
                        @if($settings['show_reviewer_name'])
                            <span class="reviewer-name">{{ $review->display_name }}</span>
                        @endif
                        @if($settings['show_date'])
                            <span class="separator">•</span>
                            <span class="review-date">{{ $review->review_date->format('d.m.Y') }}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

