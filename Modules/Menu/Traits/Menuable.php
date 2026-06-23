<?php

namespace Modules\Menu\Traits;

trait Menuable
{
    public function getMenuLinkAttribute(): string
    {
        return '#';
    }
}
