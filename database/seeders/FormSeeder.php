<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form;
use App\Models\FormField;

class FormSeeder extends Seeder
{
    public function run()
    {
        // 1. İletişim Formu
        $contactForm = Form::create([
            'name' => 'iletisim-formu',
            'title' => 'İletişim Formu',
            'description' => 'Bizimle iletişime geçmek için formu doldurun',
            'slug' => 'iletisim-formu',
            'submit_button_text' => 'Gönder',
            'success_message' => 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.',
            'is_active' => true,
            'save_submissions' => true,
            'allow_multiple_submissions' => true,
            'require_login' => false,
            'send_email_notification' => true,
            'notification_email' => 'info@example.com',
            'notification_subject' => 'Yeni İletişim Formu Gönderimi',
        ]);

        // İletişim formu alanları
        $contactFields = [
            [
                'type' => 'text',
                'name' => 'ad_soyad',
                'label' => 'Ad Soyad',
                'required' => true,
                'width' => '6',
                'order' => 0,
            ],
            [
                'type' => 'email',
                'name' => 'email',
                'label' => 'E-posta',
                'required' => true,
                'width' => '6',
                'order' => 1,
            ],
            [
                'type' => 'phone',
                'name' => 'telefon',
                'label' => 'Telefon',
                'required' => false,
                'width' => '6',
                'order' => 2,
            ],
            [
                'type' => 'select',
                'name' => 'konu',
                'label' => 'Konu',
                'required' => true,
                'width' => '6',
                'order' => 3,
                'options' => [
                    'genel' => 'Genel Bilgi',
                    'destek' => 'Teknik Destek',
                    'satis' => 'Satış',
                    'sikayet' => 'Şikayet',
                    'oneriler' => 'Öneriler'
                ],
            ],
            [
                'type' => 'textarea',
                'name' => 'mesaj',
                'label' => 'Mesajınız',
                'required' => true,
                'width' => '12',
                'order' => 4,
                'placeholder' => 'Mesajınızı buraya yazın...',
            ],
        ];

        foreach ($contactFields as $field) {
            FormField::create(array_merge($field, ['form_id' => $contactForm->id]));
        }

        // 2. İş Başvuru Formu
        $jobForm = Form::create([
            'name' => 'is-basvuru-formu',
            'title' => 'İş Başvuru Formu',
            'description' => 'Şirketimizde çalışmak için başvuru formunu doldurun',
            'slug' => 'is-basvuru-formu',
            'submit_button_text' => 'Başvuruyu Gönder',
            'success_message' => 'Başvurunuz alınmıştır. Değerlendirme sonucu size e-posta ile bildirilecektir.',
            'is_active' => true,
            'save_submissions' => true,
            'allow_multiple_submissions' => false,
            'require_login' => true,
            'send_email_notification' => true,
            'notification_email' => 'hr@example.com',
            'notification_subject' => 'Yeni İş Başvurusu',
        ]);

        $jobFields = [
            [
                'type' => 'heading',
                'name' => 'kisisel_bilgiler',
                'label' => 'Kişisel Bilgiler',
                'required' => false,
                'width' => '12',
                'order' => 0,
                'settings' => ['heading_level' => 'h3'],
            ],
            [
                'type' => 'text',
                'name' => 'ad',
                'label' => 'Ad',
                'required' => true,
                'width' => '6',
                'order' => 1,
            ],
            [
                'type' => 'text',
                'name' => 'soyad',
                'label' => 'Soyad',
                'required' => true,
                'width' => '6',
                'order' => 2,
            ],
            [
                'type' => 'email',
                'name' => 'email',
                'label' => 'E-posta',
                'required' => true,
                'width' => '6',
                'order' => 3,
            ],
            [
                'type' => 'phone',
                'name' => 'telefon',
                'label' => 'Telefon',
                'required' => true,
                'width' => '6',
                'order' => 4,
            ],
            [
                'type' => 'date',
                'name' => 'dogum_tarihi',
                'label' => 'Doğum Tarihi',
                'required' => true,
                'width' => '6',
                'order' => 5,
            ],
            [
                'type' => 'select',
                'name' => 'cinsiyet',
                'label' => 'Cinsiyet',
                'required' => true,
                'width' => '6',
                'order' => 6,
                'options' => [
                    'erkek' => 'Erkek',
                    'kadin' => 'Kadın',
                    'belirtmek_istemiyorum' => 'Belirtmek İstemiyorum'
                ],
            ],
            [
                'type' => 'heading',
                'name' => 'egitim_bilgileri',
                'label' => 'Eğitim Bilgileri',
                'required' => false,
                'width' => '12',
                'order' => 7,
                'settings' => ['heading_level' => 'h3'],
            ],
            [
                'type' => 'select',
                'name' => 'egitim_seviyesi',
                'label' => 'Eğitim Seviyesi',
                'required' => true,
                'width' => '6',
                'order' => 8,
                'options' => [
                    'lise' => 'Lise',
                    'onlisans' => 'Ön Lisans',
                    'lisans' => 'Lisans',
                    'yuksek_lisans' => 'Yüksek Lisans',
                    'doktora' => 'Doktora'
                ],
            ],
            [
                'type' => 'text',
                'name' => 'okul_adi',
                'label' => 'Okul/Üniversite Adı',
                'required' => true,
                'width' => '6',
                'order' => 9,
            ],
            [
                'type' => 'heading',
                'name' => 'is_deneyimi',
                'label' => 'İş Deneyimi',
                'required' => false,
                'width' => '12',
                'order' => 10,
                'settings' => ['heading_level' => 'h3'],
            ],
            [
                'type' => 'select',
                'name' => 'deneyim_yili',
                'label' => 'Deneyim Yılı',
                'required' => true,
                'width' => '6',
                'order' => 11,
                'options' => [
                    '0' => '0-1 Yıl',
                    '1-3' => '1-3 Yıl',
                    '3-5' => '3-5 Yıl',
                    '5-10' => '5-10 Yıl',
                    '10+' => '10+ Yıl'
                ],
            ],
            [
                'type' => 'textarea',
                'name' => 'deneyim_detay',
                'label' => 'Deneyim Detayları',
                'required' => false,
                'width' => '12',
                'order' => 12,
                'placeholder' => 'Önceki iş deneyimlerinizi kısaca açıklayın...',
            ],
            [
                'type' => 'file',
                'name' => 'cv',
                'label' => 'CV Yükle',
                'required' => true,
                'width' => '12',
                'order' => 13,
                'settings' => [
                    'max_size' => 5,
                    'accept' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
                ],
            ],
            [
                'type' => 'checkbox_single',
                'name' => 'kvkk_onay',
                'label' => 'KVKK Aydınlatma Metnini okudum ve kabul ediyorum',
                'required' => true,
                'width' => '12',
                'order' => 14,
            ],
        ];

        foreach ($jobFields as $field) {
            FormField::create(array_merge($field, ['form_id' => $jobForm->id]));
        }

        // 3. Müşteri Memnuniyet Anketi
        $surveyForm = Form::create([
            'name' => 'musteri-memnuniyet-anketi',
            'title' => 'Müşteri Memnuniyet Anketi',
            'description' => 'Hizmet kalitemizi değerlendirmek için anketimizi doldurun',
            'slug' => 'musteri-memnuniyet-anketi',
            'submit_button_text' => 'Anketi Gönder',
            'success_message' => 'Anketiniz için teşekkür ederiz. Görüşleriniz bizim için çok değerli.',
            'is_active' => true,
            'save_submissions' => true,
            'allow_multiple_submissions' => true,
            'require_login' => false,
            'send_email_notification' => true,
            'notification_email' => 'feedback@example.com',
            'notification_subject' => 'Yeni Müşteri Memnuniyet Anketi',
        ]);

        $surveyFields = [
            [
                'type' => 'text',
                'name' => 'musteri_adi',
                'label' => 'Ad Soyad',
                'required' => true,
                'width' => '6',
                'order' => 0,
            ],
            [
                'type' => 'email',
                'name' => 'email',
                'label' => 'E-posta',
                'required' => true,
                'width' => '6',
                'order' => 1,
            ],
            [
                'type' => 'rating',
                'name' => 'genel_memnuniyet',
                'label' => 'Genel Memnuniyet',
                'required' => true,
                'width' => '12',
                'order' => 2,
                'settings' => ['min' => 1, 'max' => 5],
            ],
            [
                'type' => 'scale',
                'name' => 'hizmet_kalitesi',
                'label' => 'Hizmet Kalitesi (1-10)',
                'required' => true,
                'width' => '6',
                'order' => 3,
                'settings' => ['min' => 1, 'max' => 10],
            ],
            [
                'type' => 'scale',
                'name' => 'personel_davranisi',
                'label' => 'Personel Davranışı (1-10)',
                'required' => true,
                'width' => '6',
                'order' => 4,
                'settings' => ['min' => 1, 'max' => 10],
            ],
            [
                'type' => 'radio',
                'name' => 'tekrar_tercih',
                'label' => 'Hizmetimizi tekrar tercih eder misiniz?',
                'required' => true,
                'width' => '12',
                'order' => 5,
                'options' => [
                    'kesinlikle_evet' => 'Kesinlikle Evet',
                    'evet' => 'Evet',
                    'kararsiz' => 'Kararsızım',
                    'hayir' => 'Hayır',
                    'kesinlikle_hayir' => 'Kesinlikle Hayır'
                ],
            ],
            [
                'type' => 'checkbox',
                'name' => 'oneri_kategorileri',
                'label' => 'Hangi konularda önerileriniz var?',
                'required' => false,
                'width' => '12',
                'order' => 6,
                'options' => [
                    'hizmet_kalitesi' => 'Hizmet Kalitesi',
                    'personel' => 'Personel',
                    'fiyat' => 'Fiyat',
                    'hizmet_hizi' => 'Hizmet Hızı',
                    'iletisim' => 'İletişim',
                    'diger' => 'Diğer'
                ],
            ],
            [
                'type' => 'textarea',
                'name' => 'oneriler',
                'label' => 'Önerileriniz',
                'required' => false,
                'width' => '12',
                'order' => 7,
                'placeholder' => 'Görüş ve önerilerinizi buraya yazabilirsiniz...',
            ],
        ];

        foreach ($surveyFields as $field) {
            FormField::create(array_merge($field, ['form_id' => $surveyForm->id]));
        }

        // 4. Etkinlik Kayıt Formu
        $eventForm = Form::create([
            'name' => 'etkinlik-kayit-formu',
            'title' => 'Etkinlik Kayıt Formu',
            'description' => 'Etkinliğimize katılmak için kayıt formunu doldurun',
            'slug' => 'etkinlik-kayit-formu',
            'submit_button_text' => 'Kayıt Ol',
            'success_message' => 'Etkinlik kaydınız alınmıştır. Etkinlik detayları e-posta ile gönderilecektir.',
            'is_active' => true,
            'save_submissions' => true,
            'allow_multiple_submissions' => false,
            'require_login' => false,
            'send_email_notification' => true,
            'notification_email' => 'events@example.com',
            'notification_subject' => 'Yeni Etkinlik Kaydı',
        ]);

        $eventFields = [
            [
                'type' => 'text',
                'name' => 'ad_soyad',
                'label' => 'Ad Soyad',
                'required' => true,
                'width' => '6',
                'order' => 0,
            ],
            [
                'type' => 'email',
                'name' => 'email',
                'label' => 'E-posta',
                'required' => true,
                'width' => '6',
                'order' => 1,
            ],
            [
                'type' => 'phone',
                'name' => 'telefon',
                'label' => 'Telefon',
                'required' => true,
                'width' => '6',
                'order' => 2,
            ],
            [
                'type' => 'text',
                'name' => 'sirket',
                'label' => 'Şirket/Organizasyon',
                'required' => false,
                'width' => '6',
                'order' => 3,
            ],
            [
                'type' => 'select',
                'name' => 'katilim_tipi',
                'label' => 'Katılım Tipi',
                'required' => true,
                'width' => '6',
                'order' => 4,
                'options' => [
                    'bireysel' => 'Bireysel',
                    'sirket' => 'Şirket Temsilcisi',
                    'ogrenci' => 'Öğrenci',
                    'akademisyen' => 'Akademisyen'
                ],
            ],
            [
                'type' => 'select',
                'name' => 'yemek_tercihi',
                'label' => 'Yemek Tercihi',
                'required' => true,
                'width' => '6',
                'order' => 5,
                'options' => [
                    'et' => 'Et Yemeği',
                    'tavuk' => 'Tavuk Yemeği',
                    'balik' => 'Balık Yemeği',
                    'vejetaryen' => 'Vejetaryen',
                    'vegan' => 'Vegan'
                ],
            ],
            [
                'type' => 'checkbox',
                'name' => 'ilgi_alanlari',
                'label' => 'İlgi Alanlarınız',
                'required' => false,
                'width' => '12',
                'order' => 6,
                'options' => [
                    'teknoloji' => 'Teknoloji',
                    'is_gelistirme' => 'İş Geliştirme',
                    'pazarlama' => 'Pazarlama',
                    'finans' => 'Finans',
                    'egitim' => 'Eğitim',
                    'saglik' => 'Sağlık',
                    'diger' => 'Diğer'
                ],
            ],
            [
                'type' => 'textarea',
                'name' => 'ozel_ihtiyaclar',
                'label' => 'Özel İhtiyaçlar',
                'required' => false,
                'width' => '12',
                'order' => 7,
                'placeholder' => 'Alerji, diyet kısıtlaması veya özel ihtiyaçlarınızı belirtin...',
            ],
            [
                'type' => 'checkbox_single',
                'name' => 'kvkk_onay',
                'label' => 'Kişisel verilerimin işlenmesini kabul ediyorum',
                'required' => true,
                'width' => '12',
                'order' => 8,
            ],
        ];

        foreach ($eventFields as $field) {
            FormField::create(array_merge($field, ['form_id' => $eventForm->id]));
        }

        // 5. Ürün Sipariş Formu
        $orderForm = Form::create([
            'name' => 'urun-siparis-formu',
            'title' => 'Ürün Sipariş Formu',
            'description' => 'Ürünlerimizi sipariş etmek için formu doldurun',
            'slug' => 'urun-siparis-formu',
            'submit_button_text' => 'Sipariş Ver',
            'success_message' => 'Siparişiniz alınmıştır. En kısa sürede size dönüş yapacağız.',
            'is_active' => true,
            'save_submissions' => true,
            'allow_multiple_submissions' => true,
            'require_login' => false,
            'send_email_notification' => true,
            'notification_email' => 'orders@example.com',
            'notification_subject' => 'Yeni Ürün Siparişi',
        ]);

        $orderFields = [
            [
                'type' => 'heading',
                'name' => 'musteri_bilgileri',
                'label' => 'Müşteri Bilgileri',
                'required' => false,
                'width' => '12',
                'order' => 0,
                'settings' => ['heading_level' => 'h3'],
            ],
            [
                'type' => 'text',
                'name' => 'ad_soyad',
                'label' => 'Ad Soyad',
                'required' => true,
                'width' => '6',
                'order' => 1,
            ],
            [
                'type' => 'email',
                'name' => 'email',
                'label' => 'E-posta',
                'required' => true,
                'width' => '6',
                'order' => 2,
            ],
            [
                'type' => 'phone',
                'name' => 'telefon',
                'label' => 'Telefon',
                'required' => true,
                'width' => '6',
                'order' => 3,
            ],
            [
                'type' => 'text',
                'name' => 'sirket',
                'label' => 'Şirket Adı',
                'required' => false,
                'width' => '6',
                'order' => 4,
            ],
            [
                'type' => 'heading',
                'name' => 'teslimat_adresi',
                'label' => 'Teslimat Adresi',
                'required' => false,
                'width' => '12',
                'order' => 5,
                'settings' => ['heading_level' => 'h3'],
            ],
            [
                'type' => 'textarea',
                'name' => 'adres',
                'label' => 'Adres',
                'required' => true,
                'width' => '12',
                'order' => 6,
                'placeholder' => 'Tam adresinizi yazın...',
            ],
            [
                'type' => 'text',
                'name' => 'sehir',
                'label' => 'Şehir',
                'required' => true,
                'width' => '4',
                'order' => 7,
            ],
            [
                'type' => 'text',
                'name' => 'ilce',
                'label' => 'İlçe',
                'required' => true,
                'width' => '4',
                'order' => 8,
            ],
            [
                'type' => 'text',
                'name' => 'posta_kodu',
                'label' => 'Posta Kodu',
                'required' => false,
                'width' => '4',
                'order' => 9,
            ],
            [
                'type' => 'heading',
                'name' => 'siparis_detaylari',
                'label' => 'Sipariş Detayları',
                'required' => false,
                'width' => '12',
                'order' => 10,
                'settings' => ['heading_level' => 'h3'],
            ],
            [
                'type' => 'select',
                'name' => 'urun_kategorisi',
                'label' => 'Ürün Kategorisi',
                'required' => true,
                'width' => '6',
                'order' => 11,
                'options' => [
                    'elektronik' => 'Elektronik',
                    'giyim' => 'Giyim',
                    'ev_yasam' => 'Ev & Yaşam',
                    'spor' => 'Spor',
                    'kitap' => 'Kitap',
                    'diger' => 'Diğer'
                ],
            ],
            [
                'type' => 'text',
                'name' => 'urun_adi',
                'label' => 'Ürün Adı',
                'required' => true,
                'width' => '6',
                'order' => 12,
            ],
            [
                'type' => 'number',
                'name' => 'miktar',
                'label' => 'Miktar',
                'required' => true,
                'width' => '4',
                'order' => 13,
            ],
            [
                'type' => 'number',
                'name' => 'birim_fiyat',
                'label' => 'Birim Fiyat (TL)',
                'required' => false,
                'width' => '4',
                'order' => 14,
            ],
            [
                'type' => 'select',
                'name' => 'teslimat_tipi',
                'label' => 'Teslimat Tipi',
                'required' => true,
                'width' => '4',
                'order' => 15,
                'options' => [
                    'standart' => 'Standart Teslimat',
                    'hizli' => 'Hızlı Teslimat',
                    'ozel' => 'Özel Teslimat'
                ],
            ],
            [
                'type' => 'textarea',
                'name' => 'ozel_notlar',
                'label' => 'Özel Notlar',
                'required' => false,
                'width' => '12',
                'order' => 16,
                'placeholder' => 'Siparişinizle ilgili özel notlarınız...',
            ],
            [
                'type' => 'checkbox_single',
                'name' => 'sozlesme_onay',
                'label' => 'Satış sözleşmesini okudum ve kabul ediyorum',
                'required' => true,
                'width' => '12',
                'order' => 17,
            ],
        ];

        foreach ($orderFields as $field) {
            FormField::create(array_merge($field, ['form_id' => $orderForm->id]));
        }
    }
}
