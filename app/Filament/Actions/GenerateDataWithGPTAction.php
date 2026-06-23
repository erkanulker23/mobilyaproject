<?php

namespace App\Filament\Actions;

use App\Settings\ThirdPartySettings;
use Closure;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\Support\Htmlable;
use Livewire\Component;

class GenerateDataWithGPTAction extends Action
{
    protected string|Htmlable|Closure|null $label = 'Generate Data With GPT';

    protected string $openAiFunction;

    protected function setUp(): void
    {
        parent::setUp();

        $this->modalHeading(fn (): string => $this->label);

        // TODO: fix this
        $this->modalSubmitActionLabel('Generate');

        $this->successNotificationTitle('Blog post data generated successfully');

        // TODO: fix this
        $this->modalDescription('Lütfen aşağıdaki alanlardan hangilerini doldurmak istediğinizi seçin ve ardından bir konu belirtin. Blog yazısı verileri GPT-Turbo ile otomatik olarak oluşturulacaktır.');

        $this->color('success');

        //$this->requiresConfirmation();

        $this->modalIcon('heroicon-o-sparkles');

        $this->icon('heroicon-o-sparkles');

        $this->form([
            Select::make('fields')
                ->label('Veri Alanları')
                ->options([
                    'title' => 'Başlık',
                    'content' => 'İçerik',
                    'short_description' => 'Kısa Açıklama',
                    'seo_title' => 'SEO Başlık',
                    'seo_description' => 'SEO Açıklama',
                ])
                ->multiple(),
            TextInput::make('words')
                ->label('Kelime Sayısı')
                ->default('700')
                ->numeric()
                ->step(50)
                ->required(),
            Textarea::make('prompt')
                ->label('Konu')
                ->required(),
        ]);

        $this->hidden(static function (): bool {
            $thirdPartySettings = app(ThirdPartySettings::class);
            try {
                return ! $thirdPartySettings->openai_api_key;
            } catch (\Exception $e) {
                return true;
            }
        });

        $this->action(function ($data, Component $livewire): void {
            $openaiService = app()->make(\App\Services\OpenAIService::class);

            $functionName = $this->getOpenAiFunction();

            $response = $openaiService->$functionName(
                $data['prompt'],
                $data['fields'],
                $data['words']
            );

            foreach ($response as $field => $value) {
                $livewire->data[$field] = $value;
            }
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'generate-data-with-gpt';
    }

    public function getOpenAiFunction(): string
    {
        return $this->openAiFunction;
    }

    public function setOpenAiFunction(string $openAiFunction): self
    {
        $this->openAiFunction = $openAiFunction;

        return $this;
    }
}
