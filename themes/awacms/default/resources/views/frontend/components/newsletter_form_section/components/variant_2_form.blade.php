{{--HoneyPot'u SİLMEYİN veya adını DEĞİŞTİRMEYİN!--}}

<form wire:submit="subscribe" class="newsletter_v2_form">
    <x-honeypot livewire-model="extraFields" />

    <div class="newsletter_v2_form_group">
        <label for="newsletter-email-2" class="newsletter_v2_label">E-posta Adresiniz</label>
        <div class="newsletter_v2_input_wrapper">
            <input
                id="newsletter-email-2"
                class="newsletter_v2_input"
                type="email"
                name="email"
                placeholder="ornek@email.com"
                wire:model="email"
                required
                aria-label="E-posta adresi"
            />
            <button
                type="submit"
                class="newsletter_v2_button"
                wire:loading.attr="disabled"
                wire:target="subscribe"
                aria-label="Abone ol"
            >
                <span wire:loading.remove wire:target="subscribe">
                    Abone Ol
                    <i class="fas fa-arrow-right ms-2"></i>
                </span>
                <span wire:loading wire:target="subscribe">
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
            </button>
        </div>
    </div>

    @session('newsletter_error')
    <div class="newsletter_v2_alert newsletter_v2_alert_error mt-3">
        <i class="fas fa-exclamation-circle"></i>
        {{$value}}
    </div>
    @endsession

    @session('newsletter_success')
    <div class="newsletter_v2_alert newsletter_v2_alert_success mt-3">
        <i class="fas fa-check-circle"></i>
        {{$value}}
    </div>
    @endsession
</form>

