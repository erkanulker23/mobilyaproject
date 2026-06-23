{{-- HoneyPot'u SİLMEYİN veya adını DEĞİŞTİRMEYİN!--}}

<form class="request_form_v7_form" wire:submit="send">
    @honeypot
    <x-honeypot livewire-model="extraFields" />

    <div class="row g-3">
        <div class="col-md-6"><input class="request_form_v7_input" type="text" name="name" placeholder="Adınız Soyadınız" wire:model="name" required /></div>
        <div class="col-md-6"><input class="request_form_v7_input" type="email" name="email" placeholder="E-Posta" wire:model="email" required /></div>
        <div class="col-md-6"><input class="request_form_v7_input" type="tel" name="phone" placeholder="Telefon" wire:model="phone" /></div>
        <div class="col-md-6">
            <label for="topic_v7" class="visually-hidden">Konu</label>
            <select class="request_form_v7_input" name="topic" id="topic_v7" wire:model="topic">
                <option value="">Konu</option>
                @foreach($topics as $topic)
                    <option value="{{ $topic['title'] }}">{{ $topic['title'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12"><textarea class="request_form_v7_textarea" name="message" placeholder="Mesajınız" rows="3" wire:model="message"></textarea></div>
        <div class="col-12">
            <button type="submit" class="request_form_v7_button" wire:loading.attr="disabled" wire:target="send">
                <span wire:loading.remove wire:target="send">{{ $buttonText }}</span>
                <span wire:loading wire:target="send">Gönderiliyor...</span>
            </button>
        </div>
    </div>

    @session('request_form_error')
    <div class="request_form_v7_alert error mt-3">{{$value}}</div>
    @endsession
    @session('request_form_success')
    <div class="request_form_v7_alert success mt-3">{{$value}}</div>
    @endsession
</form>
