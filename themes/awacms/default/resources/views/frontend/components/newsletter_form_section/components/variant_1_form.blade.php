{{--HoneyPot'u SİLMEYİN veya adını DEĞİŞTİRMEYİN!--}}

<form wire:submit="subscribe" class="newsletter_v1_form">
    <x-honeypot livewire-model="extraFields" />

    <div class="newsletter_v1_input_group">
        <input
            class="newsletter_v1_input"
            type="email"
            name="email"
            placeholder="E-posta adresinizi girin"
            wire:model="email"
            required
            aria-label="E-posta adresi"
        />
        <button
            type="submit"
            class="newsletter_v1_button"
            wire:loading.attr="disabled"
            wire:target="subscribe"
            aria-label="Abone ol"
        >
            <span wire:loading.remove wire:target="subscribe">Abone Ol</span>
            <span wire:loading wire:target="subscribe">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
        </button>
    </div>

    @session('newsletter_error')
    <div class="newsletter_v1_alert newsletter_v1_alert_error mt-3">
        <i class="fas fa-exclamation-circle"></i>
        {{$value}}
    </div>
    @endsession

    @session('newsletter_success')
    <div class="newsletter_v1_alert newsletter_v1_alert_success mt-3">
        <i class="fas fa-check-circle"></i>
        {{$value}}
    </div>
    @endsession
</form>
