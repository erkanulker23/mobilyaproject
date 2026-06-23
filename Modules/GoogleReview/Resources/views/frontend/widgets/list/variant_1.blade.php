<div class="google-review-widget list-layout variant-1" data-widget-id="{{ $widget->id }}">
    <div class="review-widget-container">
        @if($widget->name)
            <div class="widget-header">
                <h2 class="widget-title">{{ $widget->name }}</h2>
            </div>
        @endif

        <div class="reviews-list">
            @foreach($reviews as $review)
                <div class="review-item">
                    <div class="review-item-inner">
                        <div class="review-left">
                            @if($settings['show_avatar'])
                                <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar large">
                            @endif
                        </div>

                        <div class="review-right">
                            <div class="review-header">
                                <div class="reviewer-info">
                                    @if($settings['show_reviewer_name'])
                                        <h3 class="reviewer-name">{{ $review->display_name }}</h3>
                                    @endif
                                    @if($settings['show_date'])
                                        <span class="review-date">{{ $review->review_date->format('d.m.Y') }}</span>
                                    @endif
                                </div>
                                @if($settings['show_rating'])
                                    <div class="review-rating">
                                        {!! $review->getStarsHtml() !!}
                                    </div>
                                @endif
                            </div>

                            <div class="review-content">
                                <p>{{ $review->review_text }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

