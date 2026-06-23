<?php

namespace App\Filament\Pages;

use App\Settings\AdministratorSettings;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Pages\SettingsPage;
use Hexadog\ThemesManager\Facades\ThemesManager;
use Illuminate\Support\Str;

class ManageAdministrator extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = AdministratorSettings::class;

    protected static ?string $navigationLabel = 'Yönetici Ayarları';

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    protected function getFormSchema(): array
    {
        $themes = ThemesManager::all()->mapWithKeys(function ($theme, $key) {
            return [$key => (string) Str::title(last(explode('/', $key)))];
        });

        return [
            Checkbox::make('site_active'),
            Checkbox::make('frontend_active'),
            Select::make('theme')->required()->options($themes),
        ];
    }

    public function mount(): void
    {
        parent::mount();
        abort_unless(auth()->user()->hasRole('superadmin'), 403);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('superadmin');
    }
}
