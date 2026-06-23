@extends('frontend.layouts.app')

@php
    use App\Models\BlogPost;
    use Illuminate\Support\Str;

    $relatedPosts = collect($latestPosts ?? [])->take(3);
    if ($relatedPosts->count() === 0) {
        $relatedPosts = BlogPost::query()
            ->published()
            ->latest('publish_at')
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();
    }
@endphp

@push('head')
    <meta name="description" content="{{ $post->seoDescription ?? Str::limit(strip_tags($post->content), 160) }}">
    <meta name="keywords" content="{{ $post->categories?->pluck('name')->join(', ') }}">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->seoDescription ?? Str::limit(strip_tags($post->content), 160) }}">
    <meta property="og:image" content="{{ $post->listingImage }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ optional($post->publishAt)->format('c') }}">
@endpush

@section('content')
<div style="font-family:'Manrope',system-ui,sans-serif;color:#1F1C18;background:#fff">

    {{-- HERO --}}
    <section style="position:relative;background:#2B2926;min-height:56vh;display:flex;align-items:flex-end;overflow:hidden">
        <div style="position:absolute;inset:0"><img src="{{ $post->detailHero ?: $post->listingImage }}" alt="{{ $post->title }}" style="width:100%;height:100%;object-fit:cover;opacity:.5"></div>
        <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(28,26,23,.4),rgba(28,26,23,.93))"></div>
        <div class="kal-pad" style="position:relative;max-width:1340px;margin:0 auto;padding:0 52px 60px;width:100%">
            <div style="display:flex;align-items:center;gap:9px;flex-wrap:wrap;margin-bottom:20px;font-size:12.5px;color:rgba(255,255,255,.6)">
                <a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);text-decoration:none" style-hover="color:#E0A488">Ana Sayfa</a><span style="opacity:.5">/</span>
                <a href="{{ route('blog.index') }}" style="color:rgba(255,255,255,.6);text-decoration:none" style-hover="color:#E0A488">Haberler</a><span style="opacity:.5">/</span>
                <span style="color:#E0A488">{{ $post->title }}</span>
            </div>
            @if($post->category)
            <div style="display:inline-flex;margin-bottom:16px;font-size:10.5px;font-weight:700;letter-spacing:.7px;text-transform:uppercase;color:#fff;background:#D97757;padding:7px 14px;border-radius:20px">{{ $post->category->name }}</div>
            @endif
            <h1 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(30px,4vw,58px);line-height:1.05;letter-spacing:-.02em;color:#fff;max-width:22ch">{{ $post->title }}</h1>
            @if($post->publishAt)
            <p style="margin-top:16px;font-size:15px;color:rgba(255,255,255,.72)">{{ $post->publishAt->translatedFormat('d F Y') }}</p>
            @endif
        </div>
    </section>

    {{-- İÇERİK --}}
    <section class="kal-section" style="background:#fff;padding:90px 0">
        <div class="kal-pad" style="max-width:880px;margin:0 auto;padding:0 52px">
            @if($post->shortDescription)
                <p style="font-size:19px;line-height:1.7;color:#2B2926;font-weight:500;margin-bottom:30px;padding-bottom:30px;border-bottom:1px solid #E6E0D4">{{ strip_tags($post->shortDescription) }}</p>
            @endif

            <div class="kal-richtext" style="font-size:16.5px;line-height:1.9;color:#5A5349">
                {!! $post->content ?: '<p>Bu haber için içerik yakında eklenecektir.</p>' !!}
            </div>

            {{-- Paylaşım --}}
            <div style="margin-top:48px;padding-top:30px;border-top:1px solid #E6E0D4;display:flex;align-items:center;gap:14px;flex-wrap:wrap">
                <span style="font-size:13px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;color:#8B8273">Paylaş</span>
                <a href="https://linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener" aria-label="LinkedIn'da paylaş" style="display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;border-radius:50%;background:#F4EFE7;border:1px solid #E6E0D4;color:#2B2926;text-decoration:none;transition:all .3s" style-hover="background:#D97757;color:#fff;border-color:#D97757"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener" aria-label="Facebook'ta paylaş" style="display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;border-radius:50%;background:#F4EFE7;border:1px solid #E6E0D4;color:#2B2926;text-decoration:none;transition:all .3s" style-hover="background:#D97757;color:#fff;border-color:#D97757"><i class="fab fa-facebook-f"></i></a>
                <a href="https://x.com/intent/post?text={{ urlencode($post->title) }}&url={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener" aria-label="X'te paylaş" style="display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;border-radius:50%;background:#F4EFE7;border:1px solid #E6E0D4;color:#2B2926;text-decoration:none;transition:all .3s" style-hover="background:#D97757;color:#fff;border-color:#D97757"><i class="fab fa-x-twitter"></i></a>
                <a href="mailto:?subject={{ urlencode($post->title) }}&body={{ urlencode('Bu haberi okumanızı tavsiye ederim: '.request()->fullUrl()) }}" aria-label="E-posta ile paylaş" style="display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;border-radius:50%;background:#F4EFE7;border:1px solid #E6E0D4;color:#2B2926;text-decoration:none;transition:all .3s" style-hover="background:#D97757;color:#fff;border-color:#D97757"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </section>

    {{-- YORUMLAR --}}
    <section class="kal-section" style="background:#F4EFE7;padding:90px 0;border-top:1px solid #E6E0D4">
        <div class="kal-pad" style="max-width:880px;margin:0 auto;padding:0 52px">
            @php $comments = $post->comments; @endphp
            <h2 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(24px,2.6vw,36px);color:#2B2926;margin-bottom:8px">Yorumlar</h2>
            <p style="font-size:14px;color:#6A6358;margin-bottom:36px">{{ $comments ? $comments->count() : 0 }} yorum</p>

            {{-- Yorum formu --}}
            <div style="background:#fff;border:1px solid #E6E0D4;border-radius:16px;padding:32px 30px;margin-bottom:40px">
                <div style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:18px;color:#2B2926;margin-bottom:20px">Yorum Yap</div>
                <form id="kal-comment-form" method="POST" action="{{ route('blog.comments.store', $post->slug) }}" data-post-id="{{ $post->id }}">
                    @csrf
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px" class="kal-split">
                        <input type="text" name="fullname" placeholder="Adınız Soyadınız" required style="width:100%;padding:14px 16px;border:1px solid #E6E0D4;border-radius:10px;background:#F4EFE7;font-family:'Manrope',sans-serif;font-size:14.5px;color:#1F1C18;outline:none">
                        <input type="email" name="email" placeholder="E-posta Adresiniz" required style="width:100%;padding:14px 16px;border:1px solid #E6E0D4;border-radius:10px;background:#F4EFE7;font-family:'Manrope',sans-serif;font-size:14.5px;color:#1F1C18;outline:none">
                    </div>
                    <textarea name="comment" rows="4" placeholder="Yorumunuzu buraya yazın..." required style="width:100%;padding:14px 16px;border:1px solid #E6E0D4;border-radius:10px;background:#F4EFE7;font-family:'Manrope',sans-serif;font-size:14.5px;color:#1F1C18;outline:none;resize:vertical;margin-bottom:18px"></textarea>
                    <button type="submit" style="display:inline-flex;align-items:center;gap:10px;background:#D97757;color:#fff;font-family:'Manrope',sans-serif;font-weight:700;font-size:14px;padding:15px 30px;border:none;border-radius:10px;cursor:pointer;transition:background .3s" style-hover="background:#C2603F">Yorum Gönder →</button>
                    <div id="kal-comment-message" style="margin-top:16px;font-size:14px"></div>
                </form>
            </div>

            {{-- Yorum listesi --}}
            <div id="kal-comments-list" style="display:flex;flex-direction:column;gap:18px">
                @if($comments && $comments->count() > 0)
                    @foreach($comments as $comment)
                        @if($comment->is_approved)
                        <div style="background:#fff;border:1px solid #E6E0D4;border-radius:14px;padding:24px 26px">
                            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;margin-bottom:10px">
                                <div style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:15.5px;color:#2B2926">{{ $comment->fullname }}</div>
                                <div style="font-size:12.5px;color:#8B8273">{{ optional($comment->created_at)->format('d.m.Y H:i') }}</div>
                            </div>
                            <p style="font-size:15px;line-height:1.7;color:#5A5349;margin:0">{{ $comment->comment }}</p>

                            @if($comment->children && $comment->children->count() > 0)
                            <div style="margin-top:18px;padding-left:22px;border-left:3px solid #EAC1AC;display:flex;flex-direction:column;gap:14px">
                                @foreach($comment->children as $reply)
                                    @if($reply->is_approved)
                                    <div style="background:#F4EFE7;border-radius:10px;padding:16px 18px">
                                        <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;margin-bottom:7px">
                                            <div style="font-weight:700;font-size:14px;color:#2B2926">{{ $reply->fullname }}</div>
                                            <div style="font-size:12px;color:#8B8273">{{ optional($reply->created_at)->format('d.m.Y H:i') }}</div>
                                        </div>
                                        <p style="font-size:14px;line-height:1.65;color:#5A5349;margin:0">{{ $reply->comment }}</p>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endif
                    @endforeach
                @else
                    <div style="background:#fff;border:1px dashed #C9BFAD;border-radius:14px;padding:40px 24px;text-align:center">
                        <p style="font-size:15px;color:#6A6358;margin:0">Henüz yorum yapılmamış. İlk yorumu siz yapın.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- İLGİLİ HABERLER --}}
    @if($relatedPosts && count($relatedPosts) > 0)
    <section class="kal-section" style="background:#fff;padding:100px 0">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:36px;gap:20px;flex-wrap:wrap">
                <h2 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(26px,2.8vw,42px);color:#2B2926">İlgili Haberler</h2>
                <a href="{{ route('blog.index') }}" style="font-size:13.5px;font-weight:700;color:#D97757;text-decoration:none;border-bottom:2px solid #D97757;padding-bottom:5px">Tümünü Gör →</a>
            </div>
            <div class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px">
                @foreach($relatedPosts as $i => $rp)
                    @php
                        $rpSlug = data_get($rp, 'slug');
                        $rpTitle = data_get($rp, 'title', '');
                        $rpImage = data_get($rp, 'listingImage') ?: data_get($rp, 'detailImage');
                        if (! $rpImage && is_object($rp) && method_exists($rp, 'getFirstMediaUrl')) {
                            $rpImage = $rp->getFirstMediaUrl('listing_image') ?: $rp->getFirstMediaUrl('details_image');
                        }
                        $rpDate = data_get($rp, 'publishAt') ?? data_get($rp, 'publish_at');
                        $rpDesc = data_get($rp, 'shortDescription') ?? data_get($rp, 'short_description', '');
                    @endphp
                    <a data-reveal data-rd="{{ ($i % 3) * 0.08 }}" href="{{ route('blog.post.show', $rpSlug) }}" style="opacity:0;text-decoration:none;background:#fff;border:1px solid #E6E0D4;border-radius:14px;overflow:hidden;transition:transform .4s cubic-bezier(.16,1,.3,1),box-shadow .4s" style-hover="transform:translateY(-8px);box-shadow:0 24px 50px rgba(43,41,38,.1)">
                        <div style="aspect-ratio:16/10;overflow:hidden;background:#0c1018"><img src="{{ $rpImage }}" alt="{{ $rpTitle }}" loading="lazy" style="width:100%;height:100%;object-fit:cover"></div>
                        <div style="padding:24px 24px 28px">
                            <div style="font-size:11.5px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#D97757">{{ optional($rpDate)->translatedFormat('d F Y') }}</div>
                            <h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:18px;color:#2B2926;margin-top:10px;line-height:1.25">{{ $rpTitle }}</h3>
                            <p style="margin-top:10px;font-size:14px;line-height:1.6;color:#6A6358">{{ \Illuminate\Support\Str::limit(strip_tags($rpDesc), 95) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
@endsection

@push('scripts')
    {!! $blogPostingScript ?? '' !!}
    <script>
    (function () {
        var form = document.getElementById('kal-comment-form');
        if (!form) return;
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var msg = document.getElementById('kal-comment-message');
            var btn = form.querySelector('button[type="submit"]');
            var fd = new FormData(form);
            btn.disabled = true;
            fetch(form.action, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                body: fd
            })
            .then(function (r) { return r.json().catch(function () { return {}; }).then(function (d) { return { ok: r.ok, d: d }; }); })
            .then(function (res) {
                btn.disabled = false;
                if (res.ok && (res.d.success === undefined || res.d.success)) {
                    msg.style.color = '#3F8A4F';
                    msg.textContent = res.d.message || 'Yorumunuz alındı. Onaylandıktan sonra yayınlanacaktır.';
                    form.reset();
                } else {
                    msg.style.color = '#C2603F';
                    msg.textContent = res.d.message || 'Bir hata oluştu. Lütfen tekrar deneyin.';
                }
            })
            .catch(function () {
                btn.disabled = false;
                msg.style.color = '#C2603F';
                msg.textContent = 'Bir hata oluştu. Lütfen tekrar deneyin.';
            });
        });
    })();
    </script>
@endpush
