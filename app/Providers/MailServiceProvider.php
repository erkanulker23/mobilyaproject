<?php

namespace App\Providers;

use App\Settings\EmailSettings;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    public function boot()
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->greeting('Hoş geldiniz!')
                ->subject('Hesabınızı Onaylayın!')
                ->line('Aşağıdaki butona basarak hesabınızı onaylayabilirsiniz. Eğer bu aksiyonu siz gerçekletirmedi iseniz bu epostayı görmezden gelebilirsiniz.')
                ->action('Email Adresini Onayla', $url);
        });

        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->greeting('Merhaba, '.$notifiable->fullname)
                ->subject('Şifre Sıfırlama Bağlantısı')
                ->line('Şifre sıfırlama isteğinizi aldık. Aşağıdaki linke tıklayarak şifrenizi güncelleyebilirsiniz. Eğer bu aksiyonu siz gerçekletirmedi iseniz bu epostayı görmezden gelebilirsiniz.')
                ->action('Sıfırla', $url);
        });

        if (file_exists(storage_path('installed')) && (Schema::hasTable('settings') && ! App::environment('development'))) {
            $settings = app(EmailSettings::class);
            $config = [
                'mail.mailers.smtp.host' => $settings->host,
                'mail.mailers.smtp.port' => $settings->port,
                'mail.mailers.smtp.encryption' => $settings->encryption,
                'mail.mailers.smtp.username' => $settings->username,
                'mail.mailers.smtp.password' => $settings->password,
                'mail.from.address' => $settings->from_address,
                'mail.from.name' => $settings->from_name,
            ];

            config($config);
        }
    }
}
