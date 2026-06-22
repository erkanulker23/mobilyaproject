<?php

namespace App\Filament\Support;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;

/**
 * settings tablosunu (group/key/value) yöneten ayar sayfaları için taban sınıf.
 * Bu sınıf app/Filament/Pages dışında olduğundan panele otomatik kaydedilmez.
 */
abstract class SettingsPage extends Page
{
    protected static string | \UnitEnum | null $navigationGroup = 'Ayarlar';

    /** @var array<string, mixed> */
    public ?array $data = [];

    abstract protected function settingsGroup(): string;

    public function mount(): void
    {
        $this->form->fill(Setting::pluck('value', 'key')->toArray());
    }

    public function save(): void
    {
        foreach ($this->form->getState() as $key => $value) {
            if (is_bool($value)) {
                $value = $value ? '1' : '0';
            } elseif (is_array($value)) {
                $value = json_encode($value);
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['group' => $this->settingsGroup(), 'value' => $value],
            );
        }

        Notification::make()->title('Ayarlar kaydedildi.')->success()->send();
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form')
                ->livewireSubmitHandler('save')
                ->footer([
                    Actions::make([
                        Action::make('save')
                            ->label('Kaydet')
                            ->submit('save')
                            ->keyBindings(['mod+s']),
                    ]),
                ]),
        ]);
    }
}
