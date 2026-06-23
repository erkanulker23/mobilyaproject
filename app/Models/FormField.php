<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class FormField extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'form_id',
        'type',
        'name',
        'label',
        'placeholder',
        'help_text',
        'default_value',
        'required',
        'order',
        'width',
        'options',
        'validation_rules',
        'conditional_logic',
        'settings',
    ];

    public $translatable = [
        'label',
        'placeholder',
        'help_text',
        'options',
    ];

    protected $casts = [
        'required' => 'boolean',
        'options' => 'array',
        'validation_rules' => 'array',
        'conditional_logic' => 'array',
        'settings' => 'array',
    ];

    const FIELD_TYPES = [
        'text' => 'Tek Satır Metin',
        'textarea' => 'Çok Satır Metin',
        'email' => 'E-posta',
        'number' => 'Sayı',
        'phone' => 'Telefon',
        'url' => 'Web Adresi',
        'date' => 'Tarih',
        'time' => 'Saat',
        'datetime' => 'Tarih ve Saat',
        'select' => 'Açılır Liste',
        'radio' => 'Radyo Buton',
        'checkbox' => 'Çoklu Seçim (Checkbox)',
        'checkbox_single' => 'Tek Checkbox',
        'file' => 'Dosya Yükleme',
        'image' => 'Resim Yükleme',
        'rating' => 'Puan Verme',
        'scale' => 'Ölçek',
        'slider' => 'Kaydırıcı',
        'heading' => 'Başlık',
        'paragraph' => 'Paragraf',
        'divider' => 'Ayırıcı',
        'html' => 'HTML İçerik',
        'hidden' => 'Gizli Alan',
        'name' => 'Ad Soyad',
        'address' => 'Adres',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function getTypeNameAttribute(): string
    {
        return self::FIELD_TYPES[$this->type] ?? $this->type;
    }
}

