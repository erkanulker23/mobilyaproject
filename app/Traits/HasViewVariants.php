<?php

namespace App\Traits;

trait HasViewVariants
{
    public function path()
    {
        throw new \Exception('You must define a folder method in your component');
    }

    public function variantViewPath()
    {
        $viewVariant = $this->data['view_variant'] ?? 'variant_1';

        $path = $this->path().'.'.$viewVariant;

        // check if the view exists
        if (view()->exists($path)) {
            return $path;
        }

        return $this->path().'.'.'variant_1';
    }
}
