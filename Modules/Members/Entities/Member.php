<?php

namespace Modules\Members\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'position',
        'email',
        'phone',
        'photo',
        'social_media_links',
    ];

    protected $casts = [
        'social_media_links' => 'array',
    ];

    protected static function newFactory()
    {
        return \Modules\Members\Database\factories\MemberFactory::new();
    }
}
