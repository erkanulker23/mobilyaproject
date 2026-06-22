@extends('frontend.layout')

@section('title', ($L === 'tr' ? 'İletişim' : 'Contact') . ' — AWA Mobilya')

@section('content')
<div class="page">
    <section class="wrap page-hero">
        <span class="kicker">{{ $L === 'tr' ? 'İLETİŞİM' : 'CONTACT' }}</span>
        <h1 class="page-hero__title">{{ $L === 'tr' ? 'Bize ulaşın' : 'Get in touch' }}</h1>
    </section>

    <section class="section wrap" style="padding-top:24px">
        <div class="contact-grid">
            <div>
                @if(session('sent'))
                    <p class="alert-success">{{ $L === 'tr' ? 'Teşekkürler! En kısa sürede dönüş yapacağız.' : 'Thank you! We will get back to you shortly.' }}</p>
                @endif
                <form method="POST" action="{{ $route2('contact') }}" class="form-grid" style="margin-top:8px">
                    @csrf
                    <input class="field field--full" type="text" name="name" placeholder="{{ $L === 'tr' ? 'Ad Soyad' : 'Full name' }}">
                    <input class="field" type="email" name="email" placeholder="{{ $L === 'tr' ? 'E-posta' : 'E-mail' }}">
                    <input class="field" type="tel" name="phone" placeholder="{{ $L === 'tr' ? 'Telefon' : 'Phone' }}">
                    <textarea class="field field--full" name="message" rows="5" placeholder="{{ $L === 'tr' ? 'Mesajınız' : 'Your message' }}"></textarea>
                    <button class="btn btn--solid" type="submit">{{ $L === 'tr' ? 'Gönder' : 'Send' }}
                        <svg class="btn__arrow" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg>
                    </button>
                </form>
            </div>
            <dl class="contact-info">
                @if(!empty($settings['phone']))<dt>{{ $L === 'tr' ? 'Telefon' : 'Phone' }}</dt><dd><a href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}">{{ $settings['phone'] }}</a></dd>@endif
                @if(!empty($settings['email']))<dt>{{ $L === 'tr' ? 'E-posta' : 'E-mail' }}</dt><dd><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></dd>@endif
                <dt>{{ $L === 'tr' ? 'Adres' : 'Address' }}</dt><dd>{{ $pick($settings['addressTr'] ?? '', $settings['addressEn'] ?? '') }}</dd>
                @if(!empty($settings['hoursTr']))<dt>{{ $L === 'tr' ? 'Çalışma saatleri' : 'Working hours' }}</dt><dd>{{ $pick($settings['hoursTr'] ?? '', $settings['hoursEn'] ?? '') }}</dd>@endif
            </dl>
        </div>
    </section>
</div>
@endsection
