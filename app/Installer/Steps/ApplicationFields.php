<?php

namespace App\Installer\Steps;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Support\Facades\Hash;
use Shipu\WebInstaller\Concerns\StepContract;
use Shipu\WebInstaller\Forms\Fields\ApplicationFields as BaseApplicationFields;

class ApplicationFields extends BaseApplicationFields
{
    public static function make(): Step
    {
        return Step::make('application')
            ->label('Application Settings')
            ->schema(self::form());
    }
}
