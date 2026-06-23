@php
    $website = \Spatie\SchemaOrg\Schema::website()
            ->name($generalSettings->seo_title)
            ->description($generalSettings->seo_description)
            ->url(url('/'))
            ->image(url(\Illuminate\Support\Facades\Storage::url($generalSettings->header_logo)));
@endphp

{!! $website->toScript() !!}
