{{-- HoneyPot'u SİLMEYİN veya adını DEĞİŞTİRMEYİN!--}}

<form class="request_form_v6_form" wire:submit="send">
    @honeypot
    <x-honeypot livewire-model="extraFields" />

    <input class="request_form_v6_input" type="text" name="name" placeholder="Adınız Soyadınız" wire:model="name" required />
    <input class="request_form_v6_input" type="email" name="email" placeholder="E-Posta" wire:model="email" required />
    <input class="request_form_v6_input" type="tel" name="phone" placeholder="Telefon" wire:model="phone" />
    <label for="topic_v6" class="visually-hidden">Konu</label>
    <select class="request_form_v6_input" name="topic" id="topic_v6" wire:model="topic">
        <option value="">Konu</option>
        @foreach($topics as $topic)
            <option value="{{ $topic['title'] }}">{{ $topic['title'] }}</option>
        @endforeach
    </select>
    <textarea class="request_form_v6_textarea" name="message" placeholder="Mesajınız" rows="4" wire:model="message"></textarea>
    <button type="submit" class="request_form_v6_button" wire:loading.attr="disabled" wire:target="send">
        <span wire:loading.remove wire:target="send">{{ $buttonText }}</span>
        <span wire:loading wire:target="send">Gönderiliyor...</span>
    </button>

    @session('request_form_error')
    <div class="request_form_v6_alert error mt-3">{{$value}}</div>
    @endsession
    @session('request_form_success')
    <div class="request_form_v6_alert success mt-3">{{$value}}</div>
    @endsession
</form>
