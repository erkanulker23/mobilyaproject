<?php

namespace Modules\Tag\Entities;

use Spatie\Tags\Tag as TagsTag;

class Tag extends TagsTag
{
    public array $translatable = ['name', 'slug', 'description'];
}
