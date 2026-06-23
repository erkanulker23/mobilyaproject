<?php

namespace App\DTOs\Member;

use Illuminate\Support\Facades\Storage;
use Modules\Members\Entities\Member;

class MemberData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $fullName,
        public ?string $position,
        public ?string $photo,
        public $socialMediaLinks,
        public ?string $email,
        public ?string $phone,
    ) {
        //
    }

    public static function fromModel(Member $member): self
    {
        $socialMediaLinks = SocialMediaLinkData::collection($member->social_media_links);

        return new self(
            id: $member->id,
            firstName: $member->first_name,
            lastName: $member->last_name,
            fullName: $member->full_name,
            position: $member->position,
            photo: Storage::url($member->photo),
            socialMediaLinks: $socialMediaLinks,
            email: $member->email,
            phone: $member->phone,
        );
    }
}
