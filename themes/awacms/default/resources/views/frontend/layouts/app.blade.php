@extends('layouts.master')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @php
        $kalCssV = @filemtime(base_path('themes/awacms/default/public/css/kalyon.css')) ?: '1';
        $kalJsV = @filemtime(base_path('themes/awacms/default/public/js/kalyon.js')) ?: '1';
    @endphp
    <link rel="stylesheet" href="{{ theme_asset('css/kalyon.css') }}?v={{ $kalCssV }}">
    <script defer src="{{ theme_asset('js/kalyon.js') }}?v={{ $kalJsV }}"></script>
@endsection

@section('body')
    {{-- floating contact rail --}}
    <div style="position:fixed;right:22px;bottom:24px;z-index:1200;display:flex;flex-direction:column;gap:12px">
        <a href="{{ kalyon_setting('whatsapp_url', 'https://wa.me/902120000000') }}" target="_blank" rel="noopener" aria-label="WhatsApp" style="display:flex;align-items:center;justify-content:center;width:56px;height:56px;border-radius:50%;background:#25D366;color:#fff;font-size:26px;text-decoration:none;box-shadow:0 10px 30px rgba(37,211,102,.4);transition:transform .35s cubic-bezier(.16,1,.3,1)" style-hover="transform:scale(1.1) translateY(-2px)">✆</a>
        <a href="{{ route('contact.index') }}" aria-label="İletişim" style="display:flex;align-items:center;justify-content:center;width:56px;height:56px;border-radius:50%;background:#2B2926;color:#fff;font-size:22px;text-decoration:none;box-shadow:0 10px 30px rgba(43,41,38,.35);transition:transform .35s cubic-bezier(.16,1,.3,1)" style-hover="transform:scale(1.1) translateY(-2px)">✉</a>
    </div>

    @include('frontend.partials.header')

    <main id="icerik">
        @yield('content')
    </main>

    @include('frontend.partials.footer')
@endsection
