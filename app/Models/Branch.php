<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'fax',
        'whatsapp',
        'country',
        'city',
        'county',
        'address',
        'link',
        'email',
        'weekdays_opening',
        'weekdays_closing',
        'weekend_opening',
        'weekend_closing',
        'maps_iframe',
    ];
}
