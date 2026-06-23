<?php

return [
    'name' => 'GoogleReview',
    
    // Google Places API Key (from settings)
    'google_api_key' => function() {
        try {
            return app(\App\Settings\GoogleReviewSettings::class)->google_places_api_key ?? '';
        } catch (\Exception $e) {
            return '';
        }
    },
    
    // Connected place ID
    'connected_place_id' => env('GOOGLE_PLACE_ID', ''),
    
    // Auto sync settings
    'auto_sync' => [
        'enabled' => env('GOOGLE_REVIEW_AUTO_SYNC', false),
        'frequency' => 'daily', // hourly, daily, weekly
    ],
    
    // Default widget settings
    'default_widget_settings' => [
        'reviews_per_page' => 10,
        'show_rating' => true,
        'show_date' => true,
        'show_avatar' => true,
        'show_reviewer_name' => true,
        'min_rating' => 1, // Minimum rating to display
        'layout' => 'grid', // grid, list, slider, masonry
    ],
    
    // Cache settings
    'cache' => [
        'enabled' => true,
        'ttl' => 3600, // Cache duration in seconds (1 hour)
    ],
];

