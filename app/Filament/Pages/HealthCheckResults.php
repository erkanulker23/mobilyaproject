<?php

namespace App\Filament\Pages;

use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults as BaseHealthCheckResults;

class HealthCheckResults extends BaseHealthCheckResults
{
    public function mount(): void
    {
        abort_unless(auth()->user()->hasRole('superadmin'), 403);
    }
}
