<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateThirdPartySettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->addEncrypted('third_party.openai_api_key', '');
    }
}
