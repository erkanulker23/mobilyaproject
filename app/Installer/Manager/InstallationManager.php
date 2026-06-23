<?php

namespace App\Installer\Manager;

use App\Models\User;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Shipu\WebInstaller\Concerns\InstallationContract;

class InstallationManager
{
    public function run($data): bool
    {
        try {
            Artisan::call('migrate:fresh', [
                '--force' => true,
            ]);

            $admin = User::create([
                'name'       => array_get($data, 'applications.admin.name'),
                'surname'       => array_get($data, 'applications.admin.surname'),
                'email'      => array_get($data, 'applications.admin.email'),
                'password'   => array_get($data, 'applications.admin.password'),
            ]);

            Artisan::call('db:seed', [
                '--force' => true,
            ]);

            $admin->assignRole('superadmin');

            file_put_contents(storage_path('installed'), 'installed');

            return true;
        } catch (\Exception $exception) {
            Notification::make()
                ->title('Installation Failed:'. $exception->getMessage())
                ->danger()
                ->send();

            return false;
        }
    }

    public function redirect()
    {
        if(! file_exists(storage_path('installed'))){
            return null;
        }

        try {
            if (class_exists(Filament::class)) {
                return redirect()->intended(Filament::getUrl());
            }

            return redirect(config('installer.redirect_route'));
        } catch (\Exception $exception) {
            Log::info("route not found...");
            Log::info($exception->getMessage());
            return redirect()->route('installer.success');
        }
    }

    public function dehydrate(): void
    {
        Log::info("installation dehydrate...");
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
    }
}
