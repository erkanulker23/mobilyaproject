<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Form extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'name',
        'title',
        'description',
        'slug',
        'is_active',
        'submit_button_text',
        'success_message',
        'redirect_url',
        'send_email_notification',
        'notification_email',
        'notification_subject',
        'save_submissions',
        'allow_multiple_submissions',
        'require_login',
        'custom_css',
        'custom_js',
        'settings',
    ];

    public $translatable = [
        'title',
        'description',
        'submit_button_text',
        'success_message',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'send_email_notification' => 'boolean',
        'save_submissions' => 'boolean',
        'allow_multiple_submissions' => 'boolean',
        'require_login' => 'boolean',
        'settings' => 'array',
    ];

    public function fields(): HasMany
    {
        return $this->hasMany(FormField::class)->orderBy('order');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function getEmbedCodeAttribute(): string
    {
        return '<div id="awacms-form-' . $this->id . '"></div><script src="' . url('/js/form-embed.js') . '" data-form-id="' . $this->id . '"></script>';
    }

    public function getIframeCodeAttribute(): string
    {
        return '<iframe src="' . route('forms.show', $this->slug) . '" width="100%" height="600" frameborder="0"></iframe>';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($form) {
            if (empty($form->slug)) {
                $form->slug = \Illuminate\Support\Str::slug($form->name);
            }
        });
    }
}

