@extends('layouts.app')

@section('content')
<div class="google-reviews-page">
    <div class="container">
        <div class="reviews-header">
            <h1>{{ __('Müşteri Yorumları') }}</h1>
            <p>{{ __('Değerli müşterilerimizin görüşleri') }}</p>
        </div>

        <div class="reviews-grid">
            @foreach($reviews as $review)
                <div class="review-card">
                    <div class="review-header">
                        @if($settings['show_avatar'] ?? true)
                            <img src="{{ $review->getAvatarUrl() }}" alt="{{ $review->display_name }}" class="review-avatar">
                        @endif
                        <div class="review-meta">
                            @if($settings['show_reviewer_name'] ?? true)
                                <h3 class="reviewer-name">{{ $review->display_name }}</h3>
                            @endif
                            @if($settings['show_date'] ?? true)
                                <span class="review-date">{{ $review->review_date->format('d.m.Y') }}</span>
                            @endif
                        </div>
                    </div>

                    @if($settings['show_rating'] ?? true)
                        <div class="review-rating">
                            {!! $review->getStarsHtml() !!}
                        </div>
                    @endif

                    <div class="review-content">
                        <p>{{ $review->review_text }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="reviews-pagination">
            {{ $reviews->links() }}
        </div>
    </div>
</div>
@endsection

