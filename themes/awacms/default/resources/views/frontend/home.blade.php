@extends('frontend.layouts.app')

{{--
    Anasayfa tamamen "Anasayfa Düzenleyici" (admin → homepage-builder-page) üzerinden yönetilir.
    Bölümler, sıralama ve içerikler oradan düzenlenir; her blok bir Kalyon varyantına bağlıdır.
--}}

@section('content')
    @if(!empty($content) && is_array($content))
        @include('components.blocks_renderer', ['blocks' => $content])
    @else
        <section class="kal-section" style="padding:160px 0;text-align:center;background:#F4EFE7">
            <div class="kal-pad" style="max-width:700px;margin:0 auto;padding:0 24px">
                <h1 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(28px,4vw,48px);color:#2B2926">Anasayfa içeriği henüz ayarlanmadı</h1>
                <p style="margin-top:16px;color:#5A5349">Admin panel → <strong>Anasayfa Düzenleyici</strong> bölümünden bölümleri ekleyin.</p>
            </div>
        </section>
    @endif
@endsection
