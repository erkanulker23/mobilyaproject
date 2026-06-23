<?php

namespace App\Services;

use App\Models\BlogPost;
use App\Models\Branch;
use App\Models\Page;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Settings\GeneralSettings;
use Illuminate\Support\Str;
use Modules\Slide\Entities\Slide;

/**
 * AWA Mobilya DC (frontend tasarımı) için DB içeriğini, awa-data.js'in beklediği
 * JSON şekline dönüştürür. Bu sayede tasarım birebir korunur ama tüm içerik
 * admin panelinden / veritabanından gelir.
 */
class DcSiteData
{
    public function build(): array
    {
        return [
            'settings' => $this->settings(),
            'categories' => $this->categories(),
            'products' => $this->products(),
            'slides' => $this->slides(),
            'news' => $this->news(),
            'dealers' => $this->dealers(),
            'pages' => $this->pages(),
            'faqs' => $this->faqs(),
        ];
    }

    private function settings(): array
    {
        $s = app(GeneralSettings::class);
        $name = $s->site_name ?: 'AWA Mobilya';
        $parts = explode(' ', trim($name), 2);

        return [
            'phone' => $s->phone ?: '444 96 16',
            'email' => $s->email ?: 'info@awamobilya.com',
            'logo' => $s->header_logo ? \Storage::url($s->header_logo) : '',
            'favicon' => $s->favicon ? \Storage::url($s->favicon) : '',
            'brandTr' => mb_strtoupper($parts[0]),
            'brandSub' => mb_strtoupper($parts[1] ?? ''),
            'addressTr' => $s->address ?: '',
            'addressEn' => $s->address ?: '',
            'hoursTr' => $s->working_hours ?: '',
            'hoursEn' => $s->working_hours ?: '',
            'aboutTr' => $this->aboutText(),
            'aboutEn' => $this->aboutText(),
            'seoTitleTr' => $s->seo_title ?: $name,
            'seoTitleEn' => $s->seo_title ?: $name,
            'seoDescTr' => $s->seo_description ?: '',
            'seoDescEn' => $s->seo_description ?: '',
            'seoKeywords' => 'AWA Mobilya, koltuk takımı, köşe takımı, yatak odası, yemek odası, kurumsal mobilya',
            'ogImage' => '/uploads/1.png',
            'whatsapp' => $s->whatsapp ?: '',
            'social' => $this->social($s),
        ];
    }

    private function social($s): array
    {
        $out = [];
        foreach (($s->social_media_links ?? []) as $item) {
            if (is_array($item) && ! empty($item['url'])) {
                $out[] = ['name' => $item['name'] ?? 'link', 'url' => $item['url']];
            }
        }
        return $out;
    }

    private function aboutText(): string
    {
        $page = Page::where('slug->tr', 'hakkimizda')->first();
        if ($page) {
            $txt = trim(strip_tags($page->getTranslation('content', 'tr')));
            if ($txt !== '') {
                return $txt;
            }
        }
        return 'Sektörü iyi analiz ederek teknoloji ile el emeğini birleştiren, markalaşmaya önem veren AWA Mobilya; dinamik ve sezgisel yapısıyla sektörün öncü firmalarından biridir.';
    }

    private function categories(): array
    {
        return ProjectCategory::query()->orderBy('order_column')->get()->map(function (ProjectCategory $c) {
            $img = optional($c->projects()->first())?->cover_url ?: '/uploads/2.png';
            return [
                'id' => $c->slug,
                'tr' => $c->name,
                'en' => $c->name,
                'img' => $img,
                'dTr' => '',
                'dEn' => '',
                'seoTitle' => $c->seo_title ?: '',
                'seoDescription' => $c->seo_description ?: '',
            ];
        })->values()->all();
    }

    private function products(): array
    {
        return Project::query()->where('published', true)->orderBy('order_column')
            ->with('projectCategory')->get()->map(function (Project $p) {
                $cat = optional($p->projectCategory)->slug ?: ($p->category ?: 'koltuk');
                $gallery = $p->getMedia('gallery')->map(fn ($m) => $m->getUrl())->values()->all();
                $long = trim(strip_tags(preg_replace('/<\/p>|<br\s*\/?>/i', "\n", (string) $p->content)));
                $pieces = collect($p->specs ?: [])->map(fn ($s) => [
                    'name' => $s['label'] ?? '',
                    'dims' => $s['value'] ?? '',
                    'img' => ! empty($s['image']) ? \Storage::disk('public')->url($s['image']) : '',
                ])->filter(fn ($x) => $x['name'] !== '')->values()->all();

                return [
                    'id' => $p->slug,
                    'cat' => $cat,
                    'tr' => $p->title,
                    'en' => $p->title,
                    'img' => $p->cover_url,
                    'gallery' => $gallery,
                    'descTr' => $p->short_description ?: '',
                    'descEn' => $p->short_description ?: '',
                    'longTr' => $long,
                    'longEn' => $long,
                    'pieces' => $pieces,
                ];
            })->values()->all();
    }

    private function slides(): array
    {
        $featured = Project::query()->where('published', true)->where('is_featured', true)
            ->orderBy('order_column')->pluck('slug')->values();

        return Slide::query()->orderBy('order_column')->get()->map(function (Slide $sl, $i) use ($featured) {
            $img = $sl->getFirstMediaUrl('image') ?: '/uploads/1.png';
            return [
                'id' => 's'.$sl->id,
                'img' => $img,
                'subTr' => $sl->getTranslation('subtitle', 'tr') ?: '',
                'subEn' => $sl->getTranslation('subtitle', 'en') ?: '',
                'descTr' => $sl->getTranslation('content', 'tr') ?: '',
                'descEn' => $sl->getTranslation('content', 'en') ?: '',
                'titleTr' => $sl->getTranslation('title', 'tr') ?: '',
                'titleEn' => $sl->getTranslation('title', 'en') ?: '',
                'productId' => $featured[$i] ?? $featured->first(),
            ];
        })->values()->all();
    }

    private function news(): array
    {
        return BlogPost::query()->whereNotNull('publish_at')->where('publish_at', '<=', now())
            ->orderByDesc('publish_at')->get()->map(function (BlogPost $n) {
                $body = trim(strip_tags(preg_replace('/<\/p>/i', "\n", $n->getTranslation('content', 'tr'))));
                return [
                    'id' => $n->getTranslation('slug', 'tr'),
                    'date' => optional($n->publish_at)->format('d.m.Y'),
                    'catTr' => 'Haber',
                    'catEn' => 'News',
                    'tr' => $n->getTranslation('title', 'tr'),
                    'en' => $n->getTranslation('title', 'en') ?: $n->getTranslation('title', 'tr'),
                    'exTr' => $n->getTranslation('short_description', 'tr') ?: '',
                    'exEn' => $n->getTranslation('short_description', 'en') ?: '',
                    'img' => $n->getFirstMediaUrl('listing_image') ?: ($n->getFirstMediaUrl('details_hero') ?: '/uploads/3.png'),
                    'bodyTr' => $body,
                    'bodyEn' => $body,
                ];
            })->values()->all();
    }

    private function dealers(): array
    {
        $branches = Branch::query()->get();
        if ($branches->isEmpty()) {
            return [];
        }
        return $branches->map(function (Branch $b) {
            $display = $b->city ? ($b->city.($b->county ? ' — '.$b->county : '')) : $b->name;
            return [
                'id' => 'd'.$b->id,
                'city' => $display,
                'province' => $b->city ?: '',
                'district' => $b->county ?: '',
                'addr' => $b->address ?: '',
                'tel' => $b->phone ?: '',
            ];
        })->values()->all();
    }

    private function faqs(): array
    {
        $faq = \Modules\Faq\Entities\Faq::with('items')->first();
        if (! $faq) {
            return [];
        }
        return $faq->items->map(function ($it) {
            return [
                'q' => $it->getTranslation('title', 'tr'),
                'a' => $it->getTranslation('short_description', 'tr') ?: $it->getTranslation('description', 'tr'),
            ];
        })->values()->all();
    }

    private function pages(): array
    {
        $titles = ['mesafeli' => 'Mesafeli Satış Sözleşmesi', 'kvkk' => 'KVKK Aydınlatma Metni', 'gizlilik' => 'Gizlilik Politikası'];
        $out = [];
        foreach (['mesafeli' => 'mesafeli-satis', 'kvkk' => 'kvkk', 'gizlilik' => 'gizlilik'] as $key => $slug) {
            $page = Page::where('slug->tr', $slug)->first();
            $body = $page ? trim(strip_tags(preg_replace('/<\/p>|<br\s*\/?>/i', "\n", $page->getTranslation('content', 'tr')))) : '';
            $title = $page ? $page->getTranslation('title', 'tr') : $titles[$key];
            $out[$key] = ['tTr' => $title, 'tEn' => $title, 'bTr' => $body, 'bEn' => $body];
        }
        return $out;
    }
}
