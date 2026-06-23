{{-- HoneyPot'u SİLMEYİN veya adını DEĞİŞTİRMEYİN!--}}

<form class="request_form_v2_form" wire:submit="send">
    @honeypot
    <x-honeypot livewire-model="extraFields" />

    <div class="request_form_v2_fields">
        <input
            class="request_form_v2_input"
            type="text"
            name="name"
            placeholder="Adınız Soyadınız *"
            wire:model="name"
            required
        />

        <input
            class="request_form_v2_input"
            type="email"
            name="email"
            placeholder="E-Posta Adresiniz *"
            wire:model="email"
            required
        />

        <input
            class="request_form_v2_input"
            type="tel"
            name="phone"
            placeholder="Telefon Numaranız"
            wire:model="phone"
        />

        <label for="topic_v2" class="visually-hidden">Konu</label>
        <select
            class="request_form_v2_input"
            name="topic"
            id="topic_v2"
            wire:model="topic"
        >
            <option value="">Konu Seçiniz</option>
            @foreach($topics as $topic)
                <option value="{{ $topic['title'] }}">{{ $topic['title'] }}</option>
            @endforeach
        </select>

        <textarea
            class="request_form_v2_textarea"
            name="message"
            placeholder="Mesajınız"
            rows="4"
            wire:model="message"
        ></textarea>

        <button
            type="submit"
            class="request_form_v2_button"
            wire:loading.attr="disabled"
            wire:target="send"
        >
            <span wire:loading.remove wire:target="send">{{ $buttonText }}</span>
            <span wire:loading wire:target="send">Gönderiliyor...</span>
        </button>
    </div>

    @session('request_form_error')
    <div class="request_form_v2_alert request_form_v2_alert_error">
        {{$value}}
    </div>
    @endsession

    @session('request_form_success')
    <div class="request_form_v2_alert request_form_v2_alert_success">
        {{$value}}
    </div>
    @endsession
</form>
