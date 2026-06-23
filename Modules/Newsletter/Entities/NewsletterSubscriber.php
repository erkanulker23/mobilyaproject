<?php

namespace Modules\Newsletter\Entities;

use Cog\Flag\Traits\Classic\HasActiveFlag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NewsletterSubscriber extends Model
{
    use HasActiveFlag;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'email',
        'token',
        'is_active',
    ];

    protected static function newFactory()
    {
        return \Modules\Newsletter\Database\factories\NewsletterSubscriberFactory::new();
    }
}
