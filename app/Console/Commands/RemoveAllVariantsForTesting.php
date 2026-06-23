<?php

namespace App\Console\Commands;

use App\Settings\GeneralSettings;
use App\Settings\HomepageSettings;
use Illuminate\Console\Command;
use Modules\Menu\Entities\Menu;
use Modules\Slide\Entities\Slider;

class RemoveAllVariantsForTesting extends Command
{
    protected $signature = 'homepage:remove-all-variants';
    protected $description = 'Test için eklenen tüm varyantları temizle';

    public function handle()
    {
        if (!$this->confirm('Tüm anasayfa içeriği silinecek. Emin misiniz?')) {
            $this->info('İşlem iptal edildi.');
            return 0;
        }

        $this->info('Tüm varyantlar siliniyor...');

        $menu = Menu::first();
        $slider = Slider::first();

        // Minimal content oluştur
        $content = [];

        if ($slider) {
            $content[] = [
                'type' => 'hero_slider',
                'data' => [
                    'slider_id' => $slider->id,
                    'view_variant' => 'variant_1',
                    'wrapper_class' => '',
                ],
            ];
        }

        // Homepage Settings'i kaydet
        $homepage_settings = new HomepageSettings();
        $homepage_settings->content = $content;
        $homepage_settings->save();

        $this->info('✓ Anasayfa içeriği temizlendi');

        // Footer - sadece 1 varyant bırak
        $footer = [];
        if ($menu) {
            $footer[] = [
                'type' => 'footer_section',
                'data' => [
                    'menu_id' => $menu->id,
                    'view_variant' => 'variant_1',
                    'phone' => '',
                    'address' => '',
                    'wrapper_class' => '',
                    'bg_color' => null,
                    'link_color' => null,
                    'title_color' => null,
                    'widget_color' => null,
                    'logo_description' => '',
                    'bg_image' => null,
                ],
            ];
        }

        // Header - 1 varyant bırak
        $header = [];
        if ($menu) {
            $header[] = [
                'type' => 'header_section',
                'data' => [
                    'menu_id' => $menu->id,
                    'is_transparent' => false,
                    'view_variant' => 'variant_1',
                    'phone' => '',
                    'button_text' => '',
                    'button_link' => '',
                    'width' => 'container',
                    'wrapper_class' => '',
                    'bg_color' => null,
                    'is_topbar_active' => false,
                    'topbar_view_variant' => 'variant_1',
                    'show_address' => true,
                    'show_phone' => true,
                    'show_social' => true,
                    'topbar_text' => '',
                ],
            ];
        }

        // General Settings'e kaydet
        $general_settings = new GeneralSettings();
        $general_settings->header = $header;
        $general_settings->footer = $footer;
        $general_settings->save();

        $this->info('✓ Header temizlendi');
        $this->info('✓ Footer temizlendi');

        $this->info('');
        $this->info('🎉 TAMAMLANDI! Tüm varyantlar temizlendi.');
        $this->info('Anasayfa minimal hale getirildi.');

        return 0;
    }
}

