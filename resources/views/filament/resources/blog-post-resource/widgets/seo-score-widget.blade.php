<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center justify-between">
                <div>
                    <span>SEO Analizi</span>
                    @if($record && $record->focus_keyword)
                        <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">
                            (Odaklanan Anahtar Kelime: <strong>{{ $record->focus_keyword }}</strong>)
                        </span>
                    @endif
                </div>
                <div class="flex gap-2">
                    <x-filament::button
                        size="sm"
                        color="primary"
                        wire:click="refreshSeoAnalysis"
                        wire:loading.attr="disabled"
                        wire:target="refreshSeoAnalysis"
                    >
                        <x-heroicon-o-arrow-path class="w-4 h-4 mr-1" wire:loading.class="animate-spin" wire:target="refreshSeoAnalysis" />
                        <span wire:loading.remove wire:target="refreshSeoAnalysis">Yenile</span>
                        <span wire:loading wire:target="refreshSeoAnalysis">Yenileniyor...</span>
                    </x-filament::button>

                    @if($record && $record->focus_keyword)
                        <x-filament::button
                            size="sm"
                            color="success"
                            wire:click="optimizeForSeo"
                            wire:loading.attr="disabled"
                            wire:target="optimizeForSeo"
                        >
                            <x-heroicon-o-sparkles class="w-4 h-4 mr-1" wire:loading.class="animate-pulse" wire:target="optimizeForSeo" />
                            <span wire:loading.remove wire:target="optimizeForSeo">SEO Uyumlu Hale Getir</span>
                            <span wire:loading wire:target="optimizeForSeo">Optimize Ediliyor...</span>
                        </x-filament::button>
                    @endif
                </div>
            </div>
        </x-slot>

        <div class="space-y-6">
            <!-- Focus Keyword Warning -->
            @if(!$record || !$record->focus_keyword)
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                    <div class="flex items-center">
                        <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mr-3" />
                        <div>
                            <h4 class="font-semibold text-yellow-800 dark:text-yellow-200">⚠️ Odaklanan Anahtar Kelime Eksik</h4>
                            <p class="text-sm text-yellow-700 dark:text-yellow-300 mt-1">
                                <strong>Önemli:</strong> Doğru SEO analizi için lütfen odaklanan anahtar kelimeyi ekleyin.
                                Bu kelime üzerinden tüm SEO optimizasyonu yapılacak.
                                <br><strong>Örnek:</strong> "evden eve nakliyat", "uluslararası taşımacılık", "eşya taşıma"
                                <br><br><strong>💡 İpucu:</strong> Anahtar kelimeyi ekledikten sonra "SEO Uyumlu Hale Getir" butonu ile içeriğinizi otomatik optimize edebilirsiniz.
                            </p>
                        </div>
                    </div>
                </div>
            @elseif($record && $record->focus_keyword && !$record->seo_score)
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                    <div class="flex items-center">
                        <x-heroicon-o-information-circle class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-3" />
                        <div>
                            <h4 class="font-semibold text-blue-800 dark:text-blue-100">ℹ️ SEO Analizi Henüz Yapılmamış</h4>
                            <p class="text-sm text-blue-700 dark:text-blue-300 mt-1">
                                SEO analizini başlatmak için yukarıdaki <strong>"Yenile"</strong> butonuna tıklayın.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- SEO Score Overview -->
            @if($this->getSeoScore() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Overall Score -->
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold"
                                 style="color: {{ $this->getSeoScore() >= 80 ? '#10b981' : ($this->getSeoScore() >= 60 ? '#f59e0b' : '#ef4444') }}">
                                {{ $this->getSeoScore() }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Genel Puan</div>
                            <div class="text-lg font-semibold"
                                 style="color: {{ $this->getSeoScore() >= 80 ? '#10b981' : ($this->getSeoScore() >= 60 ? '#f59e0b' : '#ef4444') }}">
                                {{ $this->getSeoGrade() }}
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 col-span-2">
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span>SEO Skoru</span>
                                <span>{{ $this->getSeoScore() }}/100</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="h-2 rounded-full transition-all duration-300"
                                     style="width: {{ $this->getSeoScore() }}%; background-color: {{ $this->getSeoScore() >= 80 ? '#10b981' : ($this->getSeoScore() >= 60 ? '#f59e0b' : '#ef4444') }}"></div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                @if($this->getSeoScore() >= 80)
                                    Mükemmel! SEO optimizasyonu çok iyi.
                                @elseif($this->getSeoScore() >= 60)
                                    İyi, ancak bazı iyileştirmeler yapılabilir.
                                @elseif($this->getSeoScore() >= 40)
                                    Orta seviye, SEO optimizasyonu gerekli.
                                @else
                                    Zayıf, acil SEO optimizasyonu gerekli.
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Detailed Analysis -->
            @if($this->getSeoAnalysis())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($this->getSeoAnalysis() as $category => $analysis)
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                                        {{ match($category) {
                                            'title' => '📝 Başlık Optimizasyonu',
                                            'meta_description' => '📄 Meta Açıklama',
                                            'content' => '📖 İçerik Kalitesi',
                                            'images' => '🖼️ Görsel Optimizasyonu',
                                            'url' => '🔗 URL Yapısı',
                                            'categories_tags' => '🏷️ Kategori & Etiket',
                                            'readability' => '📊 Okunabilirlik',
                                            default => ucfirst($category)
                                        } }}
                                    </h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        {{ match($category) {
                                            'title' => 'Maksimum 20 puan • 50-60 karakter, anahtar kelime içermeli',
                                            'meta_description' => 'Maksimum 15 puan • 150-160 karakter, anahtar kelime içermeli',
                                            'content' => 'Maksimum 25 puan • En az 300 kelime, başlık yapısı gerekli',
                                            'images' => 'Maksimum 15 puan • Ana görsel ve mobil görseller gerekli',
                                            'url' => 'Maksimum 10 puan • 60 karakterden kısa, tire (-) kullanın',
                                            'categories_tags' => 'Maksimum 10 puan • En az 1 kategori, 3 etiket gerekli',
                                            'readability' => 'Maksimum 5 puan • 15-20 kelime ortalama cümle uzunluğu',
                                            default => ''
                                        } }}
                                    </p>
                                </div>
                                <div class="flex items-center">
                                    @php
                                        $maxScore = match($category) {
                                            'title' => 20,
                                            'meta_description' => 15,
                                            'content' => 25,
                                            'images' => 15,
                                            'url' => 10,
                                            'categories_tags' => 10,
                                            'readability' => 5,
                                            default => 20
                                        };
                                        $percentage = min(($analysis['score'] / $maxScore) * 100, 100);
                                        $isPerfect = $analysis['score'] == $maxScore;
                                        $color = $isPerfect ? 'green' : ($analysis['score'] >= ($maxScore * 0.75) ? 'yellow' : ($analysis['score'] >= ($maxScore * 0.5) ? 'orange' : 'red'));
                                    @endphp
                                    <div class="w-20 h-2 bg-gray-200 dark:bg-gray-700 rounded-full relative mr-3">
                                        <div class="absolute top-0 left-0 h-2 rounded-full transition-all duration-300"
                                             style="width: {{ $percentage }}%; background-color: {{ $isPerfect ? '#10b981' : ($analysis['score'] >= ($maxScore * 0.75) ? '#f59e0b' : ($analysis['score'] >= ($maxScore * 0.5) ? '#f97316' : '#ef4444')) }}"></div>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <span class="text-sm font-medium"
                                              style="color: {{ $isPerfect ? '#10b981' : ($analysis['score'] >= ($maxScore * 0.75) ? '#f59e0b' : ($analysis['score'] >= ($maxScore * 0.5) ? '#f97316' : '#ef4444')) }}; {{ $isPerfect ? 'font-weight: bold;' : '' }}">
                                            {{ $analysis['score'] }}/{{ $maxScore }}
                                        </span>
                                        @if($isPerfect)
                                            <span style="color: #10b981; font-size: 1.2em;" title="Mükemmel!">✓</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if(isset($analysis['details']))
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                    {{ $analysis['details'] }}
                                </p>
                            @endif

                            @if(!empty($analysis['suggestions']))
                                <div class="space-y-1">
                                    @foreach($analysis['suggestions'] as $suggestion)
                                        <div class="flex items-start">
                                            <x-heroicon-o-exclamation-triangle class="w-4 h-4 text-warning-500 mr-1 mt-0.5 flex-shrink-0" />
                                            <span class="text-xs text-warning-600 dark:text-warning-400">{{ $suggestion }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Suggestions -->
            @if($this->getSeoSuggestions())
                <div class="bg-warning-50 dark:bg-warning-900/20 border border-warning-200 dark:border-warning-800 rounded-lg p-4">
                    <h4 class="font-semibold text-warning-900 dark:text-warning-100 mb-3 flex items-center">
                        <x-heroicon-o-light-bulb class="w-5 h-5 mr-2" />
                        Öneriler
                    </h4>
                    <div class="space-y-2">
                        @foreach($this->getSeoSuggestions() as $suggestion)
                            <div class="flex items-start">
                                <x-heroicon-o-arrow-right class="w-4 h-4 text-warning-600 dark:text-warning-400 mr-2 mt-0.5 flex-shrink-0" />
                                <span class="text-sm text-warning-700 dark:text-warning-300">{{ $suggestion }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- SEO Tips -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-3 flex items-center">
                    <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" />
                    💡 SEO İpuçları ve Kriterler
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <h5 class="font-medium text-blue-800 dark:text-blue-200 mb-2">📝 Başlık (20 puan)</h5>
                        <ul class="space-y-1">
                            @php
                                $title = $record->seo_title ?: $record->title;
                                $titleLength = mb_strlen($title);
                                $hasKeyword = $record->focus_keyword ? str_contains(strtolower($title), strtolower($record->focus_keyword)) : false;
                                $noSpecialChars = !preg_match('/[<>"\'&]/', $title);
                            @endphp
                            <li class="{{ $titleLength >= 50 && $titleLength <= 60 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • 50-60 karakter (optimal)
                                <span class="font-medium">({{ $titleLength }} karakter)</span>
                            </li>
                            <li class="{{ $hasKeyword ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • Focus keyword içermeli
                                @if($hasKeyword)
                                    <span class="text-green-500">✅</span>
                                @else
                                    <span class="text-red-500">❌</span>
                                @endif
                            </li>
                            <li class="{{ $noSpecialChars ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • Özel karakter yok
                                @if($noSpecialChars)
                                    <span class="text-green-500">✅</span>
                                @else
                                    <span class="text-red-500">❌</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-medium text-blue-800 dark:text-blue-200 mb-2">📄 Meta Açıklama (15 puan)</h5>
                        <ul class="space-y-1">
                            @php
                                $description = $record->seo_description ?: $record->short_description;
                                $descLength = mb_strlen($description);
                                $hasKeywordInDesc = $record->focus_keyword ? str_contains(strtolower($description), strtolower($record->focus_keyword)) : false;
                                $hasCTA = preg_match('/\b(daha fazla|devamı|öğren|keşfet|okuyun|incele|alın|için|hemen)\b/i', $description);
                            @endphp
                            <li class="{{ $descLength >= 150 && $descLength <= 160 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • 150-160 karakter
                                <span class="font-medium">({{ $descLength }} karakter)</span>
                            </li>
                            <li class="{{ $hasKeywordInDesc ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • Focus keyword içermeli
                                @if($hasKeywordInDesc)
                                    <span class="text-green-500">✅</span>
                                @else
                                    <span class="text-red-500">❌</span>
                                @endif
                            </li>
                            <li class="{{ $hasCTA ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • Call-to-action ekleyin
                                @if($hasCTA)
                                    <span class="text-green-500">✅</span>
                                @else
                                    <span class="text-red-500">❌</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-medium text-blue-800 dark:text-blue-200 mb-2">📖 İçerik (25 puan)</h5>
                        <ul class="space-y-1">
                            @php
                                $content = strip_tags($record->content);
                                $wordCount = str_word_count($content);
                                $hasHeadings = str_contains($record->content, '<h1>') || str_contains($record->content, '<h2>') || str_contains($record->content, '<h3>');
                                $keywordDensity = 0;
                                if ($record->focus_keyword && $wordCount > 0) {
                                    $keywordCount = substr_count(strtolower($content), strtolower($record->focus_keyword));
                                    $keywordDensity = ($keywordCount / $wordCount) * 100;
                                }
                                $optimalDensity = $keywordDensity >= 1 && $keywordDensity <= 3;
                            @endphp
                            <li class="{{ $wordCount >= 300 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • En az 300 kelime
                                <span class="font-medium">({{ $wordCount }} kelime)</span>
                            </li>
                            <li class="{{ $hasHeadings ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • H1, H2, H3 başlıkları
                                @if($hasHeadings)
                                    <span class="text-green-500">✅</span>
                                @else
                                    <span class="text-red-500">❌</span>
                                @endif
                            </li>
                            <li class="{{ $optimalDensity ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • Focus keyword %1-3 yoğunluk
                                @if($keywordDensity > 0)
                                    <span class="font-medium">({{ round($keywordDensity, 1) }}%)</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-medium text-blue-800 dark:text-blue-200 mb-2">🖼️ Görseller (15 puan)</h5>
                        <ul class="space-y-1">
                            @php
                                $hasMainImage = $record->getFirstMediaUrl('details_image') || $record->getFirstMediaUrl('listing_image');
                                $hasMobileImage = $record->getFirstMediaUrl('details_image_mobile') || $record->getFirstMediaUrl('listing_image_mobile');
                                $hasHeroImage = $record->getFirstMediaUrl('details_hero') || $record->getFirstMediaUrl('details_hero_mobile');
                            @endphp
                            <li class="{{ $hasMainImage ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • Ana görsel gerekli
                                @if($hasMainImage)
                                    <span class="text-green-500">✅</span>
                                @else
                                    <span class="text-red-500">❌</span>
                                @endif
                            </li>
                            <li class="{{ $hasMobileImage ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • Mobil görsel gerekli
                                @if($hasMobileImage)
                                    <span class="text-green-500">✅</span>
                                @else
                                    <span class="text-red-500">❌</span>
                                @endif
                            </li>
                            <li class="{{ $hasHeroImage ? 'text-green-600 dark:text-green-400' : 'text-yellow-600 dark:text-yellow-400' }}">
                                • Hero görsel tercih edilir
                                @if($hasHeroImage)
                                    <span class="text-green-500">✅</span>
                                @else
                                    <span class="text-yellow-500">⚠️</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-medium text-blue-800 dark:text-blue-200 mb-2">🔗 URL (10 puan)</h5>
                        <ul class="space-y-1">
                            @php
                                $url = $record->slug;
                                $urlLength = mb_strlen($url);
                                $hasHyphens = str_contains($url, '-') && !str_contains($url, '_');
                                $isLowercase = strtolower($url) === $url;
                            @endphp
                            <li class="{{ $urlLength <= 60 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • 60 karakterden kısa
                                <span class="font-medium">({{ $urlLength }} karakter)</span>
                            </li>
                            <li class="{{ $hasHyphens ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • Tire (-) kullanın
                                @if($hasHyphens)
                                    <span class="text-green-500">✅</span>
                                @else
                                    <span class="text-red-500">❌</span>
                                @endif
                            </li>
                            <li class="{{ $isLowercase ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • Küçük harf olmalı
                                @if($isLowercase)
                                    <span class="text-green-500">✅</span>
                                @else
                                    <span class="text-red-500">❌</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-medium text-blue-800 dark:text-blue-200 mb-2">🏷️ Kategori & Etiket (10 puan)</h5>
                        <ul class="space-y-1">
                            @php
                                $categoryCount = $record->categories()->count();
                                $tagCount = $record->tags()->count();
                                $hasCategories = $categoryCount >= 1;
                                $hasEnoughTags = $tagCount >= 3;
                            @endphp
                            <li class="{{ $hasCategories ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • En az 1 kategori
                                <span class="font-medium">({{ $categoryCount }} kategori)</span>
                            </li>
                            <li class="{{ $hasEnoughTags ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                • En az 3 etiket
                                <span class="font-medium">({{ $tagCount }} etiket)</span>
                            </li>
                            <li class="text-blue-700 dark:text-blue-300">
                                • İlgili konular seçin
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
