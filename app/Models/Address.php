<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'city_id',
        'county_id',
        'user_id',
        'is_company',
        'address_name',
        'name',
        'surname',
        'phone_code',
        'phone',
        'address',
        'tax_number',
        'tax_office',
        'company_name',
    ];

    protected $casts = [
        'is_company' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function county(): BelongsTo
    {
        return $this->belongsTo(County::class);
    }

    public function getIsCompanyTranslatedAttribute(): string
    {
        return $this->is_company ? 'Kurumsal' : 'Bireysel';
    }

    public function getAsTextAttribute(): string
    {
        return $this->address.' - '.$this->county->name.' / '.$this->city->name;
    }
}
