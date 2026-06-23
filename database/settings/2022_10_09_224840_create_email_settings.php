<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateEmailSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('email.username', 'AWAPanel');
        $this->migrator->add('email.password', 'AWAPanel');
        $this->migrator->add('email.host', 'AWAPanel@example.com');
        $this->migrator->add('email.port', '1025');
        $this->migrator->add('email.from_address', 'AWAPanel@example.com');
        $this->migrator->add('email.from_name', 'AWAPanel');
        $this->migrator->add('email.encryption', 'true');
    }
}
