<?php

namespace App\Filament\Pages;

use App\Filament\Support\SettingsPage;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageHomepage extends SettingsPage
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?int $navigationSort = 49;

    protected static ?string $title = 'Ana Sayfa Yönetimi';

    protected static ?string $navigationLabel = 'Ana Sayfa';

    protected function settingsGroup(): string
    {
        return 'home';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ana Sayfa Bölümleri')
                    ->description('Ana sayfada hangi bölümlerin görüneceğini belirleyin.')
                    ->schema([
                        $this->toggle('homeCatalog', 'Katalog / Kategoriler bölümü'),
                        $this->toggle('homeCollections', 'Koleksiyon vitrinleri'),
                        $this->toggle('homeNews', 'Haberler bölümü'),
                        $this->toggle('homeTestimonials', 'Müşteri yorumları bölümü'),
                    ]),
            ])
            ->statePath('data');
    }

    protected function toggle(string $key, string $label): Toggle
    {
        return Toggle::make($key)
            ->label($label)
            ->default(true)
            ->formatStateUsing(fn ($state) => $state === null ? true : $state !== '0')
            ->dehydrateStateUsing(fn ($state) => $state ? '1' : '0');
    }
}
