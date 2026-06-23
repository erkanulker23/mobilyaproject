{{-- Kalyon Projeler bölümü — props: $title,$subtitle,$eyebrow,$projects,$showFilter,$buttonText,$buttonUrl,$bgColor --}}
<section id="projeler" class="kal-section" style="position:relative;background:{{ $bgColor ?: '#F4EFE7' }};padding:130px 0">
    <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
        <div data-reveal style="opacity:0;display:flex;align-items:flex-end;justify-content:space-between;gap:30px;flex-wrap:wrap;margin-bottom:40px">
            <div>
                @if($eyebrow)<div style="display:flex;align-items:center;gap:13px;margin-bottom:18px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">{{ $eyebrow }}</span></div>@endif
                <h2 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(32px,3.5vw,56px);line-height:1.04;letter-spacing:-.02em;color:#2B2926;max-width:16ch">{{ $title }}</h2>
                @if($subtitle)<p style="margin-top:14px;font-size:16px;color:#5A5349;max-width:54ch">{{ $subtitle }}</p>@endif
            </div>
            @if($showFilter)
            <div style="display:flex;gap:10px;flex-wrap:wrap">
                <button data-filterbtn="all" style="font-family:'Manrope',sans-serif;font-size:13px;font-weight:700;color:#fff;background:#2B2926;border:1px solid #2B2926;padding:11px 22px;border-radius:30px;cursor:pointer;transition:all .3s">Tümü</button>
                <button data-filterbtn="devam" style="font-family:'Manrope',sans-serif;font-size:13px;font-weight:700;color:#2B2926;background:transparent;border:1px solid #C9BFAD;padding:11px 22px;border-radius:30px;cursor:pointer;transition:all .3s">Devam Eden</button>
                <button data-filterbtn="tamam" style="font-family:'Manrope',sans-serif;font-size:13px;font-weight:700;color:#2B2926;background:transparent;border:1px solid #C9BFAD;padding:11px 22px;border-radius:30px;cursor:pointer;transition:all .3s">Tamamlanan</button>
            </div>
            @endif
        </div>

        <div data-grid class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px">
            @forelse($projects as $i => $p)
                <article data-reveal data-rd="{{ ($i % 3) * 0.08 }}" data-card data-cat="{{ $p->category_filter }} {{ $p->status }}" style="opacity:0;position:relative;aspect-ratio:4/3.4;overflow:hidden;border-radius:14px;background:#0c1018;cursor:pointer">
                    <a href="{{ route('projects.show', $p->slug) }}" style="position:absolute;inset:0;z-index:6" aria-label="{{ $p->title }}"></a>
                    <div style="position:absolute;inset:0;transition:transform 1s cubic-bezier(.16,1,.3,1)" style-hover="transform:scale(1.06)"><img src="{{ $p->cover_url }}" alt="{{ $p->title }}" style="width:100%;height:100%;object-fit:cover"></div>
                    <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(5,12,22,.1) 0%,transparent 32%,rgba(5,12,22,.92))"></div>
                    @if($p->category_label)<div style="position:absolute;top:16px;left:16px;font-size:10.5px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:#fff;background:rgba(43,41,38,.85);padding:7px 13px;border-radius:20px">{{ $p->category_label }}</div>@endif
                    <div style="position:absolute;top:16px;right:16px;display:flex;gap:7px">
                        <span style="font-size:9.5px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;color:#fff;background:{{ $p->status_color }};padding:7px 11px;border-radius:20px">{{ $p->status_label }}</span>
                        @if($p->is_sale)<span style="font-size:9.5px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;color:#fff;background:#D63A3A;padding:7px 11px;border-radius:20px">Satışta</span>@endif
                    </div>
                    <div style="position:absolute;left:22px;right:22px;bottom:22px"><h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:24px;color:#fff;line-height:1.1">{{ $p->title }}</h3><div style="font-size:13px;color:rgba(255,255,255,.72);margin-top:6px">{{ $p->location }}</div></div>
                </article>
            @empty
                <p style="color:#6A6358;grid-column:1/-1">Henüz proje eklenmemiş.</p>
            @endforelse
        </div>

        <div data-reveal style="opacity:0;display:flex;justify-content:center;margin-top:48px">
            <a href="{{ $buttonUrl ?: route('projects.index') }}" style="display:inline-flex;align-items:center;gap:11px;background:#D97757;color:#fff;font-weight:700;font-size:14px;padding:16px 32px;text-decoration:none;transition:all .35s cubic-bezier(.16,1,.3,1)" style-hover="background:#C2603F;transform:translateY(-3px);box-shadow:0 16px 40px rgba(217,119,87,.4)">{{ $buttonText ?: 'Tüm Projeler' }} <span style="font-size:16px">→</span></a>
        </div>
    </div>
</section>
