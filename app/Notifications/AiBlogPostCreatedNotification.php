<?php

namespace App\Notifications;

use App\Models\BlogPost;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AiBlogPostCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private BlogPost $blogPost)
    {
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase(User $notifiable): array
    {
        return FilamentNotification::make()
            ->title('Yapay Zeka ile Blog Yazısı Oluşturuldu')
            ->actions([
                Action::make('Göster')
                    ->url(route('filament.admin.resources.blog-posts.edit', $this->blogPost->id))
                    ->button(),
            ])
            ->getDatabaseMessage();
    }
}
