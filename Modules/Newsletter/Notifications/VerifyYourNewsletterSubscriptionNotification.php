<?php

namespace Modules\Newsletter\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Modules\Newsletter\Entities\NewsletterSubscriber;

class VerifyYourNewsletterSubscriptionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(private NewsletterSubscriber $subscriber)
    {
        //
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
        $signedUrl = URL::signedRoute('newsletter.verify', ['token' => $this->subscriber->token]);

        return (new MailMessage)
            ->subject('E-bülten Aboneliğinizi Onaylayın')
            ->line('E-bülten aboneliğinizi onaylamak için aşağıdaki butona tıklayın.')
            ->action('ONAYLA', $signedUrl);
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
