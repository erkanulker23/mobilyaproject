<?php

namespace App\Notifications;

use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FormSubmissionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $form;
    protected $submission;

    public function __construct(Form $form, FormSubmission $submission)
    {
        $this->form = $form;
        $this->submission = $submission;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject($this->form->notification_subject ?? 'Yeni Form Gönderimi')
            ->greeting('Merhaba!')
            ->line('**' . $this->form->name . '** formuna yeni bir gönderim yapıldı.')
            ->line('**Gönderim Detayları:**');

        foreach ($this->submission->formatted_data as $item) {
            $value = is_array($item['value']) ? implode(', ', $item['value']) : $item['value'];
            $message->line('**' . $item['label'] . ':** ' . $value);
        }

        $message->line('**IP Adresi:** ' . $this->submission->ip_address)
            ->line('**Tarih:** ' . $this->submission->created_at->format('d.m.Y H:i'))
            ->action('Gönderimleri Görüntüle', url('/admin/forms/' . $this->form->id . '/submissions'));

        return $message;
    }

    public function toArray($notifiable): array
    {
        return [
            'form_id' => $this->form->id,
            'submission_id' => $this->submission->id,
        ];
    }
}

