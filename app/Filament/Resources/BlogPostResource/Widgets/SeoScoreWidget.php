<?php

namespace App\Filament\Resources\BlogPostResource\Widgets;

use App\Models\BlogPost;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class SeoScoreWidget extends Widget
{
    protected static string $view = 'filament.resources.blog-post-resource.widgets.seo-score-widget';

    protected int | string | array $columnSpan = 'full';

    public ?BlogPost $record = null;

    public function mount(?Model $record = null): void
    {
        $this->record = $record;

        // SEO analizi otomatik yapma - sadece manuel buton ile yapılsın
    }

    public function refreshSeoAnalysis(): void
    {
        if ($this->record) {
            try {
                $this->record->updateSeoAnalysis();
                $this->record->refresh();

                // Filament notification göster
                \Filament\Notifications\Notification::make()
                    ->title('SEO Analizi Güncellendi')
                    ->body('SEO skoru ve analizi başarıyla güncellendi.')
                    ->success()
                    ->send();

            } catch (\Exception $e) {
                \Filament\Notifications\Notification::make()
                    ->title('Hata')
                    ->body('SEO analizi güncellenirken bir hata oluştu: ' . $e->getMessage())
                    ->danger()
                    ->send();
            }
        }
    }

    public function optimizeForSeo(): void
    {
        if ($this->record && $this->record->focus_keyword) {
            try {
                $this->record->autoOptimizeSeo();
                $this->record->refresh();

                // Filament notification göster
                \Filament\Notifications\Notification::make()
                    ->title('SEO Optimizasyonu Tamamlandı')
                    ->body('İçerik otomatik olarak SEO uyumlu hale getirildi. Yenile butonuna tıklayarak yeni skorları görün.')
                    ->success()
                    ->send();

            } catch (\Exception $e) {
                \Filament\Notifications\Notification::make()
                    ->title('Hata')
                    ->body('SEO optimizasyonu sırasında bir hata oluştu: ' . $e->getMessage())
                    ->danger()
                    ->send();
            }
        } else {
            \Filament\Notifications\Notification::make()
                ->title('Uyarı')
                ->body('SEO optimizasyonu için önce odaklanan anahtar kelimeyi ekleyin.')
                ->warning()
                ->send();
        }
    }

    public function getSeoScore(): int
    {
        return $this->record?->seo_score ?? 0;
    }

    public function getSeoGrade(): string
    {
        return $this->record?->getSeoGrade() ?? 'F';
    }

    public function getSeoAnalysis(): array
    {
        return $this->record?->seo_analysis ?? [];
    }

    public function getSeoSuggestions(): array
    {
        return $this->record?->seo_suggestions ?? [];
    }

    public function getScoreColor(): string
    {
        $score = $this->getSeoScore();

        if ($score >= 80) {
            return 'success';
        }
        if ($score >= 60) {
            return 'warning';
        }
        if ($score >= 40) {
            return 'danger';
        }
        return 'gray';
    }

    public function getGradeColor(): string
    {
        $grade = $this->getSeoGrade();

        return match($grade) {
            'A+', 'A' => 'success',
            'B+', 'B' => 'warning',
            'C+', 'C' => 'danger',
            default => 'gray'
        };
    }
}
