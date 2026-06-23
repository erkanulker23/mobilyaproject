<?php

namespace App\Filament\Actions;

use App\Jobs\CreateAIPost;
use App\Models\AiPromptTemplate;
use App\Settings\ThirdPartySettings;
use Closure;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Placeholder;
use Illuminate\Contracts\Support\Htmlable;

class CreatePostWithGPTAction extends Action
{
    protected string|Htmlable|Closure|null $label = 'Yapay Zeka ile Oluştur';

    protected string $openAiFunction;

    protected $modelClass;

    protected function setUp(): void
    {
        parent::setUp();

        $this->modalHeading(fn (): string => $this->label);

        $this->modalSubmitActionLabel('Oluştur');

        $this->successNotificationTitle('İşleminiz tamamlandı. Bildirim alacaksınız.');

        $this->modalDescription('Bir prompt şablonu seçin ve konuyu girin. Blog yazısı oluşturulduğunda bildirim alacaksınız.');

        $this->color('success');

        $this->modalIcon('heroicon-o-sparkles');

        $this->icon('heroicon-o-sparkles');

        $this->modalWidth('3xl');

        $this->form([
            Toggle::make('use_template')
                ->label('Prompt Şablonu Kullan')
                ->default(true)
                ->reactive()
                ->inline(false)
                ->helperText('Şablon kullanarak daha kapsamlı ve özelleştirilmiş içerikler oluşturabilirsiniz'),

            Select::make('template_id')
                ->label('Prompt Şablonu')
                ->options(function () {
                    return AiPromptTemplate::active()
                        ->orderBy('sort_order')
                        ->pluck('name', 'id');
                })
                ->default(function () {
                    return AiPromptTemplate::default()->first()?->id;
                })
                ->required()
                ->reactive()
                ->visible(fn (callable $get) => $get('use_template'))
                ->searchable()
                ->helperText('Önceden tanımlanmış prompt şablonlarından birini seçin'),

            Placeholder::make('template_info')
                ->label('Şablon Bilgileri')
                ->content(function (callable $get) {
                    $templateId = $get('template_id');
                    if (!$templateId) {
                        return 'Şablon seçilmedi';
                    }

                    $template = AiPromptTemplate::find($templateId);
                    if (!$template) {
                        return 'Şablon bulunamadı';
                    }

                    $info = [];
                    $info[] = "📝 Dil: " . match($template->language) {
                        'tr' => 'Türkçe',
                        'en' => 'İngilizce',
                        'de' => 'Almanca',
                        'fr' => 'Fransızca',
                        'es' => 'İspanyolca',
                        default => $template->language,
                    };
                    $info[] = "🎨 Ton: " . $template->tone;
                    $info[] = "✍️ Yazım Stili: " . $template->writing_style;
                    $info[] = "📊 Varsayılan Kelime: " . $template->default_word_count;

                    if ($template->include_faq) {
                        $info[] = "❓ SSS: " . ($template->faq_count ?? 5) . " soru";
                    }
                    if ($template->seo_optimized) {
                        $info[] = "🔍 SEO Optimize";
                    }

                    return implode("\n", $info);
                })
                ->visible(fn (callable $get) => $get('use_template') && $get('template_id')),

            Select::make('gpt_model')
                ->label('GPT Modeli')
                ->default('gpt-3.5-turbo-0125')
                ->options([
                    'gpt-3.5-turbo-0125' => 'GPT-3.5 Turbo (Hızlı)',
                    'gpt-4-turbo' => 'GPT-4 Turbo (Güçlü)',
                    'gpt-4o' => 'GPT-4o (En Yeni)',
                ])
                ->visible(fn (callable $get) => !$get('use_template'))
                ->helperText('Şablon kullanılmadığında hangi modelin kullanılacağı'),

            Select::make('fields')
                ->label('Veri Alanları')
                ->options([
                    'short_description' => 'Kısa Açıklama',
                    'seo_title' => 'SEO Başlık',
                    'seo_description' => 'SEO Açıklama',
                ])
                ->multiple()
                ->visible(fn (callable $get) => !$get('use_template')),

            TextInput::make('words')
                ->label('Kelime Sayısı')
                ->default(fn (callable $get) => $get('use_template') && $get('template_id')
                    ? AiPromptTemplate::find($get('template_id'))?->default_word_count ?? 700
                    : 700
                )
                ->numeric()
                ->step(50)
                ->minValue(100)
                ->maxValue(5000)
                ->helperText('Kelime sayısı arttıkça oluşturma süresi de artar.')
                ->required()
                ->reactive(),

            Textarea::make('prompt')
                ->label('Konu / Başlık')
                ->helperText('Blog yazısı oluşturulacak konuyu belirtin. Daha fazla detay verirseniz daha iyi sonuçlar alabilirsiniz.')
                ->placeholder('Örn: Dijital Pazarlamada SEO Optimizasyonu')
                ->rows(3)
                ->required(),

            Textarea::make('target_keywords')
                ->label('Odaklanılacak Anahtar Kelimeler')
                ->helperText('Yazıda odaklanılmasını istediğiniz anahtar kelimeleri virgülle ayırarak girin.')
                ->placeholder('Örn: SEO, dijital pazarlama, arama motoru optimizasyonu, organik trafik')
                ->rows(2)
                ->columnSpanFull(),
        ]);

        $this->hidden(static function (): bool {
            try {
                $thirdPartySettings = app(ThirdPartySettings::class);

                return ! $thirdPartySettings->openai_api_key;
            } catch (\Exception $e) {
                return true;
            }
        });

        $this->action(function ($data): void {
            $useTemplate = $data['use_template'] ?? true;

            CreateAIPost::dispatch(
                topic: $data['prompt'],
                extraFields: $data['fields'] ?? [],
                words: $data['words'],
                modelClass: $this->modelClass,
                user: auth()->user(),
                post: null,
                gptModel: $data['gpt_model'] ?? 'gpt-3.5-turbo-0125',
                templateId: $useTemplate ? ($data['template_id'] ?? null) : null,
                targetKeywords: $data['target_keywords'] ?? null,
            );

            $this->sendSuccessNotification();
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'createPostWithGPT';
    }

    public function setModelClass($modelClass): static
    {
        $this->modelClass = $modelClass;

        return $this;
    }
}
