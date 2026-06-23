<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Modules\Newsletter\Entities\NewsletterSubscriber;
use Modules\Newsletter\Notifications\VerifyYourNewsletterSubscriptionNotification;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class RequestForm extends Component
{
    use UsesSpamProtection;

    public string $name;

    public ?string $email;

    public string $phone;

    public ?string $date = null;

    public ?string $hour = null;

    public string $topic;

    public string $message;

    public HoneypotData $extraFields;

    public string $view;

    public array $topics;

    public string $buttonText;

    public function mount(string $view, array $topics = [], string $buttonText = 'Gönder')
    {
        $this->extraFields = new HoneypotData();
        $this->view = $view;
        $this->topics = $topics;
        $this->buttonText = $buttonText;
    }

    public function send(): void
    {
        $this->protectAgainstSpam();
        // google recaptcha validation
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:255',
            'date' => 'nullable|date',
            'hour' => 'nullable|string|max:255',
            'topic' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);

        if (RateLimiter::tooManyAttempts('request-form:'.request()->ip(), 3)) {
            session()->flash('request_form_error', 'Çok fazla deneme yaptınız. Lütfen bir süre sonra tekrar deneyin.');

            return;
        }

        RateLimiter::increment('request-form:'.request()->ip());

        if (\App\Models\RequestForm::where('phone', $this->phone)->where('created_at', '>=', now()->subMinutes(10))->exists()) {
            session()->flash('request_form_error', 'Bu telefon numarasıyla zaten yeni bir talep oluşturulmuş. Lütfen ekip arkadaşlarımızın size dönüş yapmasını bekleyin.');

            return;
        }

        $form = \App\Models\RequestForm::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'request_date' => $this->date && $this->hour ? Carbon::parse($this->date.' '.$this->hour) : now(),
            'topic' => $this->topic,
            'message' => $this->message,
        ]);

        $this->reset('name', 'phone', 'date', 'hour', 'topic', 'message');
        session()->flash('request_form_success', 'Talebiniz başarıyla alındı. Ekip arkadaşlarımız en kısa sürede size dönüş sağlayacaklardır.');
    }

    public function render()
    {
        return view($this->view,[
            'topics' => $this->topics,
            'buttonText' => $this->buttonText,
        ]);
    }
}
