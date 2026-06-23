<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Features\Entities\Feature;

class UpdateFeaturesWithIcons extends Command
{
    protected $signature = 'features:update-icons';
    protected $description = 'Features\'a icon ekle (bazılarına icon, bazılarına resim için)';

    public function handle()
    {
        $this->info('Features güncelleniyor...');

        $features = Feature::all();

        foreach ($features as $index => $feature) {
            // Her ikinci feature'a icon ekle (diğerleri resim kullansın)
            if ($index % 2 == 0) {
                // Icon ekle
                $icons = [
                    'fas fa-shield-alt',
                    'fas fa-truck',
                    'fas fa-clock',
                    'fas fa-users',
                    'fas fa-phone-alt',
                    'fas fa-check-circle',
                ];

                $feature->icon = $icons[$index % count($icons)];
                $feature->save();

                $this->info("✓ {$feature->title} - Icon eklendi: {$feature->icon}");
            } else {
                // Resim kullanacak (zaten var)
                $this->info("✓ {$feature->title} - Resim kullanıyor");
            }
        }

        $this->info('');
        $this->info('🎉 Tamamlandı! Features güncel.');
        $this->info('Bazı features icon, bazıları resim kullanıyor.');

        return 0;
    }
}

