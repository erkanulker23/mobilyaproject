<?php

namespace App\Traits;

use App\Settings\GeneralSettings;

trait Replaceable
{
    public function defaultBindings()
    {
        return [
            'domain' => request()->getHost(),
            'site_name' => app(GeneralSettings::class)->site_name,
        ];
    }

    public function modelBindings()
    {
        return [
            //
        ];
    }

    public function replaceBindings($string): string
    {
        $bindings = array_merge($this->defaultBindings(), $this->modelBindings());

        return preg_replace_callback('/\{(.*?)\}/', function ($matches) use ($bindings) {
            return $bindings[$matches[1]] ?? '';
        }, $string);
    }
}
