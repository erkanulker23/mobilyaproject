<?php

namespace App\Console\Commands;

use App\Models\BlogCategory;
use App\Settings\GeneralSettings;
use App\Settings\HomepageSettings;
use Illuminate\Console\Command;
use Modules\Faq\Entities\Faq;
use Modules\Features\Entities\FeatureCategory;
use Modules\Menu\Entities\Menu;
use Modules\Slide\Entities\Slider;

class AddAllVariantsForTesting extends Command
{
    protected $signature = 'homepage:add-all-variants';
    protected $description = 'Lighthouse testi için tüm component varyantlarını ekle';

    public function handle()
    {
        $this->info('Tüm varyantlar ekleniyor...');

        // İlk gerekli verileri al
        $menu = Menu::first();
        $slider = Slider::first();
        $faq = Faq::first();
        $featureCategory = FeatureCategory::first();
        $blogCategory = BlogCategory::first();
        $serviceCategory = \App\Models\ServiceCategory::first();

        if (!$menu || !$slider) {
            $this->error('Lütfen önce en az bir Menu ve Slider oluşturun!');
            return 1;
        }

        $content = [];

        // 1. HERO SLIDER (1 varyant)
        $content[] = [
            'type' => 'hero_slider',
            'data' => [
                'slider_id' => $slider?->id,
                'view_variant' => 'variant_1',
                'wrapper_class' => '',
            ],
        ];

        // 2. FEATURES SECTION (9 varyant)
        for ($i = 1; $i <= 9; $i++) {
            $content[] = [
                'type' => 'features_section',
                'data' => [
                    'section_title' => "Özellikler (Varyant $i)",
                    'section_subtitle' => "Features section variant $i",
                    'view_variant' => "variant_$i",
                    'category_ids' => $featureCategory ? [$featureCategory->id] : [],
                    'limit' => 6,
                    'bg_color' => null,
                    'bg_image' => null,
                ],
            ];
        }

        // 3. REQUEST FORM SECTION (7 varyant)
        for ($i = 1; $i <= 7; $i++) {
            $content[] = [
                'type' => 'request_form_section',
                'data' => [
                    'section_title' => "Talep Formu (Varyant $i)",
                    'section_subtitle' => "Request form variant $i",
                    'view_variant' => "variant_$i",
                    'phone' => '0555 555 55 55',
                    'email' => 'info@example.com',
                    'button_text' => 'Gönder',
                    'topic_options' => [
                        ['title' => 'Genel Bilgi'],
                        ['title' => 'Fiyat Teklifi'],
                        ['title' => 'Teknik Destek'],
                    ],
                    'bg_color' => null,
                    'bg_image' => null,
                ],
            ];
        }

        // 4. ABOUT US SECTION (4 varyant)
        for ($i = 1; $i <= 4; $i++) {
            $content[] = [
                'type' => 'about_us_section',
                'data' => [
                    'section_title' => "Hakkımızda (Varyant $i)",
                    'section_subtitle' => "About us variant $i",
                    'section_description' => '<p>Biz, müşterilerimize en kaliteli hizmeti sunmayı amaçlayan, deneyimli ve profesyonel bir ekibiz.</p>',
                    'view_variant' => "variant_$i",
                    'button_text' => 'Daha Fazla',
                    'button_link' => '#',
                    'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=600&fit=crop',
                    'list' => [
                        ['title' => 'Profesyonel Ekip'],
                        ['title' => 'Kaliteli Hizmet'],
                        ['title' => '7/24 Destek'],
                    ],
                    'bg_color' => null,
                    'bg_image' => null,
                ],
            ];
        }

        // 5. TESTIMONIALS (11 varyant)
        for ($i = 1; $i <= 11; $i++) {
            $content[] = [
                'type' => 'testimonials_list',
                'data' => [
                    'section_title' => "Müşteri Yorumları (Varyant $i)",
                    'section_subtitle' => "Testimonials variant $i",
                    'view_variant' => "variant_$i",
                    'limit' => 6,
                    'bg_color' => null,
                    'bg_image' => null,
                ],
            ];
        }

        // 6. GOOGLE REVIEWS (6 varyant)
        for ($i = 1; $i <= 6; $i++) {
            $content[] = [
                'type' => 'google_reviews_section',
                'data' => [
                    'section_title' => "Google Yorumları (Varyant $i)",
                    'section_subtitle' => "Google reviews variant $i",
                    'view_variant' => "variant_$i",
                    'business_id' => null,
                    'limit' => 10,
                    'min_rating' => 4,
                    'bg_color' => null,
                    'bg_image' => null,
                ],
            ];
        }

        // 7. BLOG POST SLIDER (5 varyant)
        for ($i = 1; $i <= 5; $i++) {
            $content[] = [
                'type' => 'blog_post_slider_section',
                'data' => [
                    'section_title' => "Blog Yazıları (Varyant $i)",
                    'section_subtitle' => "Blog posts variant $i",
                    'view_variant' => "variant_$i",
                    'category_id' => $blogCategory ? [$blogCategory->id] : [],
                    'limit' => 6,
                    'bg_color' => null,
                    'bg_image' => null,
                ],
            ];
        }

        // 8. FAQ SECTION (5 varyant)
        if ($faq) {
            for ($i = 1; $i <= 5; $i++) {
                $content[] = [
                    'type' => 'faq_section',
                    'data' => [
                        'section_title' => "S.S.S (Varyant $i)",
                        'section_subtitle' => "FAQ variant $i",
                        'view_variant' => "variant_$i",
                        'faq_id' => $faq->id,
                        'limit' => 10,
                        'bg_color' => null,
                        'bg_image' => null,
                    ],
                ];
            }
        }

        // 9. SERVICE CATEGORY SLIDER (6 varyant)
        if ($serviceCategory) {
            for ($i = 1; $i <= 6; $i++) {
                $content[] = [
                    'type' => 'service_category_slider',
                    'data' => [
                        'section_title' => "Hizmet Kategorileri (Varyant $i)",
                        'section_subtitle' => "Service categories variant $i",
                        'view_variant' => "variant_$i",
                        'service_category_ids' => [$serviceCategory->id],
                        'limit' => 6,
                        'button_text' => 'Tümünü Gör',
                        'button_url' => '/hizmetler',
                        'bg_color' => null,
                        'bg_image' => null,
                    ],
                ];
            }
        }

        // 10. PLANS SECTION (4 varyant)
        for ($i = 1; $i <= 4; $i++) {
            $content[] = [
                'type' => 'plans_section',
                'data' => [
                    'section_title' => "Planlar (Varyant $i)",
                    'section_subtitle' => "Plans variant $i",
                    'view_variant' => "variant_$i",
                    'bg_color' => null,
                    'bg_image' => null,
                ],
            ];
        }

        // 11. REFERENCES SECTION (4 varyant)
        for ($i = 1; $i <= 4; $i++) {
            $content[] = [
                'type' => 'references_section',
                'data' => [
                    'section_title' => "Referanslar (Varyant $i)",
                    'section_subtitle' => "References variant $i",
                    'view_variant' => "variant_$i",
                    'limit' => 12,
                    'bg_color' => null,
                    'bg_image' => null,
                ],
            ];
        }

        // 12. COUNTERS SECTION (4 varyant)
        for ($i = 1; $i <= 4; $i++) {
            $content[] = [
                'type' => 'counters_section',
                'data' => [
                    'section_title' => "Rakamlarla Biz (Varyant $i)",
                    'section_subtitle' => "Counters variant $i",
                    'view_variant' => "variant_$i",
                    'counters' => [
                        [
                            'title' => 'Mutlu Müşteri',
                            'description' => 'Memnun müşterilerimiz',
                            'icon' => null,
                            'value' => '1250',
                            'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=200&h=200&fit=crop',
                        ],
                        [
                            'title' => 'Tamamlanan Proje',
                            'description' => 'Başarıyla teslim edildi',
                            'icon' => 'fas fa-briefcase',
                            'value' => '850',
                            'image' => null,
                        ],
                        [
                            'title' => 'İş Ortağı',
                            'description' => 'Güvenilir partnerler',
                            'icon' => null,
                            'value' => '340',
                            'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=200&h=200&fit=crop',
                        ],
                        [
                            'title' => 'Yıllık Deneyim',
                            'description' => 'Sektördeki tecrübemiz',
                            'icon' => 'fas fa-calendar-check',
                            'value' => '15',
                            'image' => null,
                        ],
                    ],
                    'bg_color' => null,
                    'bg_image' => null,
                ],
            ];
        }

        // 13. OPERATIONS SECTION (4 varyant)
        for ($i = 1; $i <= 4; $i++) {
            $content[] = [
                'type' => 'operations_section',
                'data' => [
                    'section_title' => "Nasıl Çalışır? (Varyant $i)",
                    'section_subtitle' => "Operations variant $i",
                    'view_variant' => "variant_$i",
                    'operations' => [
                        [
                            'title' => 'İletişime Geçin',
                            'description' => 'Bizimle iletişime geçin ve ihtiyaçlarınızı paylaşın',
                            'icon' => null,
                            'image' => 'https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=200&h=200&fit=crop',
                        ],
                        [
                            'title' => 'Analiz & Planlama',
                            'description' => 'Uzman ekibimiz projenizi detaylı analiz eder',
                            'icon' => 'fas fa-chart-line',
                            'image' => null,
                        ],
                        [
                            'title' => 'Geliştirme',
                            'description' => 'En son teknolojilerle çözümünüzü geliştiririz',
                            'icon' => null,
                            'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=200&h=200&fit=crop',
                        ],
                        [
                            'title' => 'Teslimat',
                            'description' => 'Projenizi zamanında ve eksiksiz teslim ederiz',
                            'icon' => 'fas fa-check-circle',
                            'image' => null,
                        ],
                    ],
                    'bg_color' => null,
                    'bg_image' => null,
                ],
            ];
        }

        // 14. OUR TEAM SECTION (3 varyant)
        for ($i = 1; $i <= 3; $i++) {
            $content[] = [
                'type' => 'our_team_section',
                'data' => [
                    'section_title' => "Ekibimiz (Varyant $i)",
                    'section_subtitle' => "Our team variant $i",
                    'view_variant' => "variant_$i",
                    'limit' => 8,
                    'bg_color' => null,
                    'bg_image' => null,
                ],
            ];
        }

        // 15. SERVICE POST SLIDER (3 varyant)
        if ($serviceCategory) {
            for ($i = 1; $i <= 3; $i++) {
                $content[] = [
                    'type' => 'service_post_slider',
                    'data' => [
                        'section_title' => "Hizmetler (Varyant $i)",
                        'section_subtitle' => "Services variant $i",
                        'view_variant' => "variant_$i",
                        'service_category_id' => $serviceCategory->id,
                        'limit' => 6,
                        'button_text' => 'Tümünü Gör',
                        'button_url' => '/hizmetler',
                        'bg_color' => null,
                        'bg_image' => null,
                    ],
                ];
            }
        }

        // 16. NEWSLETTER FORM (2 varyant)
        for ($i = 1; $i <= 2; $i++) {
            $content[] = [
                'type' => 'newsletter_form_section',
                'data' => [
                    'section_title' => "Bülten (Varyant $i)",
                    'section_subtitle' => "Newsletter variant $i",
                    'view_variant' => "variant_$i",
                    'bg_color' => null,
                    'bg_image' => null,
                ],
            ];
        }

        // 17. LATEST BLOG POST (1 varyant)
        $content[] = [
            'type' => 'latest_blog_post_section',
            'data' => [
                'section_title' => 'Son Blog Yazısı',
                'section_subtitle' => 'Latest blog post',
                'view_variant' => 'variant_1',
                'category_id' => $blogCategory ? [$blogCategory->id] : [],
                'bg_color' => null,
                'bg_image' => null,
            ],
        ];

        // Homepage Settings'i kaydet
        $homepage_settings = new HomepageSettings();
        $homepage_settings->content = $content;
        $homepage_settings->save();

        $this->info('✓ Anasayfa içeriği kaydedildi (' . count($content) . ' component)');

        // FOOTER - 6 varyant ekle
        $footer = [];
        for ($i = 1; $i <= 6; $i++) {
            $footer[] = [
                'type' => 'footer_section',
                'data' => [
                    'menu_id' => $menu->id,
                    'view_variant' => "variant_$i",
                    'phone' => '0555 555 55 55',
                    'address' => 'Test Adres',
                    'wrapper_class' => '',
                    'bg_color' => null,
                    'link_color' => null,
                    'title_color' => null,
                    'widget_color' => null,
                    'logo_description' => 'Test footer açıklaması',
                    'bg_image' => null,
                ],
            ];
        }

        // HEADER - 1 varyant (kullanıcı sadece header kalabilir dedi)
        $header = [
            [
                'type' => 'header_section',
                'data' => [
                    'menu_id' => $menu->id,
                    'is_transparent' => false,
                    'view_variant' => 'variant_1',
                    'phone' => '0555 555 55 55',
                    'button_text' => 'İletişim',
                    'button_link' => '/iletisim',
                    'width' => 'container',
                    'wrapper_class' => '',
                    'bg_color' => null,
                    'is_topbar_active' => true,
                    'topbar_view_variant' => 'variant_1',
                    'show_address' => true,
                    'show_phone' => true,
                    'show_social' => true,
                    'topbar_text' => 'Test topbar yazısı',
                ],
            ],
        ];

        // General Settings'e kaydet
        $general_settings = new GeneralSettings();
        $general_settings->header = $header;
        $general_settings->footer = $footer;
        $general_settings->save();

        $this->info('✓ Header kaydedildi (1 varyant)');
        $this->info('✓ Footer kaydedildi (6 varyant)');

        $this->info('');
        $this->info('🎉 TAMAMLANDI! Tüm varyantlar başarıyla eklendi.');
        $this->info('');
        $this->info('📊 Özet:');
        $this->info('- Header: 1 varyant');
        $this->info('- Anasayfa: ' . count($content) . ' component');
        $this->info('- Footer: 6 varyant');
        $this->info('');
        $this->info('Şimdi /admin/homepage-builder-page sayfasından kontrol edebilirsiniz.');

        return 0;
    }
}

