<?php

namespace Modules\Group\Entities;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Spatie\EloquentSortable\SortableTrait;

class Groupable extends MorphPivot
{
    use SortableTrait;

    protected $fillable = [
        'order_column',
    ];

    public function groupable()
    {
        return $this->morphTo();
    }
}
