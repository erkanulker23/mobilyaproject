<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // GeneralSettings için tüm propertyleri ekle
        $generalSettings = [
            'site_name' => 'Test Site',
            'header_logo' => null,
            'address' => null,
            'phone' => null,
            'gsm' => null,
            'email' => null,
            'customer_service_phone' => null,
            'whatsapp' => null,
            'google_maps_url' => null,
            'seo_title' => null,
            'seo_description' => null,
            'cookie_consent_banner_text' => null,
            'footer_logo' => null,
            'dark_footer_logo' => null,
            'favicon' => null,
            'dark_header_logo' => null,
            'footer_copyright' => null,
            'social_media_links' => [],
            'working_hours' => null,
            'analytics_property_id' => null,
            'analytics_json_file_path' => null,
            'cookie_consent_page' => null,
            'show_cookie_consent_banner' => false,
            'header' => null,
            'footer' => null,
            'header_menu' => null,
            'header_mobile_menu' => null,
            'footer_menu' => null,
            'footer_mobile_menu' => null,
            'address_country' => null,
            'address_locality' => null,
            'address_region' => null,
            'post_office_box_number' => null,
            'postal_code' => null,
            'street_address' => null,
            'address_latitude' => null,
            'address_longitude' => null,
            'address_google_maps_url' => null,
            'address_place_name' => null,
            'address_google_maps_embed' => null,
            'robots_txt' => null,
            'google_font_family' => null,
            'google_font_url' => null,
            'google_places_api_key' => '',
        ];

        foreach ($generalSettings as $name => $value) {
            DB::table('settings')->updateOrInsert(
                ['group' => 'general', 'name' => $name],
                [
                    'locked' => false,
                    'payload' => json_encode($value),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }

        // ImageSettings için eksik propertyleri ekle
        $imageSettings = [
            'blog_details_image_mobile' => null,
            'blog_details_hero_mobile' => null,
            'blog_listing_image_mobile' => null,
            'service_details_image_mobile' => null,
            'service_details_hero_mobile' => null,
            'service_listing_image_mobile' => null,
        ];

        foreach ($imageSettings as $name => $value) {
            DB::table('settings')->updateOrInsert(
                ['group' => 'image', 'name' => $name],
                [
                    'locked' => false,
                    'payload' => json_encode($value),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Migration geri alındığında settings'leri silme
        DB::table('settings')->where('group', 'general')->delete();
        DB::table('settings')->where('group', 'image')->delete();
    }
};
