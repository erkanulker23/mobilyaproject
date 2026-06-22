<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Dealer;
use App\Models\News;
use App\Models\Page;
use App\Models\MenuItem;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slide;
use App\Models\Testimonial;

/**
 * DB içeriğini, mevcut frontend render motorunun (awa-data.js) beklediği
 * birebir aynı veri şekline dönüştürür. Böylece tasarım hiç değişmeden
 * içerik tamamen yönetim panelinden beslenir.
 */
class SiteData
{
    public function build(): array
    {
        return [
            'settings'   => $this->settings(),
            'categories' => $this->categories(),
            'products'   => $this->products(),
            'slides'     => $this->slides(),
            'news'       => $this->news(),
            'dealers'    => $this->dealers(),
            'pages'      => $this->pages(),
            'testimonials' => $this->testimonials(),
            'menu'       => $this->menu(),
        ];
    }

    protected function menu(): object
    {
        $map = fn ($items) => $items->map(fn ($m) => [
            'type'    => $m->type,
            'labelTr' => $m->label_tr,
            'labelEn' => $m->label_en,
            'value'   => $m->value,
        ])->values()->all();

        $all = MenuItem::where('is_active', true)->orderBy('sort')->get();

        return (object) [
            'header' => $map($all->where('location', 'header')),
            'footer' => $map($all->where('location', 'footer')),
        ];
    }

    protected function testimonials(): array
    {
        return Testimonial::where('is_active', true)->orderBy('sort')->get()->map(fn ($t) => [
            'name'      => $t->name,
            'company'   => $t->company,
            'commentTr' => $t->comment_tr,
            'commentEn' => $t->comment_en,
            'rating'    => (int) $t->rating,
            'img'       => $t->img,
        ])->all();
    }

    protected function settings(): object
    {
        $out = Setting::pluck('value', 'key')->toArray();

        // En azından defaultData ile aynı anahtarların var olmasını garanti et.
        return (object) $out;
    }

    protected function categories(): array
    {
        return Category::orderBy('sort')->get()->map(fn ($c) => [
            'id'  => $c->slug,
            'tr'  => $c->tr,
            'en'  => $c->en,
            'img' => $c->img,
            'dTr' => $c->d_tr,
            'dEn' => $c->d_en,
            'seoTitleTr' => $c->seo_title_tr,
            'seoTitleEn' => $c->seo_title_en,
            'seoDescTr'  => $c->seo_desc_tr,
            'seoDescEn'  => $c->seo_desc_en,
        ])->all();
    }

    protected function products(): array
    {
        return Product::with('category')->orderBy('sort')->get()->map(fn ($p) => [
            'id'  => $p->slug,
            'cat' => $p->category?->slug,
            'tr'  => $p->tr,
            'en'  => $p->en,
            'img' => $p->img,
            'seoTitleTr' => $p->seo_title_tr,
            'seoTitleEn' => $p->seo_title_en,
            'seoDescTr'  => $p->seo_desc_tr,
            'seoDescEn'  => $p->seo_desc_en,
        ])->all();
    }

    protected function slides(): array
    {
        return Slide::with('product')->orderBy('sort')->get()->map(fn ($s) => [
            'id'        => $s->slug,
            'img'       => $s->img,
            'subTr'     => $s->sub_tr,
            'subEn'     => $s->sub_en,
            'productId' => $s->product?->slug,
        ])->all();
    }

    protected function news(): array
    {
        return News::orderBy('sort')->get()->map(fn ($n) => [
            'id'     => $n->slug,
            'date'   => $n->date,
            'catTr'  => $n->cat_tr,
            'catEn'  => $n->cat_en,
            'tr'     => $n->tr,
            'en'     => $n->en,
            'exTr'   => $n->ex_tr,
            'exEn'   => $n->ex_en,
            'bodyTr' => $n->body_tr,
            'bodyEn' => $n->body_en,
            'seoTitleTr' => $n->seo_title_tr,
            'seoTitleEn' => $n->seo_title_en,
            'seoDescTr'  => $n->seo_desc_tr,
            'seoDescEn'  => $n->seo_desc_en,
        ])->all();
    }

    protected function dealers(): array
    {
        return Dealer::orderBy('sort')->get()->map(fn ($d) => [
            'id'   => $d->slug,
            'city' => $d->city,
            'addr' => $d->addr,
            'tel'  => $d->tel,
        ])->all();
    }

    protected function pages(): object
    {
        $out = [];
        foreach (Page::all() as $pg) {
            $out[$pg->key] = [
                'tTr' => $pg->t_tr,
                'tEn' => $pg->t_en,
                'bTr' => $pg->b_tr,
                'bEn' => $pg->b_en,
            ];
        }

        return (object) $out;
    }
}
