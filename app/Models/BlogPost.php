<?php

namespace App\Models;

use App\Settings\ImageSettings;
use App\Traits\Publishable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Modules\Filament\Traits\HasFilamentSearch;
use Modules\Gallery\Entities\GalleryCategory;
use Modules\Menu\Traits\Menuable;
use Shetabit\Visitor\Traits\Visitable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class BlogPost extends Model implements HasMedia, Sitemapable
{
    use HasFactory;
    use HasFilamentSearch;
    use HasSlug;
    use HasTags;
    use HasTranslations;
    use InteractsWithMedia;
    use Menuable;
    use Publishable;
    use Visitable;

    protected $fillable = [
        'gallery_category_id',
        'slug',
        'title',
        'short_description',
        'icon',
        'custom_icon',
        'seo_title',
        'seo_description',
        'focus_keyword',
        'content',
        'publish_at',
        'share_count',
        'seo_score',
        'seo_analysis',
        'seo_suggestions',
        'unpublish_at',
    ];

    public $translatable = [
        'title',
        'short_description',
        'seo_title',
        'seo_description',
        'content',
        'slug',
    ];

    protected $casts = [
        'publish_at' => 'datetime',
        'unpublish_at' => 'datetime',
        'seo_analysis' => 'array',
        'seo_suggestions' => 'array',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_post_categories')
            ->using(BlogPostCategory::class);
    }

    public function registerMediaCollections(): void
    {
        $imageSettings = app(ImageSettings::class);

        $this->addMediaCollection('details_image')
            ->useFallbackUrl($imageSettings->blog_details_image ? url(Storage::url($imageSettings->blog_details_image)) : url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('details_image_mobile')
            ->useFallbackUrl($imageSettings->blog_details_image_mobile ? url(Storage::url($imageSettings->blog_details_image_mobile)) : url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('details_hero')
            ->useFallbackUrl($imageSettings->blog_details_hero ? url(Storage::url($imageSettings->blog_details_hero)) : url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('details_hero_mobile')
            ->useFallbackUrl($imageSettings->blog_details_hero_mobile ? url(Storage::url($imageSettings->blog_details_hero_mobile)) : url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('listing_image')
            ->useFallbackUrl($imageSettings->blog_listing_image ? url(Storage::url($imageSettings->blog_listing_image)) : url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('listing_image_mobile')
            ->useFallbackUrl($imageSettings->blog_listing_image_mobile ? url(Storage::url($imageSettings->blog_listing_image_mobile)) : url('/defaults/placeholder-image.jpg'));
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public static function getFilamentSearchLabel()
    {
        return 'title';
    }

    public function getUrlAttribute()
    {
        return route('blog.post.show', $this->slug);
    }

    public function getMenuLinkAttribute(): string
    {
        return $this->url;
    }

    public function galleryCategory(): BelongsTo
    {
        return $this->belongsTo(GalleryCategory::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(\Modules\Comment\Entities\Comment::class, 'commentable')
            ->whereNull('parent_id')
            ->approved()
            ->orderBy('created_at', 'desc');
    }

    public function allComments(): MorphMany
    {
        return $this->morphMany(\Modules\Comment\Entities\Comment::class, 'commentable')
            ->orderBy('created_at', 'desc');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        if (in_array($field, $this->translatable, true)) {
            return $this->where($field.'->'.app()->getLocale(), $value)->firstOrFail();
        }

        return parent::resolveRouteBinding($value, $field);
    }

    public function scopeFilamentSearch(Builder $query, $search): void
    {
        $query->whereRaw("LOWER(json_unquote(JSON_EXTRACT(title, '$.tr'))) like LOWER(?)", ["%{$search}%"])->limit(20);
    }

    public function toSitemapTag(): Url | string | array
    {
        return array_map(function ($locale) {
            return Url::create(route('blog.post.show', $this, true, $locale))
                ->setLastModificationDate(Carbon::create($this->updated_at))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.1);
        }, config('filament-spatie-laravel-translatable-plugin.default_locales'));
    }

    /**
     * Calculate SEO score for the blog post
     */
    public function calculateSeoScore(): array
    {
        $analysis = [];
        $suggestions = [];
        $totalScore = 0;
        $maxScore = 100;

        // 1. Title Analysis (20 points)
        $titleAnalysis = $this->analyzeTitle();
        $analysis['title'] = $titleAnalysis;
        $totalScore += $titleAnalysis['score'];
        if ($titleAnalysis['suggestions']) {
            $suggestions = array_merge($suggestions, $titleAnalysis['suggestions']);
        }

        // 2. Meta Description Analysis (15 points)
        $metaAnalysis = $this->analyzeMetaDescription();
        $analysis['meta_description'] = $metaAnalysis;
        $totalScore += $metaAnalysis['score'];
        if ($metaAnalysis['suggestions']) {
            $suggestions = array_merge($suggestions, $metaAnalysis['suggestions']);
        }

        // 3. Content Analysis (25 points)
        $contentAnalysis = $this->analyzeContent();
        $analysis['content'] = $contentAnalysis;
        $totalScore += $contentAnalysis['score'];
        if ($contentAnalysis['suggestions']) {
            $suggestions = array_merge($suggestions, $contentAnalysis['suggestions']);
        }

        // 4. Images Analysis (15 points)
        $imageAnalysis = $this->analyzeImages();
        $analysis['images'] = $imageAnalysis;
        $totalScore += $imageAnalysis['score'];
        if ($imageAnalysis['suggestions']) {
            $suggestions = array_merge($suggestions, $imageAnalysis['suggestions']);
        }

        // 5. URL/Slug Analysis (10 points)
        $urlAnalysis = $this->analyzeUrl();
        $analysis['url'] = $urlAnalysis;
        $totalScore += $urlAnalysis['score'];
        if ($urlAnalysis['suggestions']) {
            $suggestions = array_merge($suggestions, $urlAnalysis['suggestions']);
        }

        // 6. Categories and Tags (10 points)
        $categoryTagAnalysis = $this->analyzeCategoriesAndTags();
        $analysis['categories_tags'] = $categoryTagAnalysis;
        $totalScore += $categoryTagAnalysis['score'];
        if ($categoryTagAnalysis['suggestions']) {
            $suggestions = array_merge($suggestions, $categoryTagAnalysis['suggestions']);
        }

        // 7. Readability (5 points)
        $readabilityAnalysis = $this->analyzeReadability();
        $analysis['readability'] = $readabilityAnalysis;
        $totalScore += $readabilityAnalysis['score'];
        if ($readabilityAnalysis['suggestions']) {
            $suggestions = array_merge($suggestions, $readabilityAnalysis['suggestions']);
        }

        return [
            'score' => min($totalScore, $maxScore),
            'analysis' => $analysis,
            'suggestions' => array_unique($suggestions),
            'grade' => $this->calculateSeoGrade($totalScore),
            'last_analyzed' => now()->toISOString()
        ];
    }

    private function analyzeTitle(): array
    {
        $title = $this->seo_title ?: $this->title;
        $score = 0;
        $suggestions = [];

        if (empty($title)) {
            $suggestions[] = 'SEO başlığı ekleyin';
            return ['score' => 0, 'suggestions' => $suggestions, 'details' => 'Başlık eksik'];
        }

        $titleLength = mb_strlen($title);

        // Optimal length check (50-60 characters)
        if ($titleLength >= 50 && $titleLength <= 60) {
            $score += 10;
        } elseif ($titleLength >= 40 && $titleLength <= 70) {
            $score += 8;
        } elseif ($titleLength >= 30 && $titleLength <= 80) {
            $score += 5;
        } else {
            $suggestions[] = 'Başlık uzunluğu 50-60 karakter arasında olmalı (şu an: ' . $titleLength . ' karakter)';
        }

        // Focus keyword presence in title
        if ($this->focus_keyword) {
            if (str_contains(strtolower($title), strtolower($this->focus_keyword))) {
                $score += 8;
            } else {
                $suggestions[] = 'Odaklanan anahtar kelimeyi (' . $this->focus_keyword . ') başlıkta kullanın';
            }
        } else {
            $suggestions[] = 'Odaklanan anahtar kelime ekleyin';
        }

        // Special characters check
        if (!preg_match('/[<>"\'&]/', $title)) {
            $score += 2;
        } else {
            $suggestions[] = 'Başlıktan özel karakterleri (< > " \' &) kaldırın';
        }

        return [
            'score' => $score,
            'suggestions' => $suggestions,
            'details' => "Uzunluk: {$titleLength} karakter" . ($this->focus_keyword ? ", Anahtar kelime: {$this->focus_keyword}" : "")
        ];
    }

    private function analyzeMetaDescription(): array
    {
        $description = $this->seo_description ?: $this->short_description;
        $score = 0;
        $suggestions = [];

        if (empty($description)) {
            $suggestions[] = 'SEO açıklaması ekleyin';
            return ['score' => 0, 'suggestions' => $suggestions, 'details' => 'Meta açıklama eksik'];
        }

        $descLength = mb_strlen($description);

        // Optimal length check (150-160 characters)
        if ($descLength >= 150 && $descLength <= 160) {
            $score += 10;
        } elseif ($descLength >= 140 && $descLength <= 170) {
            $score += 8;
        } elseif ($descLength >= 120 && $descLength <= 180) {
            $score += 5;
        } else {
            $suggestions[] = 'Meta açıklama 150-160 karakter arasında olmalı (şu an: ' . $descLength . ' karakter)';
        }

        // Call to action
        if (preg_match('/\b(daha fazla|devamı|öğren|keşfet|okuyun|incele)\b/i', $description)) {
            $score += 3;
        }

        // Focus keyword presence
        if ($this->focus_keyword && str_contains(strtolower($description), strtolower($this->focus_keyword))) {
            $score += 3;
        } elseif (!$this->focus_keyword) {
            $suggestions[] = 'Odaklanan anahtar kelime ekleyin';
        }

        return [
            'score' => $score,
            'suggestions' => $suggestions,
            'details' => "Uzunluk: {$descLength} karakter"
        ];
    }

    private function analyzeContent(): array
    {
        $content = strip_tags($this->content);
        $score = 0;
        $suggestions = [];

        if (empty($content)) {
            $suggestions[] = 'İçerik ekleyin';
            return ['score' => 0, 'suggestions' => $suggestions, 'details' => 'İçerik eksik'];
        }

        $wordCount = str_word_count($content);
        $charCount = mb_strlen($content);

        // Content length (minimum 300 words)
        if ($wordCount >= 300) {
            $score += 10;
        } elseif ($wordCount >= 200) {
            $score += 7;
        } elseif ($wordCount >= 100) {
            $score += 4;
        } else {
            $suggestions[] = 'İçerik en az 300 kelime olmalı (şu an: ' . $wordCount . ' kelime)';
        }

        // Focus keyword density (1-3%) - sadece focus keyword varsa
        if ($this->focus_keyword) {
            $keywordCount = substr_count(strtolower($content), strtolower($this->focus_keyword));
            $density = $keywordCount > 0 ? ($keywordCount / max($wordCount, 1)) * 100 : 0;

            if ($density >= 1 && $density <= 3) {
                $score += 8;
            } elseif ($density > 0 && $density <= 5) {
                $score += 5;
            } else {
                $suggestions[] = 'Odaklanan anahtar kelime yoğunluğu %1-3 arasında olmalı (şu an: ' . round($density, 1) . '%)';
            }
        }

        // Headings structure - sadece HTML içerik varsa
        if ($this->content && str_contains($this->content, '<')) {
            $headingCount = substr_count($this->content, '<h1>') + substr_count($this->content, '<h2>') + substr_count($this->content, '<h3>');
            if ($headingCount >= 2) {
                $score += 5;
            } else {
                $suggestions[] = 'İçeriğe en az 2 başlık (H1, H2, H3) ekleyin';
            }

            // Paragraph structure
            $paragraphCount = substr_count($this->content, '<p>');
            if ($paragraphCount >= 3) {
                $score += 2;
            } else {
                $suggestions[] = 'İçeriği paragraflara bölün';
            }
        }

        return [
            'score' => $score,
            'suggestions' => $suggestions,
            'details' => "Kelime sayısı: {$wordCount}, Karakter sayısı: {$charCount}"
        ];
    }

    private function analyzeImages(): array
    {
        $score = 0;
        $suggestions = [];
        $imageCount = 0;

        // Check for main image
        if ($this->getFirstMediaUrl('details_image') || $this->getFirstMediaUrl('listing_image')) {
            $score += 8;
            $imageCount++;
        } else {
            $suggestions[] = 'Ana görsel ekleyin';
        }

        // Check for mobile images
        if ($this->getFirstMediaUrl('details_image_mobile') || $this->getFirstMediaUrl('listing_image_mobile')) {
            $score += 4;
            $imageCount++;
        } else {
            $suggestions[] = 'Mobil görsel ekleyin';
        }

        // Check for hero images
        if ($this->getFirstMediaUrl('details_hero') || $this->getFirstMediaUrl('details_hero_mobile')) {
            $score += 3;
            $imageCount++;
        }

        return [
            'score' => $score,
            'suggestions' => $suggestions,
            'details' => "Toplam görsel sayısı: {$imageCount}"
        ];
    }

    private function analyzeUrl(): array
    {
        $url = $this->slug;
        $score = 0;
        $suggestions = [];

        if (empty($url)) {
            $suggestions[] = 'URL slug ekleyin';
            return ['score' => 0, 'suggestions' => $suggestions, 'details' => 'URL eksik'];
        }

        // URL length check
        $urlLength = mb_strlen($url);
        if ($urlLength <= 60) {
            $score += 5;
        } else {
            $suggestions[] = 'URL çok uzun (60 karakterden kısa olmalı)';
        }

        // Hyphens instead of underscores
        if (str_contains($url, '-') && !str_contains($url, '_')) {
            $score += 3;
        } else {
            $suggestions[] = 'URL\'de tire (-) kullanın, alt çizgi (_) kullanmayın';
        }

        // Lowercase check
        if (strtolower($url) === $url) {
            $score += 2;
        } else {
            $suggestions[] = 'URL küçük harflerle yazılmalı';
        }

        return [
            'score' => $score,
            'suggestions' => $suggestions,
            'details' => "URL uzunluğu: {$urlLength} karakter"
        ];
    }

    private function analyzeCategoriesAndTags(): array
    {
        $score = 0;
        $suggestions = [];

        // Categories
        if ($this->categories()->count() > 0) {
            $score += 5;
        } else {
            $suggestions[] = 'En az bir kategori seçin';
        }

        // Tags
        if ($this->tags()->count() >= 3) {
            $score += 5;
        } elseif ($this->tags()->count() > 0) {
            $score += 3;
            $suggestions[] = 'En az 3 etiket ekleyin';
        } else {
            $suggestions[] = 'Etiket ekleyin (en az 3)';
        }

        return [
            'score' => $score,
            'suggestions' => $suggestions,
            'details' => "Kategori: {$this->categories()->count()}, Etiket: {$this->tags()->count()}"
        ];
    }

    private function analyzeReadability(): array
    {
        $content = strip_tags($this->content);
        $score = 0;
        $suggestions = [];

        if (empty($content)) {
            return ['score' => 0, 'suggestions' => [], 'details' => 'İçerik yok'];
        }

        $sentences = preg_split('/[.!?]+/', $content);
        $words = str_word_count($content);
        $avgSentenceLength = $words / max(count($sentences), 1);

        // Average sentence length (15-20 words optimal)
        if ($avgSentenceLength >= 15 && $avgSentenceLength <= 20) {
            $score += 3;
        } elseif ($avgSentenceLength >= 10 && $avgSentenceLength <= 25) {
            $score += 2;
        } else {
            $suggestions[] = 'Cümle uzunluğu 15-20 kelime arasında olmalı (şu an: ' . round($avgSentenceLength, 1) . ' kelime)';
        }

        // Paragraph breaks
        $paragraphCount = substr_count($this->content, '<p>');
        if ($paragraphCount >= 3) {
            $score += 2;
        }

        return [
            'score' => $score,
            'suggestions' => $suggestions,
            'details' => "Ortalama cümle uzunluğu: " . round($avgSentenceLength, 1) . " kelime"
        ];
    }

    private function calculateSeoGrade(int $score): string
    {
        if ($score >= 90) {
            return 'A+';
        }
        if ($score >= 80) {
            return 'A';
        }
        if ($score >= 70) {
            return 'B+';
        }
        if ($score >= 60) {
            return 'B';
        }
        if ($score >= 50) {
            return 'C+';
        }
        if ($score >= 40) {
            return 'C';
        }
        if ($score >= 30) {
            return 'D';
        }
        return 'F';
    }

    /**
     * Update SEO score and analysis
     */
    public function updateSeoAnalysis(): void
    {
        $seoData = $this->calculateSeoScore();

        $this->update([
            'seo_score' => $seoData['score'],
            'seo_analysis' => $seoData['analysis'],
            'seo_suggestions' => $seoData['suggestions'],
        ]);
    }

    /**
     * Get SEO score as percentage
     */
    public function getSeoScorePercentage(): int
    {
        return $this->seo_score ?? 0;
    }

    /**
     * Get SEO grade
     */
    public function getSeoGrade(): string
    {
        return $this->calculateSeoGrade($this->seo_score ?? 0);
    }

    /**
     * Automatically optimize content for SEO
     */
    public function autoOptimizeSeo(): void
    {
        if (!$this->focus_keyword) {
            return;
        }

        $keyword = strtolower($this->focus_keyword);
        $keywordTitle = ucwords($this->focus_keyword);

        // 1. SEO Title Optimizasyonu
        if (!$this->seo_title || empty($this->seo_title)) {
            $currentTitle = $this->title;
            $titleLength = mb_strlen($currentTitle);

            // Eğer title 50-60 karakter arasındaysa ve keyword içeriyorsa, SEO title olarak kullan
            if ($titleLength >= 50 && $titleLength <= 60 && str_contains(strtolower($currentTitle), $keyword)) {
                $this->seo_title = $currentTitle;
            } else {
                // Yeni SEO title oluştur
                $seoTitle = $keywordTitle . ' | ' . $currentTitle;
                if (mb_strlen($seoTitle) > 60) {
                    $seoTitle = $keywordTitle . ' - ' . mb_substr($currentTitle, 0, 60 - mb_strlen($keywordTitle) - 3) . '...';
                }
                $this->seo_title = $seoTitle;
            }
        }

        // 2. Meta Description Optimizasyonu
        if (!$this->seo_description || empty($this->seo_description)) {
            $description = $this->short_description ?: $this->title;
            $descLength = mb_strlen($description);

            // Eğer açıklama 150-160 karakter arasındaysa ve keyword içeriyorsa, SEO description olarak kullan
            if ($descLength >= 150 && $descLength <= 160 && str_contains(strtolower($description), $keyword)) {
                $this->seo_description = $description;
            } else {
                // Yeni SEO description oluştur
                $seoDesc = $description;

                // Keyword'ü ekle
                if (!str_contains(strtolower($seoDesc), $keyword)) {
                    $seoDesc = $seoDesc . ' ' . $keyword . ' hizmetleri ile ilgili detaylı bilgi almak için okuyun.';
                }

                // CTA ekle
                if (!preg_match('/\b(daha fazla|devamı|öğren|keşfet|okuyun|incele|alın|için|hemen)\b/i', $seoDesc)) {
                    $seoDesc = $seoDesc . ' Daha fazla bilgi için okuyun.';
                }

                // Uzunluğu kontrol et
                if (mb_strlen($seoDesc) > 160) {
                    $seoDesc = mb_substr($seoDesc, 0, 157) . '...';
                }

                $this->seo_description = $seoDesc;
            }
        }

        // 3. Content Optimizasyonu
        if ($this->content) {
            $content = $this->content;

            // H1, H2, H3 başlıkları kontrol et ve ekle
            if (!str_contains($content, '<h1>') && !str_contains($content, '<h2>') && !str_contains($content, '<h3>')) {
                // İlk paragraftan sonra H2 başlığı ekle
                $content = str_replace('<p>', '<h2>' . $keywordTitle . ' Hakkında</h2><p>', $content);

                // İçeriğin ortasına bir H3 başlığı ekle
                $paragraphs = explode('</p>', $content);
                if (count($paragraphs) >= 3) {
                    $middleIndex = intval(count($paragraphs) / 2);
                    $paragraphs[$middleIndex] = '</p><h3>' . $keywordTitle . ' Avantajları</h3><p>' . $paragraphs[$middleIndex];
                    $content = implode('</p>', $paragraphs);
                }
            }

            // Keyword density kontrolü
            $plainContent = strip_tags($content);
            $wordCount = str_word_count($plainContent);
            $keywordCount = substr_count(strtolower($plainContent), $keyword);
            $density = $wordCount > 0 ? ($keywordCount / $wordCount) * 100 : 0;

            // Eğer keyword density %1'den azsa, keyword'ü ekle
            if ($density < 1 && $wordCount > 100) {
                // İlk paragrafta keyword'ü vurgula
                $firstParagraph = strpos($content, '<p>');
                if ($firstParagraph !== false) {
                    $firstParagraphEnd = strpos($content, '</p>', $firstParagraph);
                    if ($firstParagraphEnd !== false) {
                        $paragraph = substr($content, $firstParagraph + 3, $firstParagraphEnd - $firstParagraph - 3);
                        if (!str_contains(strtolower($paragraph), $keyword)) {
                            $paragraph = $paragraph . ' ' . $keywordTitle . ' konusunda uzman ekibimiz size yardımcı olmaktadır.';
                            $content = substr_replace($content, $paragraph, $firstParagraph + 3, $firstParagraphEnd - $firstParagraph - 3);
                        }
                    }
                }
            }

            $this->content = $content;
        }

        // 4. Slug Optimizasyonu
        if ($this->slug && !str_contains($this->slug, $keyword)) {
            // Slug'a keyword ekle (eğer çok uzun değilse)
            $newSlug = $this->slug . '-' . str_replace(' ', '-', $keyword);
            if (mb_strlen($newSlug) <= 60) {
                $this->slug = $newSlug;
            }
        }

        // 5. Etiketler ekle (eğer yoksa)
        if ($this->tags()->count() < 3) {
            $suggestedTags = [
                $this->focus_keyword,
                str_replace([' ', '-'], ['', ''], $this->focus_keyword),
                'hizmet'
            ];

            foreach ($suggestedTags as $tagName) {
                if ($this->tags()->where('name', $tagName)->count() == 0) {
                    $this->attachTag($tagName);
                }
            }
        }

        // Değişiklikleri kaydet
        $this->save();
    }

}
