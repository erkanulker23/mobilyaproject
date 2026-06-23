<?php

namespace App\DTOs\Member;

class SocialMediaLinkData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public ?string $icon,
        public ?string $customIcon,
        public ?string $link,
        public ?string $type,
        public ?string $display_name,
    ) {
        //
    }

    public static function fromArray($link): self
    {
        $link = collect($link);

        return new self(
            icon: $link->get('icon'),
            customIcon: $link->get('custom_icon'),
            link: $link->get('link'),
            type: $link->get('type'),
            display_name: $link->get('display_name'),
        );
    }
}
