<?php

namespace App\Livewire;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Newsletter\Entities\NewsletterSubscriber;
use Modules\Newsletter\Notifications\VerifyYourNewsletterSubscriptionNotification;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class NewsletterForm extends Component
{
    use UsesSpamProtection;

    public string $email;

    public string $view;

    public HoneypotData $extraFields;

    public function mount(string $view)
    {
        $this->extraFields = new HoneypotData();
        $this->view = $view;
    }

    public function subscribe(): void
    {
        $this->protectAgainstSpam();

        // google recaptcha validation
        $this->validate([
            'email' => [
                'required',
                'email',
            ],
        ]);

        if (RateLimiter::tooManyAttempts('newsletter-form:'.request()->ip(), 3)) {
            session()->flash('newsletter_error', 'Çok fazla deneme yaptınız. Lütfen bir süre sonra tekrar deneyin.');

            return;
        }

        RateLimiter::increment('newsletter-form:'.request()->ip());

        if (NewsletterSubscriber::where('email', $this->email)->whereIsActive(true)->exists()) {
            session()->flash('newsletter_error', 'Zaten haber bültenimize abone oldunuz.');

            return;
        }

        if (NewsletterSubscriber::where('email', $this->email)
            ->whereNot('is_active', true)
            ->where('created_at', '>=', now()->subMinutes(10))
            ->exists()) {
            session()->flash('newsletter_error', 'Bu e-posta adresiyle zaten yeni bir abonelik oluşturulmuş. Lütfen e-posta adresinizi kontrol edin.');

            return;
        }

        $subscriber = NewsletterSubscriber::create([
            'email' => $this->email,
            'token' => Str::random(32),
        ]);

        $subscriber->notify(new VerifyYourNewsletterSubscriptionNotification($subscriber));

        $this->reset('email');
        session()->flash('newsletter_success', 'E-posta adresiniz başarıyla kaydedildi. Lütfen e-posta adresinizi onaylamak için e-posta kutunuzu kontrol edin.');
    }

    public function render()
    {
        return view($this->view);
    }
}
