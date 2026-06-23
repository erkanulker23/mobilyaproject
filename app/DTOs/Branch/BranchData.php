<?php

namespace App\DTOs\Branch;

use App\Models\Branch;

class BranchData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $phone,
        public ?string $fax,
        public ?string $whatsapp,
        public ?string $country,
        public ?string $city,
        public ?string $county,
        public ?string $address,
        public ?string $link,
        public ?string $email,
        public ?string $weekdaysOpening,
        public ?string $weekdaysClosing,
        public ?string $weekendOpening,
        public ?string $weekendClosing,
        public ?string $mapsIframe,
    ) {
        //
    }

    public static function fromModel(Branch $branch): self
    {
        return new self(
            id: $branch->id,
            name: $branch->name,
            phone: $branch->phone,
            fax: $branch->fax,
            whatsapp: $branch->whatsapp,
            country: $branch->country,
            city: $branch->city,
            county: $branch->county,
            address: $branch->address,
            link: $branch->link,
            email: $branch->email,
            weekdaysOpening: $branch->weekdays_opening,
            weekdaysClosing: $branch->weekdays_closing,
            weekendOpening: $branch->weekend_opening,
            weekendClosing: $branch->weekend_closing,
            mapsIframe: $branch->maps_iframe,
        );
    }
}
