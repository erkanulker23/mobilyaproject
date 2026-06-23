<?php

namespace App\Notifications\Admin;

use App\Models\ContactFormSubmission;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public ContactFormSubmission $contactForm)
    {
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $contactForm = $this->contactForm;

        return (new MailMessage)
            ->subject('İletişim Formu İsteği Oluşturuldu')
            ->greeting("Sayın $notifiable->fullname,")
            ->line('Websitenizdeki iletişim formu aracılığıyla yeni bir iletişim formu isteği oluşturuldu.')
            ->line("Ad Soyad: $contactForm->name")
            ->line("Mesaj: $contactForm->message")
            ->line("İletişim bilgileri: $contactForm->email, $contactForm->phone")
            ->line('İyi günler dileriz.');
    }

    public function toDatabase(User $notifiable): array
    {
        return FilamentNotification::make()
            ->title('Yeni Bir İletişim Formu İsteği')
            ->actions([
                Action::make('Göster')
                    ->url(route('filament.admin.resources.contact-form-submissions.index', $this->contactForm))
                    ->button(),
            ])
            ->getDatabaseMessage();
    }
}
