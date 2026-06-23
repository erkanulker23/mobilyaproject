<div class="google-review-widget grid-layout variant-1" data-widget-id="{{ $widget->id }}">
    <div class="review-widget-container">
        @if($widget->name)
            <div class="widget-header">
                <h2 class="widget-title">{{ $widget->name }}</h2>
            </div>
        @endif

        <div class="reviews-grid" style="grid-template-columns: repeat({{ $settings['columns'] ?? 3 }}, 1fr);">
            @foreach($reviews as $review)
                <div class="review-card modern-card">
                    <div class="card-inner">
                        <div class="review-header">
                            @if($settings['show_avatar'])
                                <div class="avatar-wrapper">
                                    <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar">
                                </div>
                            @endif
                            <div class="reviewer-info">
                                @if($settings['show_reviewer_name'])
                                    <h3 class="reviewer-name">{{ $review->display_name }}</h3>
                                @endif
                                @if($settings['show_date'])
                                    <span class="review-date">{{ $review->review_date->format('d.m.Y') }}</span>
                                @endif
                            </div>
                        </div>

                        @if($settings['show_rating'])
                            <div class="review-rating">
                                {!! $review->getStarsHtml() !!}
                            </div>
                        @endif

                        <div class="review-content">
                            <p>{{ $review->review_text }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

