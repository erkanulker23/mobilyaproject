@extends('frontend.layouts.app')

@push('metas')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Bizimle iletişime geçin. Sorularınız, önerileriniz ve teklif talepleriniz için en kısa sürede size dönüş yapıyoruz.">
    <meta name="keywords" content="iletişim, contact, adres, telefon, e-posta, Kalyon İnşaat">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="İletişim">
    <meta property="og:description" content="Bizimle iletişime geçin. Projeniz için en kısa sürede size dönüş yapıyoruz.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')
@php
    $phone         = kalyon_setting('phone', '+90 212 000 00 00');
    $email         = kalyon_setting('email', 'info@kalyoninsaat.com');
    $address       = kalyon_setting('address', 'Maslak, Sarıyer, İstanbul, Türkiye');
    $whatsapp      = kalyon_setting('whatsapp');
    $workingHours  = kalyon_setting('working_hours', 'Pzt – Cuma · 09:00 – 18:00');
    $mapEmbed      = kalyon_setting('address_google_maps_embed');
    $phoneHref     = preg_replace('/[^0-9+]/', '', $phone);
    $whatsappHref  = $whatsapp ? preg_replace('/[^0-9]/', '', $whatsapp) : null;
@endphp

<div style="font-family:'Manrope',system-ui,sans-serif;color:#1F1C18;background:#fff">

    @include('frontend.partials.page-hero', [
        'eyebrow' => 'İletişim',
        'title' => 'Projenizi birlikte konuşalım',
        'subtitle' => 'Yeni bir proje, iş birliği veya teklif talebi — ekibimiz en kısa sürede size dönüş yapar.',
        'breadcrumbs' => ['İletişim' => null],
    ])

    {{-- HIZLI İLETİŞİM KARTLARI --}}
    <section style="background:#fff;position:relative;z-index:5;margin-top:-44px">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div class="kal-grid-4" style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px">
                <div data-reveal style="opacity:0;background:#fff;border:1px solid #E6E0D4;border-radius:14px;padding:30px 28px;box-shadow:0 18px 44px rgba(43,41,38,.07)">
                    <div style="width:48px;height:48px;display:flex;align-items:center;justify-content:center;background:#F7EAE2;color:#D97757;font-size:20px;border-radius:11px;margin-bottom:18px">✆</div>
                    <div style="font-size:12px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#8B8273">Telefon</div>
                    <a href="tel:{{ $phoneHref }}" style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:18px;color:#2B2926;margin-top:5px;display:block;text-decoration:none;transition:color .3s" style-hover="color:#D97757">{{ $phone }}</a>
                </div>
                <div data-reveal data-rd="0.06" style="opacity:0;background:#fff;border:1px solid #E6E0D4;border-radius:14px;padding:30px 28px;box-shadow:0 18px 44px rgba(43,41,38,.07)">
                    <div style="width:48px;height:48px;display:flex;align-items:center;justify-content:center;background:#F7EAE2;color:#D97757;font-size:20px;border-radius:11px;margin-bottom:18px">✉</div>
                    <div style="font-size:12px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#8B8273">E-posta</div>
                    <a href="mailto:{{ $email }}" style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:18px;color:#2B2926;margin-top:5px;display:block;text-decoration:none;word-break:break-word;transition:color .3s" style-hover="color:#D97757">{{ $email }}</a>
                </div>
                <div data-reveal data-rd="0.12" style="opacity:0;background:#fff;border:1px solid #E6E0D4;border-radius:14px;padding:30px 28px;box-shadow:0 18px 44px rgba(43,41,38,.07)">
                    <div style="width:48px;height:48px;display:flex;align-items:center;justify-content:center;background:#F7EAE2;color:#D97757;font-size:20px;border-radius:11px;margin-bottom:18px">⌖</div>
                    <div style="font-size:12px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#8B8273">Adres</div>
                    <div style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:15.5px;color:#2B2926;margin-top:5px;line-height:1.5">{{ $address }}</div>
                </div>
                <div data-reveal data-rd="0.18" style="opacity:0;background:#fff;border:1px solid #E6E0D4;border-radius:14px;padding:30px 28px;box-shadow:0 18px 44px rgba(43,41,38,.07)">
                    <div style="width:48px;height:48px;display:flex;align-items:center;justify-content:center;background:#F7EAE2;color:#D97757;font-size:20px;border-radius:11px;margin-bottom:18px">⌚</div>
                    <div style="font-size:12px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#8B8273">Çalışma Saatleri</div>
                    <div style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:16px;color:#2B2926;margin-top:5px;line-height:1.5">{{ $workingHours }}</div>
                </div>
            </div>
        </div>
    </section>

    {{-- FORM + DETAY --}}
    <section class="kal-section" style="background:#fff;padding:80px 0 110px">
        <div class="kal-pad kal-split" style="max-width:1340px;margin:0 auto;padding:0 52px;display:grid;grid-template-columns:1.2fr 1fr;gap:54px;align-items:start">

            {{-- FORM --}}
            <div data-reveal style="opacity:0">
                @if(session('success'))
                    <div style="display:flex;align-items:flex-start;gap:12px;background:#E8F5EF;border:1px solid #BFE4D4;border-radius:12px;padding:16px 20px;margin-bottom:22px">
                        <span style="flex:none;width:24px;height:24px;display:flex;align-items:center;justify-content:center;background:#1F9D6B;color:#fff;border-radius:50%;font-size:13px;font-weight:700">✓</span>
                        <span style="font-size:14.5px;line-height:1.55;color:#1F6B4B;font-weight:600">{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div style="display:flex;align-items:flex-start;gap:12px;background:#FBEDEA;border:1px solid #F1C9BF;border-radius:12px;padding:16px 20px;margin-bottom:22px">
                        <span style="flex:none;width:24px;height:24px;display:flex;align-items:center;justify-content:center;background:#D63A3A;color:#fff;border-radius:50%;font-size:13px;font-weight:700">!</span>
                        <span style="font-size:14.5px;line-height:1.55;color:#B23A2B;font-weight:600">{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="post" style="display:flex;flex-direction:column;gap:20px;background:#fff;border:1px solid #E6E0D4;border-radius:16px;padding:44px 40px;box-shadow:0 20px 50px rgba(43,41,38,.05)">
                    @csrf
                    <x-honeypot />

                    <h2 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:26px;color:#2B2926;letter-spacing:-.01em">Bize yazın</h2>
                    <p style="font-size:14.5px;line-height:1.6;color:#6A6358;margin-top:-8px">Aşağıdaki formu doldurun, ekibimiz en kısa sürede sizinle iletişime geçsin.</p>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px" class="kal-split">
                        <div style="display:flex;flex-direction:column;gap:8px">
                            <label for="name" style="font-size:12px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#8B8273">Ad Soyad</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Adınız Soyadınız" required style="padding:14px 16px;border:1px solid #E6E0D4;border-radius:9px;font-size:15px;color:#1F1C18;background:#fff;transition:border-color .3s">
                            @error('name')<span style="font-size:12.5px;color:#D63A3A;font-weight:600">{{ $message }}</span>@enderror
                        </div>
                        <div style="display:flex;flex-direction:column;gap:8px">
                            <label for="phone" style="font-size:12px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#8B8273">Telefon</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="05__ ___ __ __" required style="padding:14px 16px;border:1px solid #E6E0D4;border-radius:9px;font-size:15px;color:#1F1C18;background:#fff;transition:border-color .3s">
                            @error('phone')<span style="font-size:12.5px;color:#D63A3A;font-weight:600">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div style="display:flex;flex-direction:column;gap:8px">
                        <label for="email" style="font-size:12px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#8B8273">E-posta</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ornek@firma.com" required style="padding:14px 16px;border:1px solid #E6E0D4;border-radius:9px;font-size:15px;color:#1F1C18;background:#fff;transition:border-color .3s">
                        @error('email')<span style="font-size:12.5px;color:#D63A3A;font-weight:600">{{ $message }}</span>@enderror
                    </div>

                    <div style="display:flex;flex-direction:column;gap:8px">
                        <label for="message" style="font-size:12px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#8B8273">Mesajınız</label>
                        <textarea id="message" name="message" rows="4" placeholder="Bize projenizden bahsedin…" required style="padding:14px 16px;border:1px solid #E6E0D4;border-radius:9px;font-size:15px;color:#1F1C18;background:#fff;resize:vertical;transition:border-color .3s">{{ old('message') }}</textarea>
                        @error('message')<span style="font-size:12.5px;color:#D63A3A;font-weight:600">{{ $message }}</span>@enderror
                    </div>

                    <button type="submit" style="align-self:flex-start;display:inline-flex;align-items:center;gap:12px;background:#D97757;color:#fff;font-weight:700;font-size:14px;letter-spacing:.4px;padding:18px 36px;border:none;border-radius:9px;cursor:pointer;transition:all .35s cubic-bezier(.16,1,.3,1)" style-hover="background:#C2603F;transform:translateY(-3px);box-shadow:0 16px 40px rgba(217,119,87,.3)">Mesajı Gönder <span style="font-size:16px">→</span></button>
                </form>
            </div>

            {{-- HARİTA + KISA AKSİYON --}}
            @php $workingHours = kalyon_setting('working_hours'); @endphp
            <div data-reveal data-rd="0.1" style="opacity:0;display:flex;flex-direction:column;gap:22px">
                @if($mapEmbed)
                    <div style="position:relative;border-radius:16px;overflow:hidden;border:1px solid #E6E0D4;background:#F0EAE0">
                        <style>.kal-map-embed iframe{width:100%;height:420px;border:0;display:block}</style>
                        <div class="kal-map-embed">{!! $mapEmbed !!}</div>
                    </div>
                @else
                    <div style="position:relative;height:300px;border-radius:16px;overflow:hidden;border:1px solid #E6E0D4;background:linear-gradient(135deg,#2B2926,#3B342D);display:flex;align-items:center;justify-content:center">
                        <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(217,119,87,.12) 1px,transparent 1px),linear-gradient(90deg,rgba(217,119,87,.12) 1px,transparent 1px);background-size:34px 34px"></div>
                        <div style="position:absolute;left:0;top:50%;width:100%;height:16px;background:rgba(217,119,87,.18);transform:rotate(-5deg)"></div>
                        <div style="position:absolute;left:38%;top:0;width:14px;height:100%;background:rgba(217,119,87,.14)"></div>
                        <div style="position:relative;display:flex;flex-direction:column;align-items:center;gap:14px;text-align:center;padding:24px">
                            <span style="display:flex;align-items:center;justify-content:center;width:54px;height:54px;border-radius:50%;background:#D97757;color:#fff;font-size:22px;box-shadow:0 0 0 10px rgba(217,119,87,.22)"><i class="fa-solid fa-location-dot"></i></span>
                            <div style="font-size:11px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:#EAC1AC">Genel Merkez</div>
                            <div style="font-size:15px;font-weight:600;color:#fff;max-width:34ch;line-height:1.5">{{ $address }}</div>
                        </div>
                    </div>
                @endif

                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px">
                    @if($workingHours)
                    <div style="padding:24px;border:1px solid #E6E0D4;border-radius:14px;background:#fff">
                        <div style="width:44px;height:44px;display:flex;align-items:center;justify-content:center;background:#F7EAE2;color:#D97757;font-size:18px;border-radius:10px"><i class="fa-regular fa-clock"></i></div>
                        <div style="font-size:12px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#8B8273;margin-top:16px">Çalışma Saatleri</div>
                        <div style="font-size:15px;font-weight:600;color:#2B2926;margin-top:5px;line-height:1.6">{{ $workingHours }}</div>
                    </div>
                    @endif
                    <a href="tel:{{ $phoneHref }}" style="padding:24px;border:1px solid #E6E0D4;border-radius:14px;background:#fff;text-decoration:none;transition:all .35s cubic-bezier(.16,1,.3,1)" style-hover="border-color:#D97757;transform:translateY(-4px);box-shadow:0 18px 40px rgba(43,41,38,.08)">
                        <div style="width:44px;height:44px;display:flex;align-items:center;justify-content:center;background:#F7EAE2;color:#D97757;font-size:18px;border-radius:10px"><i class="fa-solid fa-phone-volume"></i></div>
                        <div style="font-size:12px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#8B8273;margin-top:16px">Hemen Arayın</div>
                        <div style="font-size:17px;font-weight:700;color:#2B2926;margin-top:5px">{{ $phone }}</div>
                    </a>
                </div>

                @if($whatsappHref)
                    <a href="https://wa.me/{{ $whatsappHref }}" target="_blank" rel="noopener" style="display:flex;align-items:center;justify-content:center;gap:11px;padding:18px;background:#1F9D6B;color:#fff;font-weight:700;font-size:15px;border-radius:12px;text-decoration:none;transition:all .3s" style-hover="background:#198257;transform:translateY(-2px)"><i class="fa-brands fa-whatsapp" style="font-size:19px"></i> WhatsApp ile Yazın</a>
                @endif
            </div>
        </div>
    </section>

    @if(count($branches) > 0)
    {{-- ŞUBELER --}}
    <section class="kal-section" style="background:#F4EFE7;padding:90px 0">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div style="display:flex;align-items:center;gap:13px;margin-bottom:22px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">Ofislerimiz</span></div>
            <h2 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(26px,2.8vw,42px);color:#2B2926;margin-bottom:36px">Şubelerimiz</h2>
            <div class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px">
                @foreach($branches as $i => $branch)
                    <div data-reveal data-rd="{{ ($i % 3) * 0.08 }}" style="opacity:0;background:#fff;border:1px solid #E6E0D4;border-radius:14px;padding:30px 28px">
                        <h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:19px;color:#2B2926;margin-bottom:14px">{{ $branch->name }}</h3>
                        <div style="display:flex;flex-direction:column;gap:8px;font-size:14px;line-height:1.55;color:#5A5349">
                            @if($branch->address)<div>⌖ {{ $branch->address }}</div>@endif
                            @if($branch->country || $branch->city)<div>📍 {{ trim(($branch->country ?? '') . ' / ' . ($branch->city ?? ''), ' /') }}</div>@endif
                            @if($branch->whatsapp)<div>✆ {{ $branch->whatsapp }}</div>@endif
                            @if($branch->fax)<div>☎ {{ $branch->fax }}</div>@endif
                            @if($branch->email)<div>✉ {{ $branch->email }}</div>@endif
                        </div>
                        @if($branch->link)
                            <a href="{{ $branch->link }}" target="_blank" rel="noopener" style="display:inline-block;margin-top:18px;font-size:13.5px;font-weight:700;color:#D97757;text-decoration:none;border-bottom:2px solid #D97757;padding-bottom:4px">Haritada Görüntüle →</a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</div>
@endsection

@push('scripts')
    @include('frontend.components.schema.organization')
@endpush
