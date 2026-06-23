@extends('frontend.layouts.app')

@section('content')
<div style="font-family:'Manrope',system-ui,sans-serif;color:#1F1C18;background:#fff">
    @include('frontend.partials.page-hero', [
        'eyebrow' => 'Dijital Kataloglar',
        'title' => 'Katalog ve dokümanlar',
        'subtitle' => 'Proje broşürlerimizi ve kurumsal kataloglarımızı inceleyip indirebilirsiniz.',
        'breadcrumbs' => ['Kataloglar' => null],
    ])

    <section class="kal-section" style="background:#fff;padding:90px 0 120px">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px">
                @forelse($catalogs as $i => $cat)
                    <div data-reveal data-rd="{{ ($i % 3) * 0.08 }}" style="opacity:0;border:1px solid #E6E0D4;border-radius:16px;overflow:hidden;background:#fff;display:flex;flex-direction:column;transition:transform .4s cubic-bezier(.16,1,.3,1),box-shadow .4s" style-hover="transform:translateY(-8px);box-shadow:0 24px 50px rgba(43,41,38,.12)">
                        <div style="aspect-ratio:3/4;overflow:hidden;background:#F0EAE0;position:relative">
                            <img src="{{ $cat->cover_url }}" alt="{{ $cat->title }}" style="width:100%;height:100%;object-fit:cover">
                            @if($cat->year)<span style="position:absolute;top:14px;left:14px;font-size:11px;font-weight:700;color:#fff;background:rgba(43,41,38,.85);padding:6px 12px;border-radius:20px">{{ $cat->year }}</span>@endif
                        </div>
                        <div style="padding:24px;display:flex;flex-direction:column;flex:1">
                            <h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:19px;color:#2B2926">{{ $cat->title }}</h3>
                            @if($cat->description)<p style="margin-top:10px;font-size:14px;line-height:1.6;color:#6A6358;flex:1">{{ \Illuminate\Support\Str::limit($cat->description, 110) }}</p>@endif
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:20px;gap:12px">
                                <span style="font-size:12px;color:#8B8273">{{ $cat->file_size ? 'PDF · '.$cat->file_size : 'PDF' }}</span>
                                @if($cat->file_url)
                                    <a href="{{ $cat->file_url }}" target="_blank" rel="noopener" style="display:inline-flex;align-items:center;gap:8px;background:#D97757;color:#fff;font-weight:700;font-size:13px;padding:11px 18px;text-decoration:none;border-radius:8px;transition:all .3s" style-hover="background:#C2603F">İndir ↓</a>
                                @else
                                    <span style="font-size:12px;color:#B0A795">Yakında</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="color:#6A6358;grid-column:1/-1">Henüz katalog eklenmemiş. Admin panelinden <strong>Kataloglar</strong> bölümünden ekleyebilirsiniz.</p>
                @endforelse
            </div>

            <div style="margin-top:60px;background:#2B2926;border-radius:18px;padding:48px;display:flex;align-items:center;justify-content:space-between;gap:30px;flex-wrap:wrap">
                <div>
                    <h3 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(22px,2.4vw,32px);color:#fff">Aradığınız dokümanı bulamadınız mı?</h3>
                    <p style="margin-top:10px;font-size:15px;color:rgba(255,255,255,.7);max-width:50ch">Özel proje sunumları ve detaylı teknik dokümanlar için bizimle iletişime geçin.</p>
                </div>
                <a href="{{ route('contact.index') }}" style="display:inline-flex;align-items:center;gap:10px;background:#D97757;color:#fff;font-weight:700;font-size:14px;padding:17px 30px;text-decoration:none;white-space:nowrap;transition:all .3s" style-hover="background:#C2603F;transform:translateY(-2px)">Talep Oluştur →</a>
            </div>
        </div>
    </section>
</div>
@endsection
