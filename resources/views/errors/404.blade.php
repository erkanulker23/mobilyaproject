@extends('frontend.layouts.app')

@section('content')
<section style="position:relative;min-height:100vh;display:flex;align-items:center;justify-content:center;background:#2B2926;overflow:hidden;padding:140px 0 80px">
    {{-- arka plan grid + parıltı --}}
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(217,119,87,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(217,119,87,.06) 1px,transparent 1px);background-size:54px 54px;-webkit-mask-image:radial-gradient(75% 65% at 50% 45%,#000,transparent);mask-image:radial-gradient(75% 65% at 50% 45%,#000,transparent);pointer-events:none"></div>
    <div style="position:absolute;top:18%;left:50%;transform:translateX(-50%);width:520px;height:520px;background:radial-gradient(circle,rgba(217,119,87,.22),transparent 70%);pointer-events:none"></div>

    <div class="kal-pad" style="position:relative;max-width:780px;margin:0 auto;padding:0 24px;text-align:center">
        <div data-reveal style="opacity:0;display:inline-flex;align-items:center;gap:12px;margin-bottom:26px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12.5px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#EAC1AC">Sayfa Bulunamadı</span><span style="width:34px;height:1px;background:#D97757"></span></div>

        <h1 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(110px,22vw,240px);line-height:.9;letter-spacing:-.04em;color:#fff;text-shadow:0 10px 60px rgba(0,0,0,.4)">4<span style="color:#D97757">0</span>4</h1>

        <h2 data-reveal data-rd="0.1" style="opacity:0;font-family:'Plus Jakarta Sans';font-weight:700;font-size:clamp(22px,3vw,34px);color:#fff;margin-top:14px">Aradığınız sayfa inşa halinde olabilir</h2>
        <p data-reveal data-rd="0.18" style="opacity:0;margin:18px auto 0;max-width:48ch;font-size:16.5px;line-height:1.7;color:rgba(255,255,255,.7)">Aradığınız sayfa taşınmış, kaldırılmış ya da hiç var olmamış olabilir. Sizi doğru yere yönlendirelim.</p>

        <div data-reveal data-rd="0.26" style="opacity:0;display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:38px">
            <a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:11px;background:#D97757;color:#fff;font-weight:700;font-size:14px;padding:17px 32px;text-decoration:none;transition:all .35s cubic-bezier(.16,1,.3,1)" style-hover="background:#C2603F;transform:translateY(-3px);box-shadow:0 16px 40px rgba(217,119,87,.4)"><i class="fa-solid fa-arrow-left"></i> Ana Sayfaya Dön</a>
            <a href="{{ route('projects.index') }}" style="display:inline-flex;align-items:center;gap:11px;background:rgba(255,255,255,.08);color:#fff;font-weight:700;font-size:14px;padding:17px 32px;text-decoration:none;border:1px solid rgba(255,255,255,.3);transition:all .35s" style-hover="background:rgba(255,255,255,.16);transform:translateY(-3px)">Projelerimizi İncele</a>
        </div>

        <div data-reveal data-rd="0.34" style="opacity:0;display:flex;gap:8px 26px;justify-content:center;flex-wrap:wrap;margin-top:46px;padding-top:30px;border-top:1px solid rgba(255,255,255,.1)">
            @foreach([['Hakkımızda', route('page.show', 'hakkimizda')],['Hizmetler', route('services.index')],['Kataloglar', route('catalogs.index')],['Haberler', route('blog.index')],['İletişim', route('contact.index')]] as $l)
                <a href="{{ $l[1] }}" style="font-size:14px;font-weight:600;color:rgba(255,255,255,.65);text-decoration:none;transition:color .3s" style-hover="color:#E0A488">{{ $l[0] }}</a>
            @endforeach
        </div>
    </div>
</section>
@endsection
