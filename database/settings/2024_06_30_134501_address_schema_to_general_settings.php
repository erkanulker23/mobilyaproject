<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.address_country', '');
        $this->migrator->add('general.address_locality', '');
        $this->migrator->add('general.address_region', '');
        $this->migrator->add('general.post_office_box_number', '');
        $this->migrator->add('general.postal_code', '');
        $this->migrator->add('general.street_address', '');
        $this->migrator->add('general.address_latitude', '');
        $this->migrator->add('general.address_longitude', '');
    }
};
