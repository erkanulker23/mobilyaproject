<?php

namespace App\Notifications\User;

use App\Models\ContactFormSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactUsNotification extends Notification implements ShouldQueue
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
        return ['mail'];
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
            ->subject('Mesajınızı Aldık')
            ->greeting("Sayın $contactForm->name,")
            ->line('İletişim formunuz bize ulaşmıştır. En kısa sürede geri dönüş sağlayacağız.')
            ->line("Mesajınız: $contactForm->message")
            ->line("İletişim bilgileriniz: $contactForm->email, $contactForm->phone")
            ->line('İyi günler dileriz.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
