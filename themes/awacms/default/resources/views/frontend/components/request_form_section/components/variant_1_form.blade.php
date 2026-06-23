{{-- HoneyPot'u SİLMEYİN veya adını DEĞİŞTİRMEYİN!--}}

<form class="request_form_v1_form" wire:submit="send">
    @honeypot
    <x-honeypot livewire-model="extraFields" />

    <div class="row g-3">
        <div class="col-md-6">
            <input
                class="request_form_v1_input"
                type="text"
                name="name"
                placeholder="Adınız Soyadınız *"
                wire:model="name"
                required
            />
        </div>

        <div class="col-md-6">
            <input
                class="request_form_v1_input"
                type="email"
                name="email"
                placeholder="E-Posta Adresiniz *"
                wire:model="email"
                required
            />
        </div>

        <div class="col-md-6">
            <input
                class="request_form_v1_input"
                type="tel"
                name="phone"
                placeholder="Telefon Numaranız"
                wire:model="phone"
            />
        </div>

        <div class="col-md-6">
            <label for="topic_v1" class="visually-hidden">Konu</label>
            <select
                class="request_form_v1_input"
                name="topic"
                id="topic_v1"
                wire:model="topic"
            >
                <option value="">Konu Seçiniz</option>
                @foreach($topics as $topic)
                    <option value="{{ $topic['title'] }}">{{ $topic['title'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <textarea
                class="request_form_v1_textarea"
                name="message"
                placeholder="Mesajınız"
                rows="4"
                wire:model="message"
            ></textarea>
        </div>

        <div class="col-12">
            <button
                type="submit"
                class="request_form_v1_button"
                wire:loading.attr="disabled"
                wire:target="send"
            >
                <span wire:loading.remove wire:target="send">{{ $buttonText }}</span>
                <span wire:loading wire:target="send">Gönderiliyor...</span>
            </button>
        </div>
    </div>

    @session('request_form_error')
    <div class="request_form_v1_alert request_form_v1_alert_error mt-3">
        {{$value}}
    </div>
    @endsession

    @session('request_form_success')
    <div class="request_form_v1_alert request_form_v1_alert_success mt-3">
        {{$value}}
    </div>
    @endsession
</form>
