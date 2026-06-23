<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;

    public ?string $header_logo = null;

    public ?string $address = null;

    public ?string $phone = null;

    public ?string $gsm = null;

    public ?string $email = null;

    public ?string $customer_service_phone = null;

    public ?string $whatsapp = null;

    public ?string $google_maps_url = null;

    public ?string $seo_title = null;

    public ?string $seo_description = null;

    public ?string $cookie_consent_banner_text = null;

    public ?string $footer_logo = null;

    public ?string $dark_footer_logo = null;

    public ?string $favicon = null;

    public ?string $apple_touch_icon = null;

    public ?string $dark_header_logo = null;

    public ?string $footer_copyright = null;

    public array $social_media_links = [];

    public ?string $working_hours = null;

    public ?string $analytics_property_id = null;

    public ?string $analytics_json_file_path = null;

    public ?int $cookie_consent_page = null;

    public bool $show_cookie_consent_banner = false;

    public ?array $header = null;

    public ?array $footer = null;

    // DEPRECATED
    public ?int $header_menu = null;

    public ?int $header_mobile_menu = null;

    public ?int $footer_menu = null;

    public ?int $footer_mobile_menu = null;

    public ?string $address_country = null;

    public ?string $address_locality = null;

    public ?string $address_region = null;

    public ?string $post_office_box_number = null;

    public ?string $postal_code = null;

    public ?string $street_address = null;

    public ?string $address_latitude = null;

    public ?string $address_longitude = null;

    public ?string $address_google_maps_url = null;

    public ?string $address_place_name = null;

    public ?string $address_google_maps_embed = null;

    public ?string $robots_txt = null;

    public ?string $google_font_family = null;

    public ?string $google_font_url = null;

    public ?string $google_places_api_key = null;

    public static function group(): string
    {
        return 'general';
    }
}
