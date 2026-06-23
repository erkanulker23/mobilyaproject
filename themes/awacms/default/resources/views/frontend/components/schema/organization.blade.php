@php
    $localBusiness = \Spatie\SchemaOrg\Schema::localBusiness()
            ->name($generalSettings->seo_title)
            ->description($generalSettings->seo_description)
            ->email($generalSettings->email)
            ->telephone($generalSettings->phone)
            ->address(\Spatie\SchemaOrg\Schema::postalAddress()
                ->streetAddress($generalSettings->street_address)
                ->addressLocality($generalSettings->address_locality)
                ->addressCountry($generalSettings->address_country)
                ->addressRegion($generalSettings->address_region)
                ->postalCode($generalSettings->postal_code)
                ->postOfficeBoxNumber($generalSettings->post_office_box_number)
            )
            ->image(url(\Illuminate\Support\Facades\Storage::url($generalSettings->header_logo)))
            ->url(url('/'))
            ->logo(url(\Illuminate\Support\Facades\Storage::url($generalSettings->header_logo)))
            ->contactPoint(\Spatie\SchemaOrg\Schema::contactPoint()
                ->contactType('customer service')
                ->telephone($generalSettings->phone)
                ->areaServed($generalSettings->address_country)
                ->availableLanguage('Turkish')
            );

            foreach (\App\DTOs\Member\SocialMediaLinkData::collection($generalSettings->social_media_links) as $socialLink) {
                $localBusiness->sameAs($socialLink->link);
            }
@endphp

{!! $localBusiness->toScript() !!}
