<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Settings\AdministratorSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //DefaultThemeSeeder::class,
            CitiesTableSeeder::class,
            CountiesTableSeeder::class,
            DefaultPageContentsSeeder::class,
        ]);

        $superadmin_role = Role::create(['name' => 'superadmin']);
        $user_role = Role::create(['name' => 'user']);
        $admin_role = Role::create(['name' => 'admin']);

        $can_access_admin_panel_perm = Permission::create(['name' => 'access admin panel']);
        $admin_role->givePermissionTo($can_access_admin_panel_perm);

        if (config('app.is_demo')) {
            $demoAdmin = User::factory()->create([
                'name' => 'Demo',
                'surname' => 'Admin',
                'email' => 'demo@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

            $demoAdmin->assignRole('admin');

            $administratorSettings = app(AdministratorSettings::class);

            $administratorSettings->theme = 'awacms/default';

            $administratorSettings->save();
        }
    }
}
