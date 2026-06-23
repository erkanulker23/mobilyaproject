<?php

namespace App\Notifications;

use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AiBlogPostFailedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private string $topic,
        private string $errorMessage,
        private string $errorType = 'unknown'
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Blog yazısı oluşturulamadı.')
            ->line('Konu: ' . $this->topic)
            ->line('Hata: ' . $this->errorMessage);
    }

    public function toDatabase(User $notifiable): array
    {
        $title = match ($this->errorType) {
            'quota_exceeded' => '⚠️ OpenAI API Kotası Aşıldı',
            'api_error' => '❌ API Hatası',
            'invalid_key' => '🔑 Geçersiz API Anahtarı',
            default => '❌ Blog Yazısı Oluşturulamadı',
        };

        $body = "**Konu:** {$this->topic}\n\n**Hata Detayı:**\n{$this->errorMessage}";

        $actions = [];

        if ($this->errorType === 'quota_exceeded') {
            $actions[] = Action::make('OpenAI Billing')
                ->url('https://platform.openai.com/account/billing')
                ->button()
                ->openUrlInNewTab();

            $body .= "\n\n💡 **Çözüm:** OpenAI hesabınıza kredi yükleyin veya planınızı yükseltin.";
        } elseif ($this->errorType === 'invalid_key') {
            $actions[] = Action::make('API Ayarları')
                ->url(route('filament.admin.pages.manage-third-party'))
                ->button();

            $body .= "\n\n💡 **Çözüm:** API anahtarınızı kontrol edin ve güncelleyin.";
        }

        $actions[] = Action::make('Tekrar Dene')
            ->url(route('filament.admin.resources.blog-posts.index'))
            ->button()
            ->color('success');

        return FilamentNotification::make()
            ->title($title)
            ->body($body)
            ->danger()
            ->actions($actions)
            ->getDatabaseMessage();
    }
}
