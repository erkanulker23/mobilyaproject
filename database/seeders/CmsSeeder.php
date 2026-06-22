<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Dealer;
use App\Models\News;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slide;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        $json = database_path('data/awa-default.json');
        $data = json_decode(file_get_contents($json), true);

        // --- Settings (group/key/value) ---
        $seoKeys = ['seoTitleTr', 'seoTitleEn', 'seoDescTr', 'seoDescEn', 'seoKeywords', 'ogImage'];
        $mailKeys = ['mailRecipient', 'mailSender', 'smtpHost', 'smtpPort', 'smtpUser', 'smtpPass', 'smtpSecure'];
        foreach ($data['settings'] as $key => $value) {
            $group = in_array($key, $seoKeys) ? 'seo' : (in_array($key, $mailKeys) ? 'mail' : 'general');
            Setting::updateOrCreate(['key' => $key], ['group' => $group, 'value' => $value]);
        }

        // --- Categories ---
        foreach ($data['categories'] as $i => $c) {
            Category::updateOrCreate(['slug' => $c['id']], [
                'tr' => $c['tr'], 'en' => $c['en'], 'img' => $c['img'] ?? null,
                'd_tr' => $c['dTr'] ?? null, 'd_en' => $c['dEn'] ?? null, 'sort' => $i,
            ]);
        }

        // --- Products ---
        foreach ($data['products'] as $i => $p) {
            $category = Category::where('slug', $p['cat'])->first();
            Product::updateOrCreate(['slug' => $p['id']], [
                'category_id' => $category?->id,
                'tr' => $p['tr'], 'en' => $p['en'], 'img' => $p['img'] ?? null, 'sort' => $i,
            ]);
        }

        // --- Slides ---
        foreach ($data['slides'] as $i => $s) {
            $product = isset($s['productId']) ? Product::where('slug', $s['productId'])->first() : null;
            Slide::updateOrCreate(['slug' => $s['id']], [
                'img' => $s['img'] ?? null, 'sub_tr' => $s['subTr'] ?? null, 'sub_en' => $s['subEn'] ?? null,
                'product_id' => $product?->id, 'sort' => $i,
            ]);
        }

        // --- News ---
        foreach ($data['news'] as $i => $n) {
            News::updateOrCreate(['slug' => $n['id']], [
                'date' => $n['date'] ?? null, 'cat_tr' => $n['catTr'] ?? null, 'cat_en' => $n['catEn'] ?? null,
                'tr' => $n['tr'], 'en' => $n['en'], 'ex_tr' => $n['exTr'] ?? null, 'ex_en' => $n['exEn'] ?? null,
                'body_tr' => $n['bodyTr'] ?? null, 'body_en' => $n['bodyEn'] ?? null, 'sort' => $i,
            ]);
        }

        // --- Dealers ---
        foreach ($data['dealers'] as $i => $d) {
            Dealer::updateOrCreate(['slug' => $d['id']], [
                'city' => $d['city'], 'addr' => $d['addr'] ?? null, 'tel' => $d['tel'] ?? null, 'sort' => $i,
            ]);
        }

        // --- Pages (legal: mesafeli / kvkk / gizlilik) ---
        foreach ($data['pages'] as $key => $pg) {
            Page::updateOrCreate(['key' => $key], [
                't_tr' => $pg['tTr'] ?? null, 't_en' => $pg['tEn'] ?? null,
                'b_tr' => $pg['bTr'] ?? null, 'b_en' => $pg['bEn'] ?? null,
            ]);
        }
    }
}
