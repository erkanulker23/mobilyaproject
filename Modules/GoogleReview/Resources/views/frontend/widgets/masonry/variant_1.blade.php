<div class="google-review-widget masonry-layout variant-1" data-widget-id="{{ $widget->id }}">
    <div class="review-widget-container">
        @if($widget->name)
            <div class="widget-header">
                <h2 class="widget-title">{{ $widget->name }}</h2>
            </div>
        @endif

        <div class="reviews-masonry" data-columns="{{ $settings['columns'] ?? 3 }}">
            @foreach($reviews as $review)
                <div class="masonry-item">
                    <div class="review-card masonry-card">
                        @if($settings['show_avatar'])
                            <div class="review-avatar-wrapper">
                                <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar">
                            </div>
                        @endif

                        @if($settings['show_rating'])
                            <div class="review-rating">
                                {!! $review->getStarsHtml() !!}
                            </div>
                        @endif

                        <div class="review-content">
                            <p>{{ $review->review_text }}</p>
                        </div>

                        <div class="review-meta">
                            @if($settings['show_reviewer_name'])
                                <span class="reviewer-name">{{ $review->display_name }}</span>
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

