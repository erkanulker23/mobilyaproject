<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $seoTitle ?? 'AWA Mobilya' }}</title>
<meta name="description" content="{{ $seoDescription ?? '' }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $seoTitle ?? 'AWA Mobilya' }}">
<meta property="og:description" content="{{ $seoDescription ?? '' }}">
@if(!empty($ogImage))<meta property="og:image" content="{{ $ogImage }}">@endif
<link rel="canonical" href="{{ url()->current() }}">
<script>window.__SERVER_DATA__ = {!! $serverData !!};
window.__INITIAL_STATE__ = {!! $initialState ?? '{"page":"home"}' !!};</script>
<script src="{{ asset('dc/awa-data.js') }}?v={{ $v }}"></script>
<script src="{{ asset('dc/awa-bridge.js') }}?v={{ $v }}"></script>
<script src="{{ asset('dc/support.js') }}?v={{ $v }}"></script>
</head>
<body>
@verbatim
<x-dc>
<helmet>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700;800;900&family=Montserrat:wght@400;500;600;700;800&family=Dancing+Script:wght@500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<meta name="keywords" content="AWA Mobilya, koltuk takımı, köşe takımı, yatak odası, yemek odası, kurumsal mobilya, mobilya üreticisi">
<meta name="robots" content="index,follow">
<meta name="author" content="AWA Mobilya">
<meta property="og:type" content="website">
<meta property="og:site_name" content="AWA Mobilya">
<meta property="og:image" content="uploads/1.png">
<meta name="twitter:card" content="summary_large_image">
<link rel="canonical" href="https://www.awamobilya.com/">
<script type="application/ld+json">{"@context":"https://schema.org","@type":"Organization","name":"AWA Mobilya","url":"https://www.awamobilya.com/","logo":"uploads/1.png","description":"Kurumsal mobilya markası — koltuk, köşe, yatak ve yemek odası koleksiyonları.","contactPoint":{"@type":"ContactPoint","telephone":"+90-444-96-16","contactType":"customer service","areaServed":"TR"},"sameAs":["https://www.facebook.com/","https://www.instagram.com/"]}</script>
<style>
  *{box-sizing:border-box}
  body{margin:0;background:#f6f3ed;font-family:'Montserrat',sans-serif;color:#17140f;-webkit-font-smoothing:antialiased}
  ::selection{background:#17140f;color:#f6f3ed}
  input,textarea,select{font-family:'Montserrat',sans-serif}
  @keyframes awaUp{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:none}}
  @keyframes awaFade{from{opacity:0}to{opacity:1}}
  @keyframes awaKen{from{transform:scale(1.14)}to{transform:scale(1)}}
</style>
</helmet>

<div style="min-height:100vh;display:flex;flex-direction:column">

  <sc-if value="{{ showFooter }}" hint-placeholder-val="{{ true }}">
  <header style="{{ headerStyle }}">
    <div style="max-width:1560px;margin:0 auto;padding:0 clamp(20px,4vw,60px);height:82px;display:flex;align-items:center;justify-content:space-between;gap:28px">
      <a onClick="{{ goHome }}" style="cursor:pointer;display:flex;align-items:center;gap:9px">{{ brandMark }}</a>
      <sc-if value="{{ isDesktop }}" hint-placeholder-val="{{ true }}">
      <nav style="display:flex;align-items:center;gap:clamp(18px,2.4vw,42px)">
        <span onClick="{{ goHome }}" style="{{ navHomeStyle }}">{{ t.nav.home }}</span>
        <span style="position:relative;padding-bottom:20px;margin-bottom:-20px" onMouseEnter="{{ openCorp }}" onMouseLeave="{{ closeDrop }}">
          <span onClick="{{ goCorporate }}" style="{{ navCorpStyle }}">{{ t.nav.corporate }}</span>
          <sc-if value="{{ corpOpen }}" hint-placeholder-val="{{ false }}">
            <div style="position:absolute;top:100%;left:50%;transform:translateX(-50%);margin-top:0;padding-top:10px;background:#fff;background-clip:padding-box;border:1px solid #ece6da;border-radius:14px;padding:10px;min-width:264px;box-shadow:0 24px 60px -28px rgba(23,20,15,.4);display:flex;flex-direction:column">
              <sc-for list="{{ corpMenu }}" as="m" hint-placeholder-count="5">
                <span onClick="{{ m.onClick }}" style="padding:13px 16px;border-radius:9px;cursor:pointer;font-size:15px;font-weight:500;color:#2c241b" style-hover="background:#f4f0e8">{{ m.label }}</span>
              </sc-for>
            </div>
          </sc-if>
        </span>
        <span style="position:relative;padding-bottom:20px;margin-bottom:-20px" onMouseEnter="{{ openCol }}" onMouseLeave="{{ closeDrop }}">
          <span onClick="{{ goCollectionDefault }}" style="{{ navColStyle }}">{{ t.nav.collection }}</span>
          <sc-if value="{{ colOpen }}" hint-placeholder-val="{{ false }}">
            <div style="position:fixed;left:0;right:0;top:82px;background:#fff;border-bottom:1px solid #ece6da;box-shadow:0 30px 60px -34px rgba(23,20,15,.35);padding:clamp(28px,4vw,48px) 0">
              <div style="max-width:1560px;margin:0 auto;padding:0 clamp(20px,4vw,60px);display:grid;grid-template-columns:repeat(4,1fr) 1.1fr;gap:clamp(20px,3vw,44px)">
                <sc-for list="{{ megaCols }}" as="m" hint-placeholder-count="4">
                  <div>
                    <div onClick="{{ m.onHead }}" style="cursor:pointer;font-family:'Space Mono';font-size:11px;letter-spacing:.18em;color:#9a8f7e;text-transform:uppercase;margin-bottom:18px;padding-bottom:12px;border-bottom:1px solid #efe9dd" style-hover="color:#17140f">{{ m.label }}</div>
                    <div style="display:flex;flex-direction:column;gap:11px">
                      <sc-for list="{{ m.items }}" as="it" hint-placeholder-count="3">
                        <span onClick="{{ it.onClick }}" style="cursor:pointer;font-size:15px;color:#3c352b" style-hover="color:{{ accent }}">{{ it.name }}</span>
                      </sc-for>
                    </div>
                  </div>
                </sc-for>
                <div onClick="{{ goCollectionDefault }}" style="cursor:pointer;border-radius:14px;overflow:hidden;position:relative;min-height:220px;{{ collectionHeroBg }}">
                  <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(20,17,12,.1),rgba(20,17,12,.72))"></div>
                  <div style="position:absolute;left:0;bottom:0;padding:20px 22px"><div style="font-family:Archivo;font-weight:800;font-size:20px;color:#fff;letter-spacing:-.01em">{{ t.collections.title }}</div><div style="margin-top:8px;display:inline-flex;align-items:center;gap:8px;font-family:'Space Mono';font-size:11px;letter-spacing:.1em;color:rgba(255,255,255,.85);text-transform:uppercase">{{ t.cta.allCollections }}<svg width="16" height="8" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.7"/></svg></div></div>
                </div>
              </div>
            </div>
          </sc-if>
        </span>
        <span onClick="{{ goNews }}" style="{{ navNewsStyle }}">{{ t.nav.news }}</span>
        <span onClick="{{ goDealers }}" style="{{ navDealersStyle }}">{{ t.nav.dealers }}</span>
        <span onClick="{{ goContact }}" style="{{ navContactStyle }}">{{ t.nav.contact }}</span>
      </nav>
      </sc-if>
      <div style="display:flex;align-items:center;gap:18px">
        <span onClick="{{ toggleSearch }}" style="cursor:pointer;display:flex;color:{{ navColor }}">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="9" cy="9" r="6.4" stroke="currentColor" stroke-width="1.5"/><path d="M14 14l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        </span>
        <sc-if value="{{ isDesktop }}" hint-placeholder-val="{{ true }}">
        <div style="display:flex;align-items:center;gap:7px;font-family:Archivo;font-weight:700;font-size:13px;letter-spacing:.06em">
          <span onClick="{{ setTR }}" style="{{ trStyle }}">TR</span>
          <span style="color:{{ navColor }};opacity:.3">/</span>
          <span onClick="{{ setEN }}" style="{{ enStyle }}">EN</span>
        </div>
        </sc-if>
        <sc-if value="{{ isMobile }}" hint-placeholder-val="{{ false }}">
        <span onClick="{{ toggleMobile }}" style="cursor:pointer;display:flex;flex-direction:column;gap:5px;padding:6px 2px;color:{{ navColor }}">
          <span style="display:block;width:24px;height:2px;background:currentColor"></span>
          <span style="display:block;width:24px;height:2px;background:currentColor"></span>
          <span style="display:block;width:16px;height:2px;background:currentColor"></span>
        </span>
        </sc-if>
      </div>
    </div>
    <sc-if value="{{ searchOpen }}" hint-placeholder-val="{{ false }}">
      <div style="border-top:1px solid rgba(0,0,0,.08);background:#fff">
        <div style="max-width:1560px;margin:0 auto;padding:18px clamp(20px,4vw,60px);display:flex;align-items:center;gap:14px">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" style="color:#9a8f7e"><circle cx="9" cy="9" r="6.4" stroke="currentColor" stroke-width="1.5"/><path d="M14 14l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          <input autofocus value="{{ query }}" onChange="{{ setQuery }}" placeholder="{{ t.searchPh }}" style="flex:1;border:none;outline:none;background:transparent;font-size:19px;color:#17140f"/>
          <span onClick="{{ toggleSearch }}" style="cursor:pointer;font-size:13px;color:#9a8f7e;font-family:'Space Mono'">ESC</span>
        </div>
        <sc-if value="{{ hasResults }}" hint-placeholder-val="{{ false }}">
          <div style="max-width:1560px;margin:0 auto;padding:0 clamp(20px,4vw,60px) 18px;display:flex;flex-direction:column;gap:2px">
            <sc-for list="{{ searchResults }}" as="r" hint-placeholder-count="3">
              <div onClick="{{ r.onClick }}" style="display:flex;align-items:center;gap:16px;padding:12px 14px;border-radius:10px;cursor:pointer" style-hover="background:#f4f0e8">
                <div style="width:62px;height:46px;border-radius:7px;{{ r.bg }}"></div>
                <div><div style="font-family:Archivo;font-weight:700;font-size:16px">{{ r.name }}</div><div style="font-size:13px;color:#9a8f7e">{{ r.catName }}</div></div>
              </div>
            </sc-for>
          </div>
        </sc-if>
        <sc-if value="{{ noResults }}" hint-placeholder-val="{{ false }}">
          <div style="max-width:1560px;margin:0 auto;padding:0 clamp(20px,4vw,60px) 22px;font-size:15px;color:#9a8f7e">{{ t.searchEmpty }}</div>
        </sc-if>
      </div>
    </sc-if>
    <sc-if value="{{ mobileOpen }}" hint-placeholder-val="{{ false }}">
      <div style="position:fixed;inset:0;z-index:200;background:#15120d;overflow:auto;animation:awaFade .28s ease">
        <div style="position:absolute;inset:0;background:url('uploads/3.png') center/cover;opacity:.10"></div>
        <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(21,18,13,.6),rgba(21,18,13,.92))"></div>
        <div style="position:relative;display:flex;flex-direction:column;min-height:100vh;padding:22px clamp(22px,6vw,42px) 38px;box-sizing:border-box">
          <div style="display:flex;align-items:center;justify-content:space-between">
            <div style="display:flex;align-items:baseline;gap:8px"><span style="font-family:Archivo;font-weight:900;font-size:24px;letter-spacing:-.04em;color:#fff">AWA</span><span style="font-family:Archivo;font-weight:500;font-size:10px;letter-spacing:.4em;color:#fff;opacity:.55">MOBİLYA</span></div>
            <span onClick="{{ closeMobile }}" style="cursor:pointer;width:44px;height:44px;border:1px solid rgba(255,255,255,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 5l10 10M15 5L5 15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            </span>
          </div>
          <nav style="margin:auto 0;display:flex;flex-direction:column;padding:34px 0">
            <sc-for list="{{ mobileLinks }}" as="l" hint-placeholder-count="6">
              <div onClick="{{ l.onClick }}" style="{{ l.style }}"><span style="{{ l.numStyle }}">{{ l.num }}</span><span>{{ l.label }}</span></div>
            </sc-for>
            <div style="display:flex;flex-wrap:wrap;gap:10px;margin-top:28px">
              <sc-for list="{{ mobileCats }}" as="c" hint-placeholder-count="4"><span onClick="{{ c.onClick }}" style="{{ c.style }}">{{ c.label }}</span></sc-for>
            </div>
          </nav>
          <div style="display:flex;align-items:center;justify-content:space-between;gap:20px;padding-top:24px;border-top:1px solid rgba(255,255,255,.12);flex-wrap:wrap">
            <div style="display:flex;align-items:center;gap:10px;font-family:Archivo;font-weight:800;font-size:16px;letter-spacing:.06em"><span onClick="{{ setTR }}" style="{{ trMStyle }}">TR</span><span style="color:#fff;opacity:.3">/</span><span onClick="{{ setEN }}" style="{{ enMStyle }}">EN</span></div>
            <div style="text-align:right"><div style="font-family:Archivo;font-weight:800;font-size:22px;color:#fff">{{ phone }}</div><div style="font-size:13px;color:#9a8f7e">{{ email }}</div></div>
          </div>
        </div>
      </div>
    </sc-if>
  </header>
  </sc-if>

  <main style="flex:1">

  <!-- HOME -->
  <sc-if value="{{ isHome }}" hint-placeholder-val="{{ true }}">
  <div>
    <section style="position:relative;height:90vh;min-height:600px;overflow:hidden">
      <div style="{{ heroTrackStyle }}">
        <sc-for list="{{ heroSlidesAll }}" as="hsl" hint-placeholder-count="3">
          <div style="position:relative;flex:none;width:100%;height:100%;overflow:hidden">
            <div style="position:absolute;inset:0;{{ hsl.bg }};{{ hsl.kb }}"></div>
            <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(20,17,12,.45),rgba(20,17,12,0) 30%,rgba(20,17,12,0) 50%,rgba(20,17,12,.78))"></div>
            <div style="position:absolute;left:0;bottom:56px;width:100%;padding:0 clamp(20px,4vw,72px)">
              <span style="display:block;font-family:'Space Mono';font-size:12px;letter-spacing:.22em;color:rgba(255,255,255,.75);text-transform:uppercase;margin-bottom:18px">{{ hsl.sub }}</span>
              <h1 style="margin:0;font-family:Archivo;font-weight:800;font-size:clamp(42px,6.4vw,92px);line-height:.96;letter-spacing:-.03em;color:#fff;text-wrap:balance">{{ hsl.title }}</h1>
              <sc-if value="{{ hsl.desc }}" hint-placeholder-val="{{ true }}">
              <p style="margin:20px 0 0;max-width:520px;font-family:Montserrat,sans-serif;font-size:clamp(15px,1.4vw,18px);line-height:1.65;color:rgba(255,255,255,.86)">{{ hsl.desc }}</p>
              </sc-if>
              <button onClick="{{ hsl.onCta }}" style="margin-top:30px;display:inline-flex;align-items:center;gap:14px;background:#f6f3ed;color:#17140f;border:none;cursor:pointer;padding:16px 30px;border-radius:999px;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.13em;text-transform:uppercase">{{ t.cta.discover }}<svg width="22" height="10" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg></button>
            </div>
          </div>
        </sc-for>
      </div>
      <div style="position:absolute;right:clamp(20px,4vw,72px);bottom:60px;display:flex;align-items:center;gap:22px;z-index:3">
        <div style="display:flex;align-items:center;gap:16px"><sc-for list="{{ heroDots }}" as="d" hint-placeholder-count="3"><span onClick="{{ d.onClick }}" style="{{ d.style }}">{{ d.num }}</span></sc-for></div>
        <div style="display:flex;gap:10px">
          <span onClick="{{ heroPrev }}" style="width:44px;height:44px;border-radius:50%;border:1px solid rgba(255,255,255,.4);display:flex;align-items:center;justify-content:center;cursor:pointer;color:#fff" style-hover="background:rgba(255,255,255,.15)"><svg width="18" height="12" viewBox="0 0 22 12" fill="none"><path d="M22 6H2M6 1L1 6l5 5" stroke="currentColor" stroke-width="1.5"/></svg></span>
          <span onClick="{{ heroNext }}" style="width:44px;height:44px;border-radius:50%;border:1px solid rgba(255,255,255,.4);display:flex;align-items:center;justify-content:center;cursor:pointer;color:#fff" style-hover="background:rgba(255,255,255,.15)"><svg width="18" height="12" viewBox="0 0 22 12" fill="none"><path d="M0 6h20M16 1l5 5-5 5" stroke="currentColor" stroke-width="1.5"/></svg></span>
        </div>
      </div>
    </section>

    <section style="position:relative;background:#f6f3ed;overflow:hidden">
      <div style="position:absolute;top:-120px;left:-180px;width:760px;height:760px;border-radius:50%;background:#fff;opacity:.6"></div>
      <div style="position:relative;max-width:1560px;margin:0 auto;padding:clamp(70px,9vw,130px) clamp(20px,4vw,72px);display:grid;grid-template-columns:{{ gFeatured }};gap:clamp(32px,5vw,90px);align-items:center">
        <div>
          <span style="{{ kickerStyle }}">{{ t.featured.kicker }}</span>
          <div style="font-family:'Dancing Script',cursive;font-weight:600;font-size:clamp(28px,3.4vw,40px);color:{{ accent }};line-height:1;margin-top:10px">{{ scriptFeatured }}</div>
          <h2 style="margin:8px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(38px,4.6vw,64px);line-height:1.02;letter-spacing:-.025em">{{ t.featured.title }}</h2>
          <p style="margin:26px 0 0;font-size:18px;line-height:1.65;color:#5d564b;max-width:430px">{{ t.featured.desc }}</p>
          <div style="display:flex;gap:18px;margin-top:38px">
            <div style="flex:1;border-radius:14px;aspect-ratio:1/1;background:url('uploads/9.png') center/cover"></div>
            <div style="flex:1;border-radius:14px;aspect-ratio:1/1;background:url('uploads/4.png') center/cover"></div>
          </div>
          <button onClick="{{ goCollectionDefault }}" style="margin-top:34px;display:inline-flex;align-items:center;gap:14px;background:#17140f;color:#fff;border:none;cursor:pointer;padding:17px 32px;border-radius:999px;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.13em;text-transform:uppercase">{{ t.cta.exploreProducts }}<svg width="22" height="10" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg></button>
        </div>
        <div style="border-radius:18px;aspect-ratio:4/3.1;background:url('uploads/1.png') center/cover;box-shadow:0 40px 80px -40px rgba(23,20,15,.4)"></div>
      </div>
    </section>

    <section style="background:#15120d;color:#f6f3ed">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(70px,9vw,130px) clamp(20px,4vw,72px);display:grid;grid-template-columns:{{ gAbout }};gap:clamp(36px,5vw,90px);align-items:center">
        <div style="border-radius:18px;aspect-ratio:3/3.6;background:url('uploads/3.png') center/cover"></div>
        <div>
          <span style="font-family:'Space Mono';font-size:12px;letter-spacing:.2em;color:{{ accent }};text-transform:uppercase">{{ t.about.kicker }}</span>
          <div style="font-family:'Dancing Script',cursive;font-weight:600;font-size:clamp(28px,3.4vw,42px);color:{{ accent }};line-height:1;margin-top:10px">{{ scriptAbout }}</div>
          <h2 style="margin:8px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(36px,4.4vw,58px);line-height:1.04;letter-spacing:-.025em;color:#fff">{{ t.about.title }}</h2>
          <p style="margin:26px 0 0;font-size:17px;line-height:1.7;color:#b9b1a4;max-width:560px">{{ aboutText }}</p>
          <div style="display:flex;gap:clamp(28px,5vw,80px);margin-top:52px;flex-wrap:wrap">
            <sc-for list="{{ stats }}" as="s" hint-placeholder-count="3"><div><div data-countup="1" data-count="{{ s.count }}" data-suffix="{{ s.suffix }}" style="font-family:Archivo;font-weight:800;font-size:clamp(46px,5vw,68px);line-height:1;color:#fff">{{ s.n }}</div><div style="margin-top:8px;font-size:14px;color:#8f8676;max-width:170px">{{ s.l }}</div></div></sc-for>
          </div>
        </div>
      </div>
    </section>

    <sc-if value="{{ showCatalog }}" hint-placeholder-val="{{ true }}">
    <section style="position:relative;background:linear-gradient(135deg,#6e5236,#3a2817);color:#f6f3ed;overflow:hidden">
      <div style="position:absolute;right:-140px;top:-120px;width:520px;height:520px;border-radius:50%;border:1px solid rgba(201,185,143,.18)"></div>
      <div style="position:relative;max-width:1560px;margin:0 auto;padding:clamp(70px,9vw,128px) clamp(20px,4vw,72px);display:grid;grid-template-columns:{{ gCatalog }};gap:clamp(36px,5vw,80px);align-items:center">
        <div>
          <span style="font-family:'Space Mono';font-size:12px;letter-spacing:.22em;color:{{ accent }};text-transform:uppercase">KATALOG · 2026</span>
          <h2 style="margin:16px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(38px,4.6vw,62px);line-height:1.02;letter-spacing:-.025em;color:#fff">{{ t.catalog.title }}</h2>
          <p style="margin:22px 0 0;font-size:18px;line-height:1.65;color:#b9b1a4;max-width:400px">{{ t.catalog.desc }}</p>
          <button onClick="{{ goCatalog }}" style="margin-top:36px;display:inline-flex;align-items:center;gap:14px;background:{{ accent }};color:#1a1610;border:none;cursor:pointer;padding:17px 32px;border-radius:999px;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.13em;text-transform:uppercase">{{ t.cta.download }}<svg width="22" height="10" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.6"/></svg></button>
        </div>
        <div style="display:flex;gap:clamp(14px,2vw,26px);justify-content:flex-end;align-items:flex-end">
          <div style="flex:1;max-width:200px;border-radius:12px;aspect-ratio:3/4;background:url('uploads/2.png') center/cover;box-shadow:0 30px 60px -30px rgba(0,0,0,.7);margin-bottom:42px"></div>
          <div style="flex:1;max-width:220px;border-radius:12px;aspect-ratio:3/4;background:url('uploads/7.png') center/cover;box-shadow:0 40px 70px -30px rgba(0,0,0,.8);margin-bottom:14px"></div>
          <div style="flex:1;max-width:200px;border-radius:12px;aspect-ratio:3/4;background:url('uploads/1.png') center/cover;box-shadow:0 30px 60px -30px rgba(0,0,0,.7);margin-bottom:56px"></div>
        </div>
      </div>
    </section>
    </sc-if>

    <section style="background:#f6f3ed">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(70px,9vw,120px) clamp(20px,4vw,72px)">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:28px;flex-wrap:wrap;margin-bottom:46px">
          <div><span style="{{ kickerStyle }}">{{ t.collections.kicker }}</span><h2 style="margin:16px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(36px,4.4vw,58px);letter-spacing:-.025em">{{ t.collections.title }}</h2></div>
          <button onClick="{{ goCollectionDefault }}" style="display:inline-flex;align-items:center;gap:12px;background:transparent;color:#17140f;border:1px solid #d3cabb;cursor:pointer;padding:14px 26px;border-radius:999px;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.13em;text-transform:uppercase">{{ t.cta.allCollections }}<svg width="20" height="9" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg></button>
        </div>
        <div style="display:flex;gap:22px;overflow-x:auto;scroll-snap-type:x mandatory;padding-bottom:8px;scrollbar-width:thin">
          <sc-for list="{{ catCards }}" as="c" hint-placeholder-count="4">
            <div onClick="{{ c.onClick }}" style="flex:0 0 calc(33.333% - 15px);min-width:300px;scroll-snap-align:start;cursor:pointer;background:#fff;border-radius:16px;overflow:hidden;border:1px solid #ece6da;transition:transform .45s cubic-bezier(.2,.7,.2,1),border-color .3s ease,box-shadow .45s ease" style-hover="border-color:#17140f;transform:translateY(-6px);box-shadow:0 24px 50px -30px rgba(23,20,15,.5)">
              <div style="aspect-ratio:16/10;{{ c.bg }}"></div>
              <div style="padding:20px 22px;display:flex;align-items:center;justify-content:space-between">
                <div><div style="font-family:Archivo;font-weight:700;font-size:19px">{{ c.label }}</div><div style="font-size:13px;color:#9a8f7e;margin-top:3px">{{ c.count }} {{ t.collections.product }}</div></div>
                <span style="color:{{ accent }}"><svg width="22" height="10" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.6"/></svg></span>
              </div>
            </div>
          </sc-for>
        </div>
      </div>
    </section>

    <sc-for list="{{ homeSections }}" as="hs" hint-placeholder-count="4">
    <section style="{{ hs.secStyle }}">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(64px,8vw,110px) clamp(20px,4vw,72px)">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:28px;flex-wrap:wrap;margin-bottom:40px">
          <div>
            <span style="font-family:'Space Mono';font-size:12px;letter-spacing:.2em;color:{{ hs.kickerColor }};text-transform:uppercase">{{ t.collections.kicker }}</span>
            <h2 style="margin:14px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(32px,4vw,54px);letter-spacing:-.025em;color:{{ hs.titleColor }}">{{ hs.title }}</h2>
          </div>
          <button onClick="{{ hs.onAll }}" style="{{ hs.btnStyle }};display:inline-flex;align-items:center;gap:12px;background:transparent;cursor:pointer;padding:13px 24px;border-radius:999px;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.12em;text-transform:uppercase">{{ t.cta.viewAll }}<svg width="20" height="9" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg></button>
        </div>
        <div style="display:flex;gap:22px;overflow-x:auto;scroll-snap-type:x mandatory;padding-bottom:10px;scrollbar-width:thin">
          <sc-for list="{{ hs.products }}" as="p" hint-placeholder-count="3">
            <div onClick="{{ p.onClick }}" style="flex:0 0 calc(33.333% - 15px);min-width:300px;scroll-snap-align:start;cursor:pointer">
              <div style="position:relative;border-radius:18px;overflow:hidden;aspect-ratio:4/3.2;{{ p.bg }};box-shadow:0 20px 44px -28px rgba(23,20,15,.5);transition:transform .45s cubic-bezier(.2,.7,.2,1)" style-hover="transform:translateY(-6px)">
                <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(20,17,12,0) 50%,rgba(20,17,12,.72))"></div>
                <span style="position:absolute;right:16px;top:16px;width:40px;height:40px;border-radius:50%;background:rgba(246,243,237,.92);color:#17140f;display:flex;align-items:center;justify-content:center"><svg width="18" height="8" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.7"/></svg></span>
                <div style="position:absolute;left:0;bottom:0;padding:20px 22px"><h3 style="margin:0;font-family:Archivo;font-weight:700;font-size:21px;color:#fff">{{ p.name }}</h3><div style="font-size:13px;color:rgba(255,255,255,.72);margin-top:3px">{{ p.catName }}</div></div>
              </div>
            </div>
          </sc-for>
        </div>
      </div>
    </section>
    </sc-for>

    <section style="background:#fff;border-top:1px solid #ece6da">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(70px,9vw,120px) clamp(20px,4vw,72px)">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:28px;flex-wrap:wrap;margin-bottom:46px">
          <div><span style="{{ kickerStyle }}">{{ t.newsSec.kicker }}</span><h2 style="margin:16px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(36px,4.4vw,58px);letter-spacing:-.025em">{{ t.newsSec.title }}</h2></div>
          <button onClick="{{ goNews }}" style="display:inline-flex;align-items:center;gap:12px;background:transparent;color:#17140f;border:1px solid #d3cabb;cursor:pointer;padding:14px 26px;border-radius:999px;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.13em;text-transform:uppercase">{{ t.cta.viewAll }}<svg width="20" height="9" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg></button>
        </div>
        <div style="display:grid;grid-template-columns:{{ g3 }};gap:26px">
          <sc-for list="{{ newsTeaser }}" as="n" hint-placeholder-count="3">
            <div onClick="{{ n.onClick }}" style="cursor:pointer">
              <div style="border-radius:14px;aspect-ratio:4/2.7;{{ n.bg }}"></div>
              <div style="display:flex;gap:14px;margin-top:18px;font-family:'Space Mono';font-size:12px;color:#9a8f7e"><span>{{ n.date }}</span><span style="color:{{ accent }}">{{ n.cat }}</span></div>
              <h3 style="margin:10px 0 0;font-family:Archivo;font-weight:700;font-size:21px;line-height:1.25">{{ n.title }}</h3>
            </div>
          </sc-for>
        </div>
      </div>
    </section>
  </div>
  </sc-if>

  <!-- CORPORATE -->
  <sc-if value="{{ isCorporate }}" hint-placeholder-val="{{ false }}">
  <div>
    <section style="position:relative;height:64vh;min-height:460px;overflow:hidden;display:flex;align-items:flex-end">
      <div style="position:absolute;inset:0;background:url('uploads/3.png') center/cover"></div>
      <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(20,17,12,.55),rgba(20,17,12,.35))"></div>
      <div style="position:relative;max-width:1560px;width:100%;margin:0 auto;padding:0 clamp(20px,4vw,72px) 48px">
        <span style="font-family:'Space Mono';font-size:12px;letter-spacing:.2em;color:rgba(255,255,255,.8);text-transform:uppercase">{{ t.corpPage.kicker }}</span>
        <h1 style="margin:14px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(42px,5.6vw,80px);letter-spacing:-.03em;color:#fff">{{ t.nav.corporate }}</h1>
      </div>
    </section>
    <section style="background:#f6f3ed">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(64px,8vw,110px) clamp(20px,4vw,72px);display:grid;grid-template-columns:{{ g2 }};gap:clamp(40px,6vw,100px);align-items:center">
        <div>
          <h2 style="margin:0;font-family:Archivo;font-weight:800;font-size:clamp(30px,3.4vw,44px);letter-spacing:-.02em">{{ t.corpPage.title }}</h2>
          <p style="margin:24px 0 0;font-size:17px;line-height:1.75;color:#5d564b">{{ aboutText }}</p>
          <p style="margin:18px 0 0;font-size:17px;line-height:1.75;color:#5d564b">{{ t.corpPage.story2 }}</p>
        </div>
        <div style="border-radius:18px;aspect-ratio:4/3.4;background:url('uploads/5.png') center/cover"></div>
      </div>
    </section>
    <section style="background:#15120d;color:#f6f3ed">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(64px,8vw,110px) clamp(20px,4vw,72px);display:grid;grid-template-columns:{{ g2 }};gap:clamp(36px,5vw,80px)">
        <div style="border:1px solid #2c261d;border-radius:16px;padding:38px"><span style="font-family:'Space Mono';font-size:12px;letter-spacing:.18em;color:{{ accent }}">01</span><h3 style="margin:14px 0 0;font-family:Archivo;font-weight:700;font-size:26px;color:#fff">{{ t.corpPage.missionT }}</h3><p style="margin:16px 0 0;font-size:16px;line-height:1.7;color:#b3a99b">{{ t.corpPage.missionP }}</p></div>
        <div style="border:1px solid #2c261d;border-radius:16px;padding:38px"><span style="font-family:'Space Mono';font-size:12px;letter-spacing:.18em;color:{{ accent }}">02</span><h3 style="margin:14px 0 0;font-family:Archivo;font-weight:700;font-size:26px;color:#fff">{{ t.corpPage.visionT }}</h3><p style="margin:16px 0 0;font-size:16px;line-height:1.7;color:#b3a99b">{{ t.corpPage.visionP }}</p></div>
      </div>
    </section>
    <section style="background:#f6f3ed">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(64px,8vw,110px) clamp(20px,4vw,72px)">
        <h2 style="margin:0 0 44px;font-family:Archivo;font-weight:800;font-size:clamp(28px,3.2vw,42px);letter-spacing:-.02em">{{ t.corpPage.valuesT }}</h2>
        <div style="display:grid;grid-template-columns:{{ g3 }};gap:24px">
          <sc-for list="{{ t.corpPage.values }}" as="v" hint-placeholder-count="3"><div style="background:#fff;border:1px solid #ece6da;border-radius:16px;padding:34px"><h3 style="margin:0;font-family:Archivo;font-weight:700;font-size:21px">{{ v.t }}</h3><p style="margin:14px 0 0;font-size:15px;line-height:1.65;color:#6b6356">{{ v.d }}</p></div></sc-for>
        </div>
        <div style="margin-top:30px;background:linear-gradient(135deg,#2f281f,#4a3f30);border-radius:18px;padding:clamp(34px,5vw,64px);color:#f3ece0;display:grid;grid-template-columns:{{ g2 }};gap:40px;align-items:center">
          <div><span style="font-family:'Space Mono';font-size:12px;letter-spacing:.18em;color:#cbb78f;text-transform:uppercase">{{ t.corpPage.socialKicker }}</span><h3 style="margin:14px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(26px,3vw,38px);color:#fff">{{ t.corpPage.socialT }}</h3><p style="margin:18px 0 0;font-size:16px;line-height:1.7;color:#ddd2c2">{{ t.corpPage.socialP }}</p></div>
          <div style="display:flex;gap:clamp(24px,4vw,56px);flex-wrap:wrap"><sc-for list="{{ stats }}" as="s" hint-placeholder-count="3"><div><div data-countup="1" data-count="{{ s.count }}" data-suffix="{{ s.suffix }}" style="font-family:Archivo;font-weight:800;font-size:clamp(38px,4vw,56px);color:#fff">{{ s.n }}</div><div style="margin-top:6px;font-size:13px;color:#bcae97;max-width:150px">{{ s.l }}</div></div></sc-for></div>
        </div>
      </div>
    </section>
  </div>
  </sc-if>

  <!-- COLLECTION -->
  <sc-if value="{{ isCollection }}" hint-placeholder-val="{{ false }}">
  <div>
    <section style="position:relative;height:60vh;min-height:440px;overflow:hidden;display:flex;align-items:flex-end">
      <div style="position:absolute;inset:0;{{ collectionHeroBg }}"></div>
      <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(20,17,12,.4),rgba(20,17,12,0) 45%,rgba(20,17,12,.82))"></div>
      <div style="position:relative;max-width:1560px;width:100%;margin:0 auto;padding:0 clamp(20px,4vw,72px) clamp(40px,5vw,60px)">
        <span style="font-family:'Space Mono';font-size:12px;letter-spacing:.2em;color:rgba(255,255,255,.75);text-transform:uppercase">{{ t.collections.kicker }}</span>
        <h1 style="margin:14px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(40px,5.8vw,82px);letter-spacing:-.03em;color:#fff">{{ collectionTitle }}</h1>
        <p style="margin:18px 0 0;font-size:clamp(15px,2vw,18px);line-height:1.6;color:rgba(246,243,237,.86);max-width:560px">{{ collectionDesc }}</p>
      </div>
    </section>
    <section style="background:#f6f3ed">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(36px,4vw,56px) clamp(20px,4vw,72px) clamp(70px,9vw,120px)">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:18px;flex-wrap:wrap;margin-bottom:38px">
          <div style="display:flex;gap:12px;flex-wrap:wrap"><sc-for list="{{ catTabs }}" as="c" hint-placeholder-count="4"><span onClick="{{ c.onClick }}" style="{{ c.style }}">{{ c.label }}</span></sc-for></div>
          <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap">
            <span style="font-family:'Space Mono';font-size:12px;letter-spacing:.06em;color:#9a8f7e">{{ collectionCount }} {{ t.collections.resultsT }}</span>
            <select value="{{ sortMode }}" onChange="{{ setSort }}" style="border:1px solid #d8cfc0;background:#fff;border-radius:999px;padding:11px 18px;font-size:13px;font-weight:600;color:#2c241b;cursor:pointer;outline:none"><sc-for list="{{ sortOptions }}" as="o" hint-placeholder-count="3"><option value="{{ o.v }}">{{ o.label }}</option></sc-for></select>
          </div>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(480px,1fr));gap:26px">
          <sc-for list="{{ filteredProducts }}" as="p" hint-placeholder-count="6">
            <div onClick="{{ p.onClick }}" style="cursor:pointer;background:#fff;border:1px solid #ece6da;border-radius:18px;overflow:hidden;transition:transform .45s cubic-bezier(.2,.7,.2,1),box-shadow .45s ease,border-color .3s ease" style-hover="box-shadow:0 30px 60px -30px rgba(23,20,15,.5);transform:translateY(-6px);border-color:#17140f">
              <div style="aspect-ratio:16/10;{{ p.bg }}"></div>
              <div style="padding:20px 24px;display:flex;align-items:center;justify-content:space-between;gap:14px">
                <div>
                  <h3 style="margin:0;font-family:Archivo;font-weight:700;font-size:clamp(20px,2.2vw,24px);letter-spacing:-.015em">{{ p.name }}</h3>
                  <div style="font-size:13px;color:#9a8f7e;margin-top:4px">{{ p.catName }}</div>
                </div>
                <span style="flex:none;width:46px;height:46px;border-radius:50%;background:{{ accent }};color:#fff;display:flex;align-items:center;justify-content:center"><svg width="20" height="9" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.7"/></svg></span>
              </div>
            </div>
          </sc-for>
        </div>
      </div>
    </section>
  </div>
  </sc-if>

  <!-- PRODUCT -->
  <sc-if value="{{ isProduct }}" hint-placeholder-val="{{ false }}">
  <div>
    <section style="position:relative;height:90vh;min-height:620px;overflow:hidden">
      <div style="{{ galTrackStyle }}">
        <sc-for list="{{ galSlides }}" as="gs" hint-placeholder-count="3">
          <div onClick="{{ product.onMainClick }}" style="cursor:zoom-in;position:relative;flex:none;width:100%;height:100%;{{ gs.bg }}"></div>
        </sc-for>
      </div>
      <div style="position:absolute;inset:0;pointer-events:none;background:linear-gradient(180deg,rgba(20,17,12,.5) 0%,rgba(20,17,12,0) 26%,rgba(20,17,12,0) 52%,rgba(20,17,12,.78) 100%)"></div>
      <div style="position:absolute;left:0;top:0;width:100%;padding:clamp(96px,11vh,120px) clamp(20px,4vw,72px) 0">
        <div style="display:flex;align-items:center;gap:10px;font-family:'Space Mono';font-size:12px;color:rgba(255,255,255,.75);flex-wrap:wrap">
          <span onClick="{{ goCollectionDefault }}" style="cursor:pointer" style-hover="color:#fff">{{ t.nav.collection }}</span><span>/</span>
          <span onClick="{{ product.onBack }}" style="cursor:pointer" style-hover="color:#fff">{{ product.catName }}</span>
        </div>
      </div>
      <div style="position:absolute;left:0;bottom:42px;width:100%;padding:0 clamp(20px,4vw,72px);display:flex;align-items:flex-end;justify-content:space-between;gap:24px;flex-wrap:wrap">
        <div>
          <span style="display:block;font-family:'Space Mono';font-size:12px;letter-spacing:.2em;color:rgba(255,255,255,.7);text-transform:uppercase;margin-bottom:14px">{{ product.catName }}</span>
          <h1 style="margin:0;font-family:Archivo;font-weight:800;font-size:clamp(40px,5.6vw,82px);letter-spacing:-.03em;color:#fff;line-height:.98">{{ product.name }}</h1>
        </div>
        <div style="display:flex;align-items:center;gap:22px">
          <div style="display:flex;align-items:center;gap:10px"><sc-for list="{{ galDots }}" as="d" hint-placeholder-count="3"><span onClick="{{ d.onClick }}" style="{{ d.style }}"></span></sc-for></div>
          <span onClick="{{ product.onMainClick }}" style="display:inline-flex;align-items:center;gap:9px;background:rgba(246,243,237,.92);color:#17140f;padding:11px 20px;border-radius:999px;font-family:Archivo;font-weight:700;font-size:11px;letter-spacing:.1em;text-transform:uppercase;cursor:pointer"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="M16 16l4 4M11 8v6M8 11h6"/></svg>Büyüt</span>
        </div>
      </div>
    </section>
    <section style="background:#f6f3ed">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(40px,5vw,64px) clamp(20px,4vw,72px) clamp(50px,6vw,80px)">
        <div style="display:flex;gap:12px;flex-wrap:wrap">
          <sc-for list="{{ gallery }}" as="g" hint-placeholder-count="4"><div onClick="{{ g.onClick }}" style="width:130px;max-width:23%;{{ g.style }}"></div></sc-for>
        </div>
        <div style="display:grid;grid-template-columns:{{ gProduct }};gap:clamp(32px,5vw,72px);align-items:start;margin-top:clamp(44px,5vw,68px)">
          <div>
            <span style="{{ kickerStyle }}">{{ product.catName }}</span>
            <h2 style="margin:14px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(30px,3.6vw,46px);letter-spacing:-.02em;line-height:1.04">{{ product.name }}</h2>
            <p style="margin:24px 0 0;font-size:19px;line-height:1.8;color:#39342c;max-width:560px">{{ product.longDesc }}</p>
            <p style="margin:18px 0 0;font-size:16px;line-height:1.8;color:#6b6356;max-width:560px">{{ product.desc }}</p>
            <div style="margin-top:34px;font-family:'Space Mono';font-size:12px;letter-spacing:.14em;color:#9a8f7e;text-transform:uppercase">{{ t.productPage.featuresT }}</div>
            <div style="display:flex;flex-direction:column;gap:13px;margin-top:18px">
              <sc-for list="{{ productFeatures }}" as="f" hint-placeholder-count="5">
                <div style="display:flex;align-items:center;gap:14px;font-size:17px;color:#2c241b"><span style="flex:none;width:24px;height:24px;border-radius:50%;background:{{ accent }};color:#fff;display:flex;align-items:center;justify-content:center"><svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>{{ f.txt }}</div>
              </sc-for>
            </div>
          </div>
          <div style="position:sticky;top:100px">
            <div style="background:#fff;border:1px solid #ece6da;border-radius:18px;padding:clamp(24px,3vw,34px)">
              <div style="display:grid;grid-template-columns:{{ g3 }};gap:12px">
                <sc-for list="{{ t.specs }}" as="sp" hint-placeholder-count="3"><div style="background:#f6f3ed;border:1px solid #ece6da;border-radius:12px;padding:16px"><div style="font-family:'Space Mono';font-size:10px;letter-spacing:.1em;color:#9a8f7e;text-transform:uppercase">{{ sp.l }}</div><div style="margin-top:6px;font-family:Archivo;font-weight:700;font-size:17px">{{ sp.v }}</div></div></sc-for>
              </div>
              <p style="margin:22px 0 0;font-size:15px;line-height:1.7;color:#5d564b">{{ t.productPage.formDesc }}</p>
              <div style="display:flex;flex-direction:column;gap:12px;margin-top:22px">
                <button onClick="{{ goContact }}" style="display:inline-flex;align-items:center;justify-content:center;gap:12px;background:#17140f;color:#fff;border:none;cursor:pointer;padding:16px 30px;border-radius:999px;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.13em;text-transform:uppercase">{{ t.cta.requestInfo }}<svg width="20" height="9" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg></button>
                <button onClick="{{ goCatalog }}" style="display:inline-flex;align-items:center;justify-content:center;gap:12px;background:transparent;color:#17140f;border:1px solid #d3cabb;cursor:pointer;padding:16px 28px;border-radius:999px;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.13em;text-transform:uppercase">{{ t.cta.download }}</button>
              </div>
              <div style="margin-top:22px;padding-top:20px;border-top:1px solid #e4ddce"><div style="font-family:Archivo;font-weight:800;font-size:24px">{{ phone }}</div><div style="font-size:14px;color:#6b6356">{{ email }}</div></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section style="background:#fff;border-top:1px solid #ece6da">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(60px,7vw,100px) clamp(20px,4vw,72px)">
        <h2 style="margin:0 0 44px;text-align:center;font-family:Archivo;font-weight:800;font-size:clamp(28px,3.4vw,46px);letter-spacing:-.02em">{{ t.productPage.contents }}</h2>
        <div style="display:grid;grid-template-columns:{{ g3 }};gap:24px">
          <sc-for list="{{ productPieces }}" as="pc" hint-placeholder-count="3"><div style="background:#f6f3ed;border:1px solid #ece6da;border-radius:16px;padding:18px"><div style="aspect-ratio:4/3;border-radius:10px;{{ pc.bg }}"></div><h3 style="margin:18px 0 0;font-family:Archivo;font-weight:700;font-size:19px">{{ pc.name }}</h3><div style="margin-top:6px;font-family:'Space Mono';font-size:13px;color:#9a8f7e">{{ pc.dims }}</div></div></sc-for>
        </div>
      </div>
    </section>
    <section style="background:#f6f3ed">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(56px,6vw,90px) clamp(20px,4vw,72px) clamp(70px,9vw,120px)">
        <h2 style="margin:0 0 36px;font-family:Archivo;font-weight:800;font-size:clamp(26px,3vw,40px);letter-spacing:-.02em">{{ t.productPage.related }}</h2>
        <div style="display:flex;gap:24px;overflow-x:auto;padding-bottom:12px;scroll-snap-type:x mandatory">
          <sc-for list="{{ relatedProducts }}" as="p" hint-placeholder-count="3"><div onClick="{{ p.onClick }}" style="cursor:pointer;flex:none;width:min(440px,82vw);scroll-snap-align:start"><div style="border-radius:16px;aspect-ratio:16/11;{{ p.bg }}"></div><h3 style="margin:16px 0 0;font-family:Archivo;font-weight:700;font-size:20px">{{ p.name }}</h3><div style="font-size:13px;color:#9a8f7e;margin-top:3px">{{ p.catName }}</div></div></sc-for>
        </div>
      </div>
    </section>
  </div>
  </sc-if>

  <!-- NEWS -->
  <sc-if value="{{ isNews }}" hint-placeholder-val="{{ false }}">
  <div>
    <section style="position:relative;height:56vh;min-height:420px;overflow:hidden;display:flex;align-items:flex-end">
      <div style="position:absolute;inset:0;background:url('uploads/2.png') center/cover"></div>
      <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(20,17,12,.4),rgba(20,17,12,0) 45%,rgba(20,17,12,.82))"></div>
      <div style="position:relative;max-width:1560px;width:100%;margin:0 auto;padding:0 clamp(20px,4vw,72px) clamp(40px,5vw,60px)">
        <span style="font-family:'Space Mono';font-size:12px;letter-spacing:.2em;color:rgba(255,255,255,.75);text-transform:uppercase">{{ t.newsSec.kicker }}</span>
        <h1 style="margin:14px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(42px,5.6vw,80px);letter-spacing:-.03em;color:#fff">{{ t.nav.news }}</h1>
        <p style="margin:18px 0 0;font-size:clamp(15px,2vw,18px);line-height:1.6;color:rgba(246,243,237,.86);max-width:560px">{{ t.newsPage.intro }}</p>
      </div>
    </section>
    <section style="background:#f6f3ed">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(46px,5vw,72px) clamp(20px,4vw,72px) clamp(70px,9vw,120px)">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:28px">
          <sc-for list="{{ newsList }}" as="n" hint-placeholder-count="6">
            <div onClick="{{ n.onClick }}" style="background:#fff;border:1px solid #ece6da;border-radius:18px;overflow:hidden;cursor:pointer;display:flex;flex-direction:column;transition:transform .45s cubic-bezier(.2,.7,.2,1),border-color .3s ease,box-shadow .45s ease" style-hover="border-color:#17140f;transform:translateY(-6px);box-shadow:0 24px 50px -30px rgba(23,20,15,.5)">
              <div style="aspect-ratio:4/2.6;{{ n.bg }}"></div>
              <div style="padding:26px;display:flex;flex-direction:column;flex:1">
                <div style="display:flex;gap:14px;font-family:'Space Mono';font-size:12px;color:#9a8f7e"><span>{{ n.date }}</span><span style="color:{{ accent }}">{{ n.cat }}</span></div>
                <h3 style="margin:13px 0 0;font-family:Archivo;font-weight:700;font-size:22px;line-height:1.25">{{ n.title }}</h3>
                <p style="margin:12px 0 0;font-size:15px;line-height:1.6;color:#6b6356;flex:1">{{ n.excerpt }}</p>
                <span style="margin-top:18px;display:inline-flex;align-items:center;gap:10px;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.1em;text-transform:uppercase;color:#17140f">{{ t.newsPage.readMore }}<svg width="18" height="9" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.6"/></svg></span>
              </div>
            </div>
          </sc-for>
        </div>
      </div>
    </section>
  </div>
  </sc-if>

  <!-- ARTICLE / BLOG DETAIL -->
  <sc-if value="{{ isArticle }}" hint-placeholder-val="{{ false }}">
  <div>
    <section style="position:relative;height:60vh;min-height:440px;overflow:hidden;display:flex;align-items:flex-end">
      <div style="position:absolute;inset:0;{{ article.bg }}"></div>
      <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(20,17,12,.45),rgba(20,17,12,0) 40%,rgba(20,17,12,.85))"></div>
      <div style="position:relative;max-width:920px;width:100%;margin:0 auto;padding:0 clamp(20px,4vw,40px) clamp(40px,5vw,56px)">
        <div style="display:flex;gap:16px;font-family:'Space Mono';font-size:13px;color:rgba(255,255,255,.8);margin-bottom:14px"><span>{{ article.date }}</span><span style="color:{{ accent }}">{{ article.cat }}</span></div>
        <h1 style="margin:0;font-family:Archivo;font-weight:800;font-size:clamp(32px,4.4vw,58px);letter-spacing:-.025em;color:#fff;line-height:1.05;text-wrap:balance">{{ article.title }}</h1>
      </div>
    </section>
    <section style="background:#f6f3ed">
      <div style="max-width:760px;margin:0 auto;padding:clamp(46px,6vw,80px) clamp(20px,4vw,32px)">
        <span onClick="{{ goNews }}" style="display:inline-block;cursor:pointer;font-family:'Space Mono';font-size:13px;letter-spacing:.08em;color:#9a8f7e;margin-bottom:30px" style-hover="color:#17140f">{{ t.articlePage.back }}</span>
        <sc-for list="{{ article.body }}" as="b" hint-placeholder-count="3"><p style="margin:0 0 22px;font-size:18px;line-height:1.8;color:#39342c">{{ b.p }}</p></sc-for>
      </div>
    </section>
    <section style="background:#fff;border-top:1px solid #ece6da">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(56px,6vw,90px) clamp(20px,4vw,72px)">
        <h2 style="margin:0 0 34px;font-family:Archivo;font-weight:800;font-size:clamp(24px,2.8vw,38px);letter-spacing:-.02em">{{ t.articlePage.related }}</h2>
        <div style="display:grid;grid-template-columns:{{ g3 }};gap:26px">
          <sc-for list="{{ relatedArticles }}" as="n" hint-placeholder-count="3">
            <div onClick="{{ n.onClick }}" style="cursor:pointer">
              <div style="border-radius:14px;aspect-ratio:4/2.7;{{ n.bg }}"></div>
              <div style="display:flex;gap:12px;margin-top:16px;font-family:'Space Mono';font-size:12px;color:#9a8f7e"><span>{{ n.date }}</span><span style="color:{{ accent }}">{{ n.cat }}</span></div>
              <h3 style="margin:9px 0 0;font-family:Archivo;font-weight:700;font-size:20px;line-height:1.25">{{ n.title }}</h3>
            </div>
          </sc-for>
        </div>
      </div>
    </section>
  </div>
  </sc-if>

  <!-- CONTACT -->
  <sc-if value="{{ isContact }}" hint-placeholder-val="{{ false }}">
  <div>
    <section style="position:relative;height:54vh;min-height:400px;overflow:hidden;display:flex;align-items:flex-end">
      <div style="position:absolute;inset:0;background:url('uploads/7.png') center/cover"></div>
      <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(20,17,12,.45),rgba(20,17,12,0) 45%,rgba(20,17,12,.8))"></div>
      <div style="position:relative;max-width:1560px;width:100%;margin:0 auto;padding:0 clamp(20px,4vw,72px) clamp(40px,5vw,56px)"><span style="font-family:'Space Mono';font-size:12px;letter-spacing:.2em;color:rgba(255,255,255,.75);text-transform:uppercase">{{ t.contactPage.kicker }}</span><h1 style="margin:14px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(42px,5.6vw,80px);letter-spacing:-.03em;color:#fff">{{ t.nav.contact }}</h1></div>
    </section>
    <section style="background:#fff">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(54px,6vw,84px) clamp(20px,4vw,72px) clamp(40px,4vw,56px)">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px">
          <div style="background:#f6f3ed;border:1px solid #ece6da;border-radius:16px;padding:26px" style-hover="border-color:#17140f">
            <span style="display:flex;align-items:center;justify-content:center;width:46px;height:46px;border-radius:50%;background:{{ accent }};color:#fff"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 4h3l2 5-2.5 1.5a11 11 0 005 5L14 13l5 2v3a2 2 0 01-2 2A15 15 0 013 6a2 2 0 012-2z"/></svg></span>
            <div style="margin-top:18px;font-family:'Space Mono';font-size:11px;letter-spacing:.14em;color:#9a8f7e;text-transform:uppercase">{{ t.contactPage.phoneL }}</div>
            <div style="margin-top:7px;font-size:17px;line-height:1.5;color:#2c241b;font-weight:600">{{ phone }}</div>
          </div>
          <div style="background:#f6f3ed;border:1px solid #ece6da;border-radius:16px;padding:26px" style-hover="border-color:#17140f">
            <span style="display:flex;align-items:center;justify-content:center;width:46px;height:46px;border-radius:50%;background:{{ accent }};color:#fff"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></span>
            <div style="margin-top:18px;font-family:'Space Mono';font-size:11px;letter-spacing:.14em;color:#9a8f7e;text-transform:uppercase">{{ t.contactPage.emailL }}</div>
            <div style="margin-top:7px;font-size:17px;line-height:1.5;color:#2c241b;font-weight:600">{{ email }}</div>
          </div>
          <div style="background:#f6f3ed;border:1px solid #ece6da;border-radius:16px;padding:26px" style-hover="border-color:#17140f">
            <span style="display:flex;align-items:center;justify-content:center;width:46px;height:46px;border-radius:50%;background:{{ accent }};color:#fff"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.5 7-11a7 7 0 10-14 0c0 5.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
            <div style="margin-top:18px;font-family:'Space Mono';font-size:11px;letter-spacing:.14em;color:#9a8f7e;text-transform:uppercase">{{ t.contactPage.addressL }}</div>
            <div style="margin-top:7px;font-size:15px;line-height:1.5;color:#2c241b;font-weight:600">{{ address }}</div>
          </div>
          <div style="background:#f6f3ed;border:1px solid #ece6da;border-radius:16px;padding:26px" style-hover="border-color:#17140f">
            <span style="display:flex;align-items:center;justify-content:center;width:46px;height:46px;border-radius:50%;background:{{ accent }};color:#fff"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
            <div style="margin-top:18px;font-family:'Space Mono';font-size:11px;letter-spacing:.14em;color:#9a8f7e;text-transform:uppercase">{{ t.contactPage.hoursL }}</div>
            <div style="margin-top:7px;font-size:15px;line-height:1.5;color:#2c241b;font-weight:600">{{ hours }}</div>
          </div>
        </div>
      </div>
    </section>
    <section style="background:#fff">
      <div style="max-width:1560px;margin:0 auto;padding:0 clamp(20px,4vw,72px) clamp(64px,8vw,110px);display:grid;grid-template-columns:{{ gContact }};gap:clamp(30px,4vw,56px);align-items:stretch">
        <div style="background:#f6f3ed;border-radius:20px;padding:clamp(28px,3vw,46px)">
          <span style="{{ kickerStyle }}">{{ t.contactPage.formTitle }}</span>
          <div style="font-family:'Dancing Script',cursive;font-weight:600;font-size:clamp(30px,3.4vw,40px);color:{{ accent }};line-height:1;margin-top:8px">{{ scriptContact }}</div>
          <p style="margin:14px 0 26px;font-size:16px;line-height:1.7;color:#5d564b;max-width:440px">{{ t.contactPage.intro }}</p>
          <sc-if value="{{ sent }}" hint-placeholder-val="{{ false }}"><div style="padding:30px 4px"><div style="font-family:Archivo;font-weight:800;font-size:24px">{{ t.thanks }}</div></div></sc-if>
          <sc-if value="{{ notSent }}" hint-placeholder-val="{{ true }}">
            <div style="display:grid;grid-template-columns:{{ g2 }};gap:14px">
              <input placeholder="{{ t.form.name }}" style="grid-column:1/-1;border:1px solid #d8cfc0;background:#fff;border-radius:10px;padding:16px 18px;font-size:15px;outline:none"/>
              <input placeholder="{{ t.form.email }}" style="border:1px solid #d8cfc0;background:#fff;border-radius:10px;padding:16px 18px;font-size:15px;outline:none"/>
              <input placeholder="{{ t.form.phone }}" style="border:1px solid #d8cfc0;background:#fff;border-radius:10px;padding:16px 18px;font-size:15px;outline:none"/>
              <textarea placeholder="{{ t.form.msg }}" rows="5" style="grid-column:1/-1;border:1px solid #d8cfc0;background:#fff;border-radius:10px;padding:16px 18px;font-size:15px;outline:none;resize:none"></textarea>
              <button onClick="{{ sendForm }}" style="grid-column:1/-1;justify-self:start;display:inline-flex;align-items:center;gap:12px;background:#17140f;color:#fff;border:none;cursor:pointer;padding:16px 32px;border-radius:999px;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.13em;text-transform:uppercase">{{ t.cta.send }}<svg width="20" height="9" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg></button>
            </div>
          </sc-if>
        </div>
        <div style="border-radius:20px;overflow:hidden;min-height:440px;position:relative;background:linear-gradient(135deg,#dcd4c6,#c2b6a0)">
          <div style="position:absolute;inset:0;background:url('uploads/8.png') center/cover;opacity:.28"></div>
          <div style="position:absolute;left:24px;bottom:24px;right:24px;background:rgba(21,18,13,.86);color:#f3ece0;border-radius:14px;padding:22px 24px">
            <div style="font-family:'Space Mono';font-size:11px;letter-spacing:.14em;color:{{ accent }};text-transform:uppercase">{{ t.contactPage.hqLabel }}</div>
            <div style="margin-top:8px;font-size:15px;line-height:1.6">{{ address }}</div>
          </div>
          <span style="position:absolute;top:20px;left:24px;font-family:'Space Mono';font-size:11px;color:#5e5444;text-transform:uppercase;letter-spacing:.08em">{{ t.contactPage.mapLabel }}</span>
        </div>
      </div>
    </section>
  </div>
  </sc-if>

  <!-- DEALERS -->
  <sc-if value="{{ isDealers }}" hint-placeholder-val="{{ false }}">
  <div>
    <section style="position:relative;height:56vh;min-height:420px;overflow:hidden;display:flex;align-items:flex-end">
      <div style="position:absolute;inset:0;background:url('uploads/1.png') center/cover"></div>
      <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(20,17,12,.45),rgba(20,17,12,0) 45%,rgba(20,17,12,.82))"></div>
      <div style="position:relative;max-width:1560px;width:100%;margin:0 auto;padding:0 clamp(20px,4vw,72px) clamp(40px,5vw,56px)">
        <span style="font-family:'Space Mono';font-size:12px;letter-spacing:.2em;color:rgba(255,255,255,.75);text-transform:uppercase">{{ t.dealersPage.kicker }}</span>
        <h1 style="margin:14px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(42px,5.6vw,80px);letter-spacing:-.03em;color:#fff">{{ t.dealersPage.title }}</h1>
        <p style="margin:18px 0 0;font-size:clamp(15px,2vw,18px);line-height:1.6;color:rgba(246,243,237,.86);max-width:560px">{{ t.dealersPage.intro }}</p>
      </div>
    </section>
    <section style="background:#f6f3ed">
      <div style="max-width:1560px;margin:0 auto;padding:clamp(46px,5vw,72px) clamp(20px,4vw,72px) clamp(40px,4vw,56px)">
        <div style="border-radius:20px;overflow:hidden;min-height:380px;position:relative;background:linear-gradient(135deg,#dcd4c6,#c2b6a0)">
          <div style="position:absolute;inset:0;background:url('uploads/8.png') center/cover;opacity:.3"></div>
          <span style="position:absolute;left:24px;top:24px;font-family:'Space Mono';font-size:12px;color:#5e5444;text-transform:uppercase;letter-spacing:.08em">{{ t.dealersPage.mapLabel }}</span>
        </div>
      </div>
    </section>
    <section style="background:#f6f3ed">
      <div style="max-width:1560px;margin:0 auto;padding:0 clamp(20px,4vw,72px) clamp(70px,9vw,120px)">
        <h2 style="margin:0 0 30px;font-family:Archivo;font-weight:800;font-size:clamp(24px,2.8vw,38px);letter-spacing:-.02em">{{ t.dealersPage.allT }}</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:18px">
          <sc-for list="{{ dealers }}" as="d" hint-placeholder-count="6">
            <div style="background:#fff;border:1px solid #ece6da;border-radius:16px;padding:26px 28px">
              <div style="font-family:Archivo;font-weight:700;font-size:20px">{{ d.city }}</div>
              <div style="margin-top:8px;font-size:15px;color:#6b6356;line-height:1.55">{{ d.addr }}</div>
              <div style="margin-top:14px;font-family:Archivo;font-weight:700;font-size:16px;color:{{ accent }}">{{ d.tel }}</div>
            </div>
          </sc-for>
        </div>
      </div>
    </section>
  </div>
  </sc-if>

  <!-- FAQ -->
  <sc-if value="{{ isFaq }}" hint-placeholder-val="{{ false }}">
  <div style="background:#f6f3ed">
    <section style="background:#f6f3ed;border-bottom:1px solid #ece6da">
      <div style="max-width:900px;margin:0 auto;padding:clamp(110px,13vh,150px) clamp(20px,4vw,40px) clamp(36px,4vw,52px);text-align:center">
        <span style="{{ kickerStyle }}">{{ faqKicker }}</span>
        <h1 style="margin:16px 0 0;font-family:Archivo;font-weight:800;font-size:clamp(38px,5vw,68px);letter-spacing:-.03em">{{ faqTitle }}</h1>
        <p style="margin:18px auto 0;font-size:18px;line-height:1.6;color:#5d564b;max-width:560px">{{ faqIntro }}</p>
      </div>
    </section>
    <section style="background:#f6f3ed">
      <div style="max-width:900px;margin:0 auto;padding:clamp(40px,5vw,64px) clamp(20px,4vw,40px) clamp(70px,9vw,120px);display:flex;flex-direction:column;gap:14px">
        <sc-for list="{{ faqItems }}" as="f" hint-placeholder-count="5">
          <div onClick="{{ f.onClick }}" style="{{ f.rowStyle }}">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:18px">
              <h3 style="margin:0;font-family:Archivo;font-weight:700;font-size:clamp(17px,2vw,20px);color:#17140f">{{ f.q }}</h3>
              <span style="{{ f.iconStyle }};flex:none;color:{{ accent }}"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M9 2v14M2 9h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
            </div>
            <div style="{{ f.aStyle }}"><p style="margin:0;font-size:16px;line-height:1.75;color:#5d564b">{{ f.a }}</p></div>
          </div>
        </sc-for>
      </div>
    </section>
  </div>
  </sc-if>

  <!-- LEGAL -->
  <sc-if value="{{ isLegal }}" hint-placeholder-val="{{ false }}">
  <div style="background:#f6f3ed">
    <div style="max-width:1560px;margin:0 auto;padding:clamp(54px,7vw,90px) clamp(20px,4vw,72px) clamp(70px,9vw,120px);display:grid;grid-template-columns:280px 1fr;gap:clamp(36px,5vw,80px)">
      <aside><div style="font-family:'Space Mono';font-size:12px;letter-spacing:.16em;color:#9a8f7e;text-transform:uppercase;margin-bottom:18px">{{ t.legalPage.label }}</div><div style="display:flex;flex-direction:column;gap:4px"><sc-for list="{{ legalNav }}" as="l" hint-placeholder-count="3"><span onClick="{{ l.onClick }}" style="{{ l.style }}">{{ l.label }}</span></sc-for></div></aside>
      <article style="background:#fff;border:1px solid #ece6da;border-radius:18px;padding:clamp(32px,4vw,64px)"><h1 style="margin:0;font-family:Archivo;font-weight:800;font-size:clamp(30px,3.6vw,48px);letter-spacing:-.025em">{{ legalDoc.title }}</h1><div style="margin:14px 0 36px;font-family:'Space Mono';font-size:13px;color:#9a8f7e">{{ legalDoc.updated }}</div><sc-for list="{{ legalDoc.sections }}" as="s" hint-placeholder-count="4"><div style="margin-top:30px;padding-top:28px;border-top:1px solid #efe9dd"><h2 style="{{ s.hStyle }};margin:0 0 12px;font-family:Archivo;font-weight:700;font-size:21px;letter-spacing:-.01em">{{ s.h }}</h2><p style="margin:0;font-size:16px;line-height:1.85;color:#4d473e">{{ s.p }}</p></div></sc-for></article>
    </div>
  </div>
  </sc-if>

  <!-- ADMIN -->
  <sc-if value="{{ isAdmin }}" hint-placeholder-val="{{ false }}">
  <div>
  <sc-if value="{{ adminLocked }}" hint-placeholder-val="{{ true }}">
  <div style="min-height:100vh;background:#141414;display:flex;align-items:center;justify-content:center;padding:24px;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background:url('uploads/3.png') center/cover;opacity:.08"></div>
    <div style="position:relative;width:100%;max-width:380px;background:#1c1a17;border:1px solid #2a2722;border-radius:18px;padding:38px 34px;text-align:center">
      <div style="display:flex;align-items:baseline;gap:9px;justify-content:center"><span style="font-family:Archivo;font-weight:900;font-size:26px;color:#fff;letter-spacing:-.04em">AWA</span><span style="font-family:'Space Mono';font-size:11px;letter-spacing:.3em;color:#8a8170">PANEL</span></div>
      <div style="margin-top:8px;font-size:13px;color:#8a8170">Yönetim paneline giriş yapın</div>
      <input type="password" value="{{ adminPwd }}" onChange="{{ setAdminPwd }}" placeholder="Şifre" style="margin-top:26px;width:100%;background:#0f0e0c;border:1px solid #38332b;border-radius:10px;padding:14px 16px;color:#ece6da;font-size:15px;outline:none;text-align:center"/>
      <sc-if value="{{ adminErr }}" hint-placeholder-val="{{ false }}"><div style="margin-top:12px;font-size:13px;color:#d98a8a">Şifre hatalı. Tekrar deneyin.</div></sc-if>
      <button onClick="{{ submitAdminPwd }}" style="margin-top:18px;width:100%;background:#c9b98f;color:#1a1610;border:none;cursor:pointer;padding:14px;border-radius:10px;font-family:Archivo;font-weight:700;font-size:13px;letter-spacing:.06em">GİRİŞ YAP</button>
      <div style="margin-top:18px;font-family:'Space Mono';font-size:11px;color:#5f574a">Varsayılan şifre: 0000</div>
      <div onClick="{{ goHome }}" style="margin-top:14px;cursor:pointer;font-size:13px;color:#8a8170" style-hover="color:#cabfae">‹ Siteye dön</div>
    </div>
  </div>
  </sc-if>
  <sc-if value="{{ adminAuthed }}" hint-placeholder-val="{{ false }}">
  <div style="background:#141414;min-height:100vh;color:#e9e2d5;font-size:14px">
    <div style="background:#0c0c0c;border-bottom:1px solid #262320;padding:18px clamp(20px,4vw,40px);display:flex;align-items:center;justify-content:space-between;gap:20px;position:sticky;top:0;z-index:5">
      <div style="display:flex;align-items:baseline;gap:10px"><span style="font-family:Archivo;font-weight:900;font-size:20px;color:#fff">AWA</span><span style="font-family:'Space Mono';font-size:12px;letter-spacing:.18em;color:#8a8170">YÖNETİM PANELİ</span></div>
      <div style="display:flex;gap:12px"><span onClick="{{ resetData }}" style="cursor:pointer;border:1px solid #3a352e;color:#cabfae;padding:9px 18px;border-radius:8px;font-size:13px;font-weight:600" style-hover="border-color:#6a5f4d">{{ t.admin.reset }}</span><span onClick="{{ goHome }}" style="cursor:pointer;background:#c9b98f;color:#1a1610;padding:9px 18px;border-radius:8px;font-size:13px;font-weight:700">{{ t.admin.viewSite }}</span><span onClick="{{ adminLogout }}" style="cursor:pointer;border:1px solid #3a352e;color:#cabfae;padding:9px 18px;border-radius:8px;font-size:13px;font-weight:600" style-hover="border-color:#6a5f4d">Çıkış</span></div>
    </div>
    <div style="display:grid;grid-template-columns:230px 1fr">
      <aside style="border-right:1px solid #262320;min-height:calc(100vh - 61px);padding:24px 16px;position:sticky;top:61px;align-self:start">
        <sc-for list="{{ adminTabs }}" as="a" hint-placeholder-count="4"><div onClick="{{ a.onClick }}" style="{{ a.style }}"><span>{{ a.label }}</span><span style="font-family:'Space Mono';font-size:11px;opacity:.5">{{ a.count }}</span></div></sc-for>
        <div style="margin-top:24px;padding:16px;border:1px solid #262320;border-radius:10px;font-size:12px;color:#8a8170;line-height:1.6">{{ t.admin.note }}</div>
      </aside>
      <main style="padding:clamp(24px,3vw,44px);max-width:1100px">
        <sc-if value="{{ tabDashboard }}" hint-placeholder-val="{{ true }}">
        <div>
          <span style="font-family:'Space Mono';font-size:11px;letter-spacing:.16em;color:#c9b98f;text-transform:uppercase">{{ t.admin.welcome }}</span>
          <h1 style="margin:10px 0 4px;font-family:Archivo;font-weight:800;font-size:30px;color:#fff">{{ t.admin.dashboard }}</h1>
          <p style="margin:0;font-size:14px;color:#8a8170">{{ t.admin.welcomeSub }}</p>
          <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:14px;margin-top:26px">
            <sc-for list="{{ adminStats }}" as="st" hint-placeholder-count="5">
              <div onClick="{{ st.onClick }}" style="cursor:pointer;background:#1c1a17;border:1px solid #2a2722;border-radius:14px;padding:22px" style-hover="border-color:#c9b98f">
                <div style="font-family:Archivo;font-weight:800;font-size:38px;color:#fff;line-height:1">{{ st.n }}</div>
                <div style="margin-top:8px;font-size:13px;color:#9a8f7e">{{ st.label }}</div>
              </div>
            </sc-for>
          </div>
          <div style="display:grid;grid-template-columns:{{ g2 }};gap:18px;margin-top:24px">
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;padding:24px">
              <div style="font-family:Archivo;font-weight:700;font-size:18px;color:#fff;margin-bottom:16px">{{ t.admin.recent }}</div>
              <div style="display:flex;flex-direction:column;gap:10px">
                <sc-for list="{{ dashRecent }}" as="r" hint-placeholder-count="4">
                  <div onClick="{{ r.onClick }}" style="cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:12px;padding:12px 14px;border:1px solid #262320;border-radius:10px" style-hover="border-color:#4a443b"><span style="font-size:14px;color:#e9e2d5">{{ r.title }}</span><span style="font-family:'Space Mono';font-size:11px;color:#7a7060">{{ r.date }}</span></div>
                </sc-for>
              </div>
            </div>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;padding:24px">
              <div style="font-family:Archivo;font-weight:700;font-size:18px;color:#fff;margin-bottom:16px">{{ t.admin.shortcuts }}</div>
              <div style="display:flex;flex-direction:column;gap:10px">
                <sc-for list="{{ dashShortcuts }}" as="sc" hint-placeholder-count="4">
                  <span onClick="{{ sc.onClick }}" style="cursor:pointer;display:flex;align-items:center;gap:12px;padding:13px 16px;background:#0f0e0c;border:1px solid #2a2722;border-radius:10px;font-size:14px;font-weight:600;color:#cabfae" style-hover="border-color:#c9b98f"><span style="color:#c9b98f;font-size:16px">+</span>{{ sc.label }}</span>
                </sc-for>
              </div>
            </div>
          </div>
        </div>
        </sc-if>

        <sc-if value="{{ tabSlides }}" hint-placeholder-val="{{ false }}">
        <div>
          <sc-if value="{{ adminListing }}" hint-placeholder-val="{{ true }}">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:22px"><h1 style="margin:0;font-family:Archivo;font-weight:800;font-size:28px;color:#fff">{{ t.admin.slides }}</h1><span onClick="{{ addSlide }}" style="cursor:pointer;background:#c9b98f;color:#1a1610;padding:11px 20px;border-radius:8px;font-weight:700;font-size:13px">+ {{ t.admin.addSlide }}</span></div>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;overflow:hidden">
              <div style="display:grid;grid-template-columns:90px 1fr 1fr 150px;gap:14px;padding:14px 20px;border-bottom:1px solid #2a2722;font-family:'Space Mono';font-size:10px;letter-spacing:.1em;color:#7a7060;text-transform:uppercase"><span>GÖRSEL</span><span>ÜST BAŞLIK</span><span>SUBTITLE</span><span style="text-align:right">İŞLEM</span></div>
              <sc-for list="{{ adminSlides }}" as="sl" hint-placeholder-count="3">
                <div style="display:grid;grid-template-columns:90px 1fr 1fr 150px;gap:14px;padding:14px 20px;border-bottom:1px solid #232019;align-items:center">
                  <div style="width:74px;height:46px;border-radius:7px;{{ sl.thumb }};border:1px solid #2a2722"></div>
                  <span style="font-size:14px;font-weight:600;color:#ece6da">{{ sl.subTr }}</span>
                  <span style="font-size:13px;color:#9a8f7e">{{ sl.subEn }}</span>
                  <div style="display:flex;gap:8px;justify-content:flex-end">
                    <span onClick="{{ sl.onEdit }}" style="cursor:pointer;padding:8px 14px;border-radius:7px;border:1px solid #38332b;color:#cabfae;font-size:12px;font-weight:600" style-hover="border-color:#c9b98f">Düzenle</span>
                    <span onClick="{{ sl.onDel }}" style="cursor:pointer;width:34px;height:34px;border-radius:7px;border:1px solid #4a2a2a;color:#d98a8a;display:flex;align-items:center;justify-content:center;font-size:17px" style-hover="background:#3a1f1f">×</span>
                  </div>
                </div>
              </sc-for>
            </div>
          </div>
          </sc-if>
          <sc-if value="{{ adminEditing }}" hint-placeholder-val="{{ false }}">
          <div style="max-width:780px">
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:22px"><span onClick="{{ closeEdit }}" style="cursor:pointer;font-family:'Space Mono';font-size:13px;color:#9a8f7e" style-hover="color:#cabfae">‹ {{ t.admin.slides }}</span></div>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;padding:24px;display:flex;flex-direction:column;gap:16px">
              <div style="display:grid;grid-template-columns:{{ g2 }};gap:16px">
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">GÖRSEL</div><select value="{{ editSlide.img }}" onChange="{{ editSlide.onImg }}" style="{{ adminInput }}"><sc-for list="{{ imageOptions }}" as="o" hint-placeholder-count="9"><option value="{{ o.v }}">{{ o.label }}</option></sc-for></select></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">BAĞLI ÜRÜN</div><select value="{{ editSlide.productId }}" onChange="{{ editSlide.onProduct }}" style="{{ adminInput }}"><sc-for list="{{ productOptions }}" as="o" hint-placeholder-count="6"><option value="{{ o.id }}">{{ o.label }}</option></sc-for></select></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ÜST BAŞLIK (TR)</div><input value="{{ editSlide.subTr }}" onChange="{{ editSlide.onSubTr }}" style="{{ adminInput }}"/></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">SUBTITLE (EN)</div><input value="{{ editSlide.subEn }}" onChange="{{ editSlide.onSubEn }}" style="{{ adminInput }}"/></div>
              </div>
              <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap">
                <div style="width:140px;height:80px;border-radius:8px;{{ editSlide.thumb }};border:1px solid #2a2722"></div>
                <label style="display:inline-flex;align-items:center;gap:9px;cursor:pointer;color:#cabfae;font-size:12px;font-family:'Space Mono';border:1px solid #38332b;border-radius:8px;padding:10px 16px"><span style="color:#c9b98f;font-size:15px">+</span>{{ t.uploadL }}<input type="file" accept="image/*" onChange="{{ editSlide.onFile }}" style="display:none"/></label>
              </div>
              <div style="display:flex;gap:12px;margin-top:6px"><span onClick="{{ closeEdit }}" style="cursor:pointer;background:#c9b98f;color:#1a1610;padding:12px 26px;border-radius:8px;font-weight:700;font-size:13px">Kaydet & Kapat</span></div>
            </div>
          </div>
          </sc-if>
        </div>
        </sc-if>

        <sc-if value="{{ tabProducts }}" hint-placeholder-val="{{ false }}">
        <div>
          <sc-if value="{{ adminListing }}" hint-placeholder-val="{{ true }}">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:22px"><h1 style="margin:0;font-family:Archivo;font-weight:800;font-size:28px;color:#fff">{{ t.admin.products }}</h1><span onClick="{{ addProduct }}" style="cursor:pointer;background:#c9b98f;color:#1a1610;padding:11px 20px;border-radius:8px;font-weight:700;font-size:13px">+ {{ t.admin.addProduct }}</span></div>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;overflow:hidden">
              <div style="display:grid;grid-template-columns:80px 1fr 1fr 150px;gap:14px;padding:14px 20px;border-bottom:1px solid #2a2722;font-family:'Space Mono';font-size:10px;letter-spacing:.1em;color:#7a7060;text-transform:uppercase"><span>GÖRSEL</span><span>AD (TR)</span><span>KATEGORİ</span><span style="text-align:right">İŞLEM</span></div>
              <sc-for list="{{ adminProducts }}" as="p" hint-placeholder-count="4">
                <div style="display:grid;grid-template-columns:80px 1fr 1fr 150px;gap:14px;padding:14px 20px;border-bottom:1px solid #232019;align-items:center">
                  <div style="width:64px;height:46px;border-radius:7px;{{ p.thumb }};border:1px solid #2a2722"></div>
                  <span style="font-size:15px;font-weight:600;color:#ece6da">{{ p.tr }}</span>
                  <span style="font-size:14px;color:#9a8f7e">{{ p.catName }}</span>
                  <div style="display:flex;gap:8px;justify-content:flex-end">
                    <span onClick="{{ p.onEdit }}" style="cursor:pointer;padding:8px 14px;border-radius:7px;border:1px solid #38332b;color:#cabfae;font-size:12px;font-weight:600" style-hover="border-color:#c9b98f">Düzenle</span>
                    <span onClick="{{ p.onDel }}" style="cursor:pointer;width:34px;height:34px;border-radius:7px;border:1px solid #4a2a2a;color:#d98a8a;display:flex;align-items:center;justify-content:center;font-size:17px" style-hover="background:#3a1f1f">×</span>
                  </div>
                </div>
              </sc-for>
            </div>
          </div>
          </sc-if>
          <sc-if value="{{ adminEditing }}" hint-placeholder-val="{{ false }}">
          <div style="max-width:780px">
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:22px"><span onClick="{{ closeEdit }}" style="cursor:pointer;font-family:'Space Mono';font-size:13px;color:#9a8f7e" style-hover="color:#cabfae">‹ {{ t.admin.products }}</span></div>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;padding:24px;display:flex;flex-direction:column;gap:16px">
              <div style="display:grid;grid-template-columns:{{ g2 }};gap:16px">
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">AD (TR)</div><input value="{{ editProduct.tr }}" onChange="{{ editProduct.onTr }}" style="{{ adminInput }}"/></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">NAME (EN)</div><input value="{{ editProduct.en }}" onChange="{{ editProduct.onEn }}" style="{{ adminInput }}"/></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">KATEGORİ</div><select value="{{ editProduct.cat }}" onChange="{{ editProduct.onCat }}" style="{{ adminInput }}"><sc-for list="{{ catOptions }}" as="o" hint-placeholder-count="4"><option value="{{ o.id }}">{{ o.label }}</option></sc-for></select></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">GÖRSEL</div><select value="{{ editProduct.img }}" onChange="{{ editProduct.onImg }}" style="{{ adminInput }}"><sc-for list="{{ imageOptions }}" as="o" hint-placeholder-count="9"><option value="{{ o.v }}">{{ o.label }}</option></sc-for></select></div>
              </div>
              <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap">
                <div style="width:120px;height:80px;border-radius:8px;{{ editProduct.thumb }};border:1px solid #2a2722"></div>
                <label style="display:inline-flex;align-items:center;gap:9px;cursor:pointer;color:#cabfae;font-size:12px;font-family:'Space Mono';border:1px solid #38332b;border-radius:8px;padding:10px 16px"><span style="color:#c9b98f;font-size:15px">+</span>{{ t.uploadL }}<input type="file" accept="image/*" onChange="{{ editProduct.onFile }}" style="display:none"/></label>
              </div>
              <div style="display:flex;gap:12px;margin-top:6px"><span onClick="{{ closeEdit }}" style="cursor:pointer;background:#c9b98f;color:#1a1610;padding:12px 26px;border-radius:8px;font-weight:700;font-size:13px">Kaydet & Kapat</span></div>
            </div>
          </div>
          </sc-if>
        </div>
        </sc-if>

        <sc-if value="{{ tabCategories }}" hint-placeholder-val="{{ false }}">
        <div>
          <sc-if value="{{ adminListing }}" hint-placeholder-val="{{ true }}">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:22px"><h1 style="margin:0;font-family:Archivo;font-weight:800;font-size:28px;color:#fff">{{ t.admin.categories }}</h1><span onClick="{{ addCategory }}" style="cursor:pointer;background:#c9b98f;color:#1a1610;padding:11px 20px;border-radius:8px;font-weight:700;font-size:13px">+ {{ t.admin.addCategory }}</span></div>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;overflow:hidden">
              <div style="display:grid;grid-template-columns:80px 1fr 90px 150px;gap:14px;padding:14px 20px;border-bottom:1px solid #2a2722;font-family:'Space Mono';font-size:10px;letter-spacing:.1em;color:#7a7060;text-transform:uppercase"><span>GÖRSEL</span><span>AD (TR)</span><span>ÜRÜN</span><span style="text-align:right">İŞLEM</span></div>
              <sc-for list="{{ adminCategories }}" as="k" hint-placeholder-count="4">
                <div style="display:grid;grid-template-columns:80px 1fr 90px 150px;gap:14px;padding:14px 20px;border-bottom:1px solid #232019;align-items:center">
                  <div style="width:64px;height:46px;border-radius:7px;{{ k.thumb }};border:1px solid #2a2722"></div>
                  <span style="font-size:15px;font-weight:600;color:#ece6da">{{ k.tr }}</span>
                  <span style="font-size:14px;color:#9a8f7e">{{ k.count }}</span>
                  <div style="display:flex;gap:8px;justify-content:flex-end">
                    <span onClick="{{ k.onEdit }}" style="cursor:pointer;padding:8px 14px;border-radius:7px;border:1px solid #38332b;color:#cabfae;font-size:12px;font-weight:600" style-hover="border-color:#c9b98f">Düzenle</span>
                    <span onClick="{{ k.onDel }}" style="cursor:pointer;width:34px;height:34px;border-radius:7px;border:1px solid #4a2a2a;color:#d98a8a;display:flex;align-items:center;justify-content:center;font-size:17px" style-hover="background:#3a1f1f">×</span>
                  </div>
                </div>
              </sc-for>
            </div>
          </div>
          </sc-if>
          <sc-if value="{{ adminEditing }}" hint-placeholder-val="{{ false }}">
          <div style="max-width:780px">
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:22px"><span onClick="{{ closeEdit }}" style="cursor:pointer;font-family:'Space Mono';font-size:13px;color:#9a8f7e" style-hover="color:#cabfae">‹ {{ t.admin.categories }}</span></div>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;padding:24px;display:flex;flex-direction:column;gap:16px">
              <div style="display:grid;grid-template-columns:{{ g2 }};gap:16px">
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">AD (TR)</div><input value="{{ editCategory.tr }}" onChange="{{ editCategory.onTr }}" style="{{ adminInput }}"/></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">NAME (EN)</div><input value="{{ editCategory.en }}" onChange="{{ editCategory.onEn }}" style="{{ adminInput }}"/></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">AÇIKLAMA (TR)</div><textarea rows="3" onChange="{{ editCategory.onDTr }}" style="{{ adminInput }};resize:vertical" value="{{ editCategory.dTr }}"></textarea></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">DESCRIPTION (EN)</div><textarea rows="3" onChange="{{ editCategory.onDEn }}" style="{{ adminInput }};resize:vertical" value="{{ editCategory.dEn }}"></textarea></div>
              </div>
              <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap">
                <div style="flex:1;min-width:200px"><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">GÖRSEL</div><select value="{{ editCategory.img }}" onChange="{{ editCategory.onImg }}" style="{{ adminInput }}"><sc-for list="{{ imageOptions }}" as="o" hint-placeholder-count="9"><option value="{{ o.v }}">{{ o.label }}</option></sc-for></select></div>
                <div style="width:120px;height:80px;border-radius:8px;{{ editCategory.thumb }};border:1px solid #2a2722"></div>
                <label style="display:inline-flex;align-items:center;gap:9px;cursor:pointer;color:#cabfae;font-size:12px;font-family:'Space Mono';border:1px solid #38332b;border-radius:8px;padding:10px 16px"><span style="color:#c9b98f;font-size:15px">+</span>{{ t.uploadL }}<input type="file" accept="image/*" onChange="{{ editCategory.onFile }}" style="display:none"/></label>
              </div>
              <div style="display:flex;gap:12px;margin-top:6px"><span onClick="{{ closeEdit }}" style="cursor:pointer;background:#c9b98f;color:#1a1610;padding:12px 26px;border-radius:8px;font-weight:700;font-size:13px">Kaydet & Kapat</span></div>
            </div>
          </div>
          </sc-if>
        </div>
        </sc-if>

        <sc-if value="{{ tabNews }}" hint-placeholder-val="{{ false }}">
        <div>
          <sc-if value="{{ adminListing }}" hint-placeholder-val="{{ true }}">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:22px"><h1 style="margin:0;font-family:Archivo;font-weight:800;font-size:28px;color:#fff">{{ t.admin.news }}</h1><span onClick="{{ addNews }}" style="cursor:pointer;background:#c9b98f;color:#1a1610;padding:11px 20px;border-radius:8px;font-weight:700;font-size:13px">+ {{ t.admin.addNews }}</span></div>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;overflow:hidden">
              <div style="display:grid;grid-template-columns:120px 1fr 130px 150px;gap:14px;padding:14px 20px;border-bottom:1px solid #2a2722;font-family:'Space Mono';font-size:10px;letter-spacing:.1em;color:#7a7060;text-transform:uppercase"><span>TARİH</span><span>BAŞLIK (TR)</span><span>ETİKET</span><span style="text-align:right">İŞLEM</span></div>
              <sc-for list="{{ adminNews }}" as="n" hint-placeholder-count="3">
                <div style="display:grid;grid-template-columns:120px 1fr 130px 150px;gap:14px;padding:14px 20px;border-bottom:1px solid #232019;align-items:center">
                  <span style="font-family:'Space Mono';font-size:13px;color:#9a8f7e">{{ n.date }}</span>
                  <span style="font-size:15px;font-weight:600;color:#ece6da">{{ n.tr }}</span>
                  <span style="font-size:13px;color:#c9b98f">{{ n.catTr }}</span>
                  <div style="display:flex;gap:8px;justify-content:flex-end">
                    <span onClick="{{ n.onEdit }}" style="cursor:pointer;padding:8px 14px;border-radius:7px;border:1px solid #38332b;color:#cabfae;font-size:12px;font-weight:600" style-hover="border-color:#c9b98f">Düzenle</span>
                    <span onClick="{{ n.onDel }}" style="cursor:pointer;width:34px;height:34px;border-radius:7px;border:1px solid #4a2a2a;color:#d98a8a;display:flex;align-items:center;justify-content:center;font-size:17px" style-hover="background:#3a1f1f">×</span>
                  </div>
                </div>
              </sc-for>
            </div>
          </div>
          </sc-if>
          <sc-if value="{{ adminEditing }}" hint-placeholder-val="{{ false }}">
          <div style="max-width:820px">
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:22px"><span onClick="{{ closeEdit }}" style="cursor:pointer;font-family:'Space Mono';font-size:13px;color:#9a8f7e" style-hover="color:#cabfae">‹ {{ t.admin.news }}</span></div>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;padding:24px;display:flex;flex-direction:column;gap:16px">
              <div style="display:grid;grid-template-columns:140px 1fr 1fr;gap:16px">
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">TARİH</div><input value="{{ editNews.date }}" onChange="{{ editNews.onDate }}" style="{{ adminInput }}"/></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ETİKET (TR)</div><input value="{{ editNews.catTr }}" onChange="{{ editNews.onCatTr }}" style="{{ adminInput }}"/></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">LABEL (EN)</div><input value="{{ editNews.catEn }}" onChange="{{ editNews.onCatEn }}" style="{{ adminInput }}"/></div>
              </div>
              <div style="display:grid;grid-template-columns:{{ g2 }};gap:16px">
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">BAŞLIK (TR)</div><input value="{{ editNews.tr }}" onChange="{{ editNews.onTr }}" style="{{ adminInput }}"/></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">TITLE (EN)</div><input value="{{ editNews.en }}" onChange="{{ editNews.onEn }}" style="{{ adminInput }}"/></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ÖZET (TR)</div><textarea rows="2" onChange="{{ editNews.onExTr }}" style="{{ adminInput }};resize:none" value="{{ editNews.exTr }}"></textarea></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">EXCERPT (EN)</div><textarea rows="2" onChange="{{ editNews.onExEn }}" style="{{ adminInput }};resize:none" value="{{ editNews.exEn }}"></textarea></div>
                <div style="grid-column:1/-1"><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">{{ t.admin.body }} (TR)</div><textarea rows="6" onChange="{{ editNews.onBodyTr }}" style="{{ adminInput }};resize:vertical" value="{{ editNews.bodyTr }}"></textarea></div>
                <div style="grid-column:1/-1"><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">{{ t.admin.body }} (EN)</div><textarea rows="6" onChange="{{ editNews.onBodyEn }}" style="{{ adminInput }};resize:vertical" value="{{ editNews.bodyEn }}"></textarea></div>
              </div>
              <div style="display:flex;gap:12px;margin-top:6px"><span onClick="{{ closeEdit }}" style="cursor:pointer;background:#c9b98f;color:#1a1610;padding:12px 26px;border-radius:8px;font-weight:700;font-size:13px">Kaydet & Kapat</span></div>
            </div>
          </div>
          </sc-if>
        </div>
        </sc-if>

        <sc-if value="{{ tabDealers }}" hint-placeholder-val="{{ false }}">
        <div>
          <sc-if value="{{ adminListing }}" hint-placeholder-val="{{ true }}">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:22px"><h1 style="margin:0;font-family:Archivo;font-weight:800;font-size:28px;color:#fff">{{ t.admin.dealers }}</h1><span onClick="{{ addDealer }}" style="cursor:pointer;background:#c9b98f;color:#1a1610;padding:11px 20px;border-radius:8px;font-weight:700;font-size:13px">+ {{ t.admin.addDealer }}</span></div>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;overflow:hidden">
              <div style="display:grid;grid-template-columns:1fr 1fr 150px 150px;gap:14px;padding:14px 20px;border-bottom:1px solid #2a2722;font-family:'Space Mono';font-size:10px;letter-spacing:.1em;color:#7a7060;text-transform:uppercase"><span>ŞEHİR / BAYİ</span><span>ADRES</span><span>TELEFON</span><span style="text-align:right">İŞLEM</span></div>
              <sc-for list="{{ adminDealers }}" as="d" hint-placeholder-count="4">
                <div style="display:grid;grid-template-columns:1fr 1fr 150px 150px;gap:14px;padding:14px 20px;border-bottom:1px solid #232019;align-items:center">
                  <span style="font-size:15px;font-weight:600;color:#ece6da">{{ d.city }}</span>
                  <span style="font-size:13px;color:#9a8f7e">{{ d.addr }}</span>
                  <span style="font-family:'Space Mono';font-size:13px;color:#c9b98f">{{ d.tel }}</span>
                  <div style="display:flex;gap:8px;justify-content:flex-end">
                    <span onClick="{{ d.onEdit }}" style="cursor:pointer;padding:8px 14px;border-radius:7px;border:1px solid #38332b;color:#cabfae;font-size:12px;font-weight:600" style-hover="border-color:#c9b98f">Düzenle</span>
                    <span onClick="{{ d.onDel }}" style="cursor:pointer;width:34px;height:34px;border-radius:7px;border:1px solid #4a2a2a;color:#d98a8a;display:flex;align-items:center;justify-content:center;font-size:17px" style-hover="background:#3a1f1f">×</span>
                  </div>
                </div>
              </sc-for>
            </div>
          </div>
          </sc-if>
          <sc-if value="{{ adminEditing }}" hint-placeholder-val="{{ false }}">
          <div style="max-width:720px">
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:22px"><span onClick="{{ closeEdit }}" style="cursor:pointer;font-family:'Space Mono';font-size:13px;color:#9a8f7e" style-hover="color:#cabfae">‹ {{ t.admin.dealers }}</span></div>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;padding:24px;display:flex;flex-direction:column;gap:16px">
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ŞEHİR / BAYİ</div><input value="{{ editDealer.city }}" onChange="{{ editDealer.onCity }}" style="{{ adminInput }}"/></div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ADRES</div><input value="{{ editDealer.addr }}" onChange="{{ editDealer.onAddr }}" style="{{ adminInput }}"/></div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">TELEFON</div><input value="{{ editDealer.tel }}" onChange="{{ editDealer.onTel }}" style="{{ adminInput }}"/></div>
              <div style="display:flex;gap:12px;margin-top:6px"><span onClick="{{ closeEdit }}" style="cursor:pointer;background:#c9b98f;color:#1a1610;padding:12px 26px;border-radius:8px;font-weight:700;font-size:13px">Kaydet & Kapat</span></div>
            </div>
          </div>
          </sc-if>
        </div>
        </sc-if>

        <sc-if value="{{ tabPages }}" hint-placeholder-val="{{ false }}">
        <div>
          <sc-if value="{{ adminListing }}" hint-placeholder-val="{{ true }}">
          <div>
            <h1 style="margin:0 0 22px;font-family:Archivo;font-weight:800;font-size:28px;color:#fff">{{ t.admin.pages }}</h1>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;overflow:hidden">
              <div style="display:grid;grid-template-columns:1fr 1fr 120px;gap:14px;padding:14px 20px;border-bottom:1px solid #2a2722;font-family:'Space Mono';font-size:10px;letter-spacing:.1em;color:#7a7060;text-transform:uppercase"><span>SAYFA (TR)</span><span>PAGE (EN)</span><span style="text-align:right">İŞLEM</span></div>
              <sc-for list="{{ adminPages }}" as="pg" hint-placeholder-count="3">
                <div style="display:grid;grid-template-columns:1fr 1fr 120px;gap:14px;padding:14px 20px;border-bottom:1px solid #232019;align-items:center">
                  <span style="font-size:15px;font-weight:600;color:#ece6da">{{ pg.tTr }}</span>
                  <span style="font-size:14px;color:#9a8f7e">{{ pg.tEn }}</span>
                  <div style="display:flex;gap:8px;justify-content:flex-end">
                    <span onClick="{{ pg.onEdit }}" style="cursor:pointer;padding:8px 14px;border-radius:7px;border:1px solid #38332b;color:#cabfae;font-size:12px;font-weight:600" style-hover="border-color:#c9b98f">Düzenle</span>
                  </div>
                </div>
              </sc-for>
            </div>
          </div>
          </sc-if>
          <sc-if value="{{ adminEditing }}" hint-placeholder-val="{{ false }}">
          <div style="max-width:820px">
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:22px"><span onClick="{{ closeEdit }}" style="cursor:pointer;font-family:'Space Mono';font-size:13px;color:#9a8f7e" style-hover="color:#cabfae">‹ {{ t.admin.pages }}</span></div>
            <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:14px;padding:24px;display:flex;flex-direction:column;gap:16px">
              <div style="display:grid;grid-template-columns:{{ g2 }};gap:16px">
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">BAŞLIK (TR)</div><input value="{{ editPage.tTr }}" onChange="{{ editPage.onTTr }}" style="{{ adminInput }}"/></div>
                <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">TITLE (EN)</div><input value="{{ editPage.tEn }}" onChange="{{ editPage.onTEn }}" style="{{ adminInput }}"/></div>
              </div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">İÇERİK (TR) — her satır yeni başlık/paragraf</div><textarea rows="9" onChange="{{ editPage.onBTr }}" style="{{ adminInput }};resize:vertical" value="{{ editPage.bTr }}"></textarea></div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">CONTENT (EN)</div><textarea rows="9" onChange="{{ editPage.onBEn }}" style="{{ adminInput }};resize:vertical" value="{{ editPage.bEn }}"></textarea></div>
              <div style="display:flex;gap:12px;margin-top:6px"><span onClick="{{ closeEdit }}" style="cursor:pointer;background:#c9b98f;color:#1a1610;padding:12px 26px;border-radius:8px;font-weight:700;font-size:13px">Kaydet & Kapat</span></div>
            </div>
          </div>
          </sc-if>
        </div>
        </sc-if>

        <sc-if value="{{ tabGeneral }}" hint-placeholder-val="{{ false }}">
        <div style="max-width:820px">
          <h1 style="margin:0 0 24px;font-family:Archivo;font-weight:800;font-size:28px;color:#fff">{{ t.admin.general }}</h1>
          <div style="font-family:'Space Mono';font-size:11px;letter-spacing:.16em;color:#7a7060;text-transform:uppercase;margin-bottom:10px">{{ t.admin.brandT }}</div>
          <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:12px;padding:24px;display:flex;flex-direction:column;gap:18px">
            <div style="display:grid;grid-template-columns:{{ g2 }};gap:16px">
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">MARKA ADI</div><input value="{{ setBrandTr }}" onChange="{{ onBrandTr }}" style="{{ adminInput }}"/></div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ALT YAZI</div><input value="{{ setBrandSub }}" onChange="{{ onBrandSub }}" style="{{ adminInput }}"/></div>
            </div>
            <div style="display:grid;grid-template-columns:{{ g2 }};gap:16px">
              <div>
                <div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:8px">{{ t.admin.logoT }}</div>
                <div style="display:flex;align-items:center;gap:14px">
                  <div style="width:120px;height:54px;border-radius:8px;border:1px solid #2a2722;background:#0f0e0c center/contain no-repeat;{{ logoThumb }};background-size:contain;background-repeat:no-repeat;background-position:center"></div>
                  <div style="display:flex;flex-direction:column;gap:8px">
                    <label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;color:#cabfae;font-size:12px;font-family:'Space Mono';border:1px solid #38332b;border-radius:8px;padding:9px 14px"><span style="color:#c9b98f;font-size:15px">+</span>{{ t.admin.upload }}<input type="file" accept="image/*" onChange="{{ onLogoFile }}" style="display:none"/></label>
                    <span onClick="{{ clearLogo }}" style="cursor:pointer;font-size:12px;color:#7a7060" style-hover="color:#d98a8a">{{ t.admin.remove }}</span>
                  </div>
                </div>
              </div>
              <div>
                <div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:8px">{{ t.admin.faviconT }}</div>
                <div style="display:flex;align-items:center;gap:14px">
                  <div style="width:54px;height:54px;border-radius:8px;border:1px solid #2a2722;background:#0f0e0c;{{ faviconThumb }};background-size:cover;background-position:center"></div>
                  <div style="display:flex;flex-direction:column;gap:8px">
                    <label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;color:#cabfae;font-size:12px;font-family:'Space Mono';border:1px solid #38332b;border-radius:8px;padding:9px 14px"><span style="color:#c9b98f;font-size:15px">+</span>{{ t.admin.upload }}<input type="file" accept="image/*" onChange="{{ onFaviconFile }}" style="display:none"/></label>
                    <span onClick="{{ clearFavicon }}" style="cursor:pointer;font-size:12px;color:#7a7060" style-hover="color:#d98a8a">{{ t.admin.remove }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div style="font-family:'Space Mono';font-size:11px;letter-spacing:.16em;color:#7a7060;text-transform:uppercase;margin:22px 0 10px">{{ t.contactPage.kicker }}</div>
          <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:12px;padding:24px;display:flex;flex-direction:column;gap:18px">
            <div style="display:grid;grid-template-columns:{{ g2 }};gap:16px">
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">TELEFON</div><input value="{{ setPhone }}" onChange="{{ onPhone }}" style="{{ adminInput }}"/></div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">E-POSTA</div><input value="{{ setEmail }}" onChange="{{ onEmail }}" style="{{ adminInput }}"/></div>
            </div>
            <div style="display:grid;grid-template-columns:{{ g2 }};gap:16px">
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ADRES (TR)</div><input value="{{ setAddressTr }}" onChange="{{ onAddressTr }}" style="{{ adminInput }}"/></div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ADDRESS (EN)</div><input value="{{ setAddressEn }}" onChange="{{ onAddressEn }}" style="{{ adminInput }}"/></div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ÇALIŞMA SAATLERİ (TR)</div><input value="{{ setHoursTr }}" onChange="{{ onHoursTr }}" style="{{ adminInput }}"/></div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">WORKING HOURS (EN)</div><input value="{{ setHoursEn }}" onChange="{{ onHoursEn }}" style="{{ adminInput }}"/></div>
            </div>
            <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">HAKKIMIZDA (TR)</div><textarea rows="4" onChange="{{ onAboutTr }}" style="{{ adminInput }};resize:vertical" value="{{ setAboutTr }}"></textarea></div>
            <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ABOUT (EN)</div><textarea rows="4" onChange="{{ onAboutEn }}" style="{{ adminInput }};resize:vertical" value="{{ setAboutEn }}"></textarea></div>
          </div>
        </div>
        </sc-if>

        <sc-if value="{{ tabSeo }}" hint-placeholder-val="{{ false }}">
        <div style="max-width:820px">
          <h1 style="margin:0 0 24px;font-family:Archivo;font-weight:800;font-size:28px;color:#fff">{{ t.admin.seo }}</h1>
          <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:12px;padding:24px;display:flex;flex-direction:column;gap:18px">
            <div style="display:grid;grid-template-columns:{{ g2 }};gap:16px">
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">SEO BAŞLIK (TR)</div><input value="{{ setSeoTitleTr }}" onChange="{{ onSeoTitleTr }}" style="{{ adminInput }}"/></div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">SEO TITLE (EN)</div><input value="{{ setSeoTitleEn }}" onChange="{{ onSeoTitleEn }}" style="{{ adminInput }}"/></div>
            </div>
            <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">SEO AÇIKLAMA (TR)</div><textarea rows="3" onChange="{{ onSeoDescTr }}" style="{{ adminInput }};resize:vertical" value="{{ setSeoDescTr }}"></textarea></div>
            <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">SEO DESCRIPTION (EN)</div><textarea rows="3" onChange="{{ onSeoDescEn }}" style="{{ adminInput }};resize:vertical" value="{{ setSeoDescEn }}"></textarea></div>
            <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ANAHTAR KELİMELER (virgülle ayırın)</div><textarea rows="2" onChange="{{ onSeoKeywords }}" style="{{ adminInput }};resize:none" value="{{ setSeoKeywords }}"></textarea></div>
            <div style="display:flex;align-items:flex-end;gap:16px;flex-wrap:wrap">
              <div style="flex:1;min-width:200px"><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">PAYLAŞIM GÖRSELİ (OG Image)</div><input value="{{ setOgImage }}" onChange="{{ onOgImage }}" style="{{ adminInput }}"/></div>
              <label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;color:#cabfae;font-size:12px;font-family:'Space Mono';border:1px solid #38332b;border-radius:8px;padding:11px 14px"><span style="color:#c9b98f;font-size:15px">+</span>{{ t.admin.upload }}<input type="file" accept="image/*" onChange="{{ onOgImageFile }}" style="display:none"/></label>
            </div>
          </div>
        </div>
        </sc-if>

        <sc-if value="{{ tabEmail }}" hint-placeholder-val="{{ false }}">
        <div style="max-width:820px">
          <h1 style="margin:0 0 6px;font-family:Archivo;font-weight:800;font-size:28px;color:#fff">{{ t.admin.email }}</h1>
          <p style="margin:0 0 22px;font-size:13px;color:#8a8170;line-height:1.6">{{ t.admin.mailNote }}</p>
          <div style="font-family:'Space Mono';font-size:11px;letter-spacing:.16em;color:#7a7060;text-transform:uppercase;margin-bottom:10px">{{ t.admin.mailT }}</div>
          <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:12px;padding:24px;display:flex;flex-direction:column;gap:18px">
            <div style="display:grid;grid-template-columns:{{ g2 }};gap:16px">
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ALICI E-POSTA (formlar buraya gelir)</div><input value="{{ setMailRecipient }}" onChange="{{ onMailRecipient }}" style="{{ adminInput }}"/></div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">GÖNDEREN E-POSTA</div><input value="{{ setMailSender }}" onChange="{{ onMailSender }}" style="{{ adminInput }}"/></div>
            </div>
          </div>
          <div style="font-family:'Space Mono';font-size:11px;letter-spacing:.16em;color:#7a7060;text-transform:uppercase;margin:22px 0 10px">{{ t.admin.smtpT }}</div>
          <div style="background:#1c1a17;border:1px solid #2a2722;border-radius:12px;padding:24px;display:flex;flex-direction:column;gap:18px">
            <div style="display:grid;grid-template-columns:2fr 1fr;gap:16px">
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">SMTP SUNUCU</div><input value="{{ setSmtpHost }}" onChange="{{ onSmtpHost }}" style="{{ adminInput }}"/></div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">PORT</div><input value="{{ setSmtpPort }}" onChange="{{ onSmtpPort }}" style="{{ adminInput }}"/></div>
            </div>
            <div style="display:grid;grid-template-columns:{{ g2 }};gap:16px">
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">KULLANICI ADI</div><input value="{{ setSmtpUser }}" onChange="{{ onSmtpUser }}" style="{{ adminInput }}"/></div>
              <div><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">ŞİFRE</div><input type="password" value="{{ setSmtpPass }}" onChange="{{ onSmtpPass }}" style="{{ adminInput }}"/></div>
            </div>
            <div style="max-width:200px"><div style="font-family:'Space Mono';font-size:10px;color:#7a7060;margin-bottom:6px">GÜVENLİK</div><select value="{{ setSmtpSecure }}" onChange="{{ onSmtpSecure }}" style="{{ adminInput }}"><option value="TLS">TLS</option><option value="SSL">SSL</option><option value="none">Yok</option></select></div>
          </div>
        </div>
        </sc-if>
      </main>
    </div>
  </div>
  </sc-if>
  </div>
  </sc-if>
  <sc-if value="{{ cookieShow }}" hint-placeholder-val="{{ false }}">
  <div style="position:fixed;left:0;right:0;bottom:0;z-index:250;display:flex;justify-content:center;padding:clamp(14px,3vw,28px);pointer-events:none">
    <div style="pointer-events:auto;max-width:780px;width:100%;background:#15120d;color:#e9e2d5;border:1px solid #2c261d;border-radius:18px;padding:clamp(20px,3vw,28px) clamp(22px,3vw,32px);box-shadow:0 30px 70px -30px rgba(0,0,0,.6);display:flex;align-items:center;gap:clamp(18px,3vw,32px);flex-wrap:wrap;animation:awaUp .5s cubic-bezier(.2,.7,.2,1)">
      <span style="flex:none;width:48px;height:48px;border-radius:50%;background:rgba(201,185,143,.14);color:{{ accent }};display:flex;align-items:center;justify-content:center"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 3a9 9 0 109 9 4 4 0 01-5-5 4 4 0 01-4-4z" stroke-linejoin="round"/><circle cx="9" cy="13" r="1" fill="currentColor" stroke="none"/><circle cx="14" cy="16" r="1" fill="currentColor" stroke="none"/><circle cx="15" cy="11" r="1" fill="currentColor" stroke="none"/></svg></span>
      <div style="flex:1;min-width:240px">
        <div style="font-family:Archivo;font-weight:700;font-size:18px;color:#fff">{{ cookieTitle }}</div>
        <p style="margin:7px 0 0;font-size:14px;line-height:1.65;color:#a99e8c">{{ cookieText }} <span onClick="{{ goGizlilik }}" style="cursor:pointer;color:{{ accent }};text-decoration:underline;text-underline-offset:2px">{{ cookieMore }}</span></p>
      </div>
      <div style="display:flex;gap:12px;flex-wrap:wrap">
        <span onClick="{{ rejectCookies }}" style="cursor:pointer;padding:13px 24px;border-radius:999px;border:1px solid #3a352e;color:#cabfae;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.1em;text-transform:uppercase" style-hover="border-color:#6a5f4d">{{ cookieReject }}</span>
        <span onClick="{{ acceptCookies }}" style="cursor:pointer;padding:13px 26px;border-radius:999px;background:{{ accent }};color:#1a1610;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.1em;text-transform:uppercase">{{ cookieAccept }}</span>
      </div>
    </div>
  </div>
  </sc-if>

  <sc-if value="{{ lightboxOpen }}" hint-placeholder-val="{{ false }}">
  <div style="position:fixed;inset:0;z-index:300;background:rgba(15,13,9,.92);display:flex;align-items:center;justify-content:center;padding:clamp(20px,4vw,64px);animation:awaFade .25s ease">
    <span onClick="{{ closeLightbox }}" style="position:absolute;top:22px;right:24px;width:48px;height:48px;border-radius:50%;border:1px solid rgba(255,255,255,.25);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer" style-hover="background:rgba(255,255,255,.12)"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span>
    <sc-if value="{{ lbHasMany }}" hint-placeholder-val="{{ true }}">
      <span onClick="{{ lbPrev }}" style="position:absolute;left:clamp(16px,3vw,40px);top:50%;transform:translateY(-50%);width:52px;height:52px;border-radius:50%;border:1px solid rgba(255,255,255,.25);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer" style-hover="background:rgba(255,255,255,.12)"><svg width="22" height="14" viewBox="0 0 22 12" fill="none"><path d="M22 6H2M6 1L1 6l5 5" stroke="currentColor" stroke-width="1.5"/></svg></span>
      <span onClick="{{ lbNext }}" style="position:absolute;right:clamp(16px,3vw,40px);top:50%;transform:translateY(-50%);width:52px;height:52px;border-radius:50%;border:1px solid rgba(255,255,255,.25);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer" style-hover="background:rgba(255,255,255,.12)"><svg width="22" height="14" viewBox="0 0 22 12" fill="none"><path d="M0 6h20M16 1l5 5-5 5" stroke="currentColor" stroke-width="1.5"/></svg></span>
    </sc-if>
    <div style="display:flex;flex-direction:column;align-items:center;gap:18px;max-width:1100px;width:100%">
      <div style="width:100%;aspect-ratio:3/2;border-radius:14px;{{ lightboxBg }};box-shadow:0 40px 90px -40px rgba(0,0,0,.7)"></div>
      <div style="display:flex;align-items:center;gap:18px">
        <span style="font-family:'Space Mono';font-size:13px;color:rgba(255,255,255,.6)">{{ lbIndex }}</span>
        <span onClick="{{ downloadImg }}" style="display:inline-flex;align-items:center;gap:10px;background:#f6f3ed;color:#17140f;padding:12px 24px;border-radius:999px;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.12em;text-transform:uppercase;cursor:pointer"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12M7 11l5 5 5-5M5 21h14"/></svg>İndir</span>
      </div>
    </div>
  </div>
  </sc-if>

  </main>

  <sc-if value="{{ showFooter }}" hint-placeholder-val="{{ true }}">
  <footer style="background:#15120d;color:#cabfae">
    <div style="max-width:1560px;margin:0 auto;padding:clamp(56px,6vw,90px) clamp(20px,4vw,72px) clamp(40px,4vw,56px);display:grid;grid-template-columns:{{ gFooter }};gap:clamp(28px,4vw,56px)">
      <div>
        <div style="display:flex;align-items:baseline;gap:9px"><span style="font-family:Archivo;font-weight:900;font-size:28px;letter-spacing:-.04em;color:#fff">AWA</span><span style="font-family:Archivo;font-weight:500;font-size:11px;letter-spacing:.4em;color:#fff;opacity:.5">MOBİLYA</span></div>
        <p style="margin:18px 0 0;font-size:15px;line-height:1.7;color:#9a8f7e;max-width:280px">{{ aboutText }}</p>
        <div style="display:flex;gap:10px;margin-top:26px"><span style="width:42px;height:42px;border-radius:50%;border:1px solid #34302a;display:flex;align-items:center;justify-content:center;cursor:pointer;font-family:Archivo;font-weight:700;font-size:14px;color:#cabfae" style-hover="border-color:#cabfae">f</span><span style="width:42px;height:42px;border-radius:50%;border:1px solid #34302a;display:flex;align-items:center;justify-content:center;cursor:pointer;font-family:Archivo;font-weight:700;font-size:12px;color:#cabfae" style-hover="border-color:#cabfae">in</span><span style="width:42px;height:42px;border-radius:50%;border:1px solid #34302a;display:flex;align-items:center;justify-content:center;cursor:pointer;font-family:Archivo;font-weight:700;font-size:12px;color:#cabfae" style-hover="border-color:#cabfae">X</span></div>
      </div>
      <div>
        <div style="font-family:'Space Mono';font-size:11px;letter-spacing:.16em;color:{{ accent }};text-transform:uppercase;margin-bottom:18px">{{ t.nav.collection }}</div>
        <div style="display:flex;flex-direction:column;gap:12px"><sc-for list="{{ footerCats }}" as="f" hint-placeholder-count="4"><span onClick="{{ f.onClick }}" style="cursor:pointer;font-size:15px;color:#cabfae" style-hover="color:#fff">{{ f.label }}</span></sc-for></div>
      </div>
      <div>
        <div style="font-family:'Space Mono';font-size:11px;letter-spacing:.16em;color:{{ accent }};text-transform:uppercase;margin-bottom:18px">{{ t.footer.corporate }}</div>
        <div style="display:flex;flex-direction:column;gap:12px"><sc-for list="{{ footerCorp }}" as="f" hint-placeholder-count="4"><span onClick="{{ f.onClick }}" style="cursor:pointer;font-size:15px;color:#cabfae" style-hover="color:#fff">{{ f.label }}</span></sc-for></div>
      </div>
      <div>
        <div style="font-family:Archivo;font-weight:700;font-size:20px;color:#fff">{{ t.newsletter.title }}</div>
        <p style="margin:12px 0 18px;font-size:14px;line-height:1.6;color:#9a8f7e">{{ t.newsletter.desc }}</p>
        <sc-if value="{{ subscribed }}" hint-placeholder-val="{{ false }}"><div style="background:rgba(255,255,255,.06);border:1px solid #34302a;border-radius:999px;padding:15px 24px;font-size:14px;color:#e9e2d5">{{ t.newsletter.thanks }}</div></sc-if>
        <sc-if value="{{ notSubscribed }}" hint-placeholder-val="{{ true }}"><div style="background:rgba(255,255,255,.06);border:1px solid #34302a;border-radius:999px;padding:6px 6px 6px 22px;display:flex;align-items:center;gap:10px"><input placeholder="{{ t.newsletter.placeholder }}" style="flex:1;border:none;outline:none;background:transparent;font-size:15px;color:#fff"/><button onClick="{{ subscribe }}" style="flex:none;width:46px;height:46px;border-radius:50%;background:{{ accent }};border:none;cursor:pointer;color:#1a1610;display:flex;align-items:center;justify-content:center"><svg width="20" height="10" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.7"/></svg></button></div></sc-if>
        <div style="margin-top:24px"><div style="font-family:Archivo;font-weight:800;font-size:24px;color:#fff">{{ phone }}</div><div style="font-size:14px;color:#9a8f7e">{{ email }}</div></div>
      </div>
    </div>
    <div style="border-top:1px solid #262320">
      <div style="max-width:1560px;margin:0 auto;padding:24px clamp(20px,4vw,72px);display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap">
        <div style="display:flex;align-items:center;gap:28px;flex-wrap:wrap;font-size:14px"><span onClick="{{ goKvkk }}" style="cursor:pointer" style-hover="color:#fff">KVKK</span><span onClick="{{ goMesafeli }}" style="cursor:pointer" style-hover="color:#fff">{{ t.footer.distance }}</span><span onClick="{{ goAdmin }}" style="cursor:pointer" style-hover="color:#fff">{{ t.footer.admin }}</span></div>
        <span style="font-size:14px;color:#7d705b">© AWA Mobilya 2026 · {{ t.footer.rights }}</span>
      </div>
    </div>
  </footer>
  </sc-if>

</div>
</x-dc>
<script type="text/x-dc" data-dc-script data-props="{&quot;accent&quot;:{&quot;editor&quot;:&quot;color&quot;,&quot;default&quot;:&quot;#9c8463&quot;,&quot;tsType&quot;:&quot;string&quot;},&quot;defaultLang&quot;:{&quot;editor&quot;:&quot;enum&quot;,&quot;options&quot;:[&quot;tr&quot;,&quot;en&quot;],&quot;default&quot;:&quot;tr&quot;,&quot;tsType&quot;:&quot;string&quot;},&quot;adminPassword&quot;:{&quot;editor&quot;:&quot;text&quot;,&quot;default&quot;:&quot;0000&quot;,&quot;tsType&quot;:&quot;string&quot;}}">
class Component extends DCLogic {
  state = { page:'home', lang:null, hero:0, cat:'koltuk', product:'exence', dropdown:null, scrolled:false, legal:'mesafeli', sent:false, subscribed:false, searchOpen:false, query:'', data:null, adminTab:'dashboard', ready:false, gi:0, article:null, mobileOpen:false, isMobile:false, sort:'default', faqOpen:null, adminAuthed:false, adminPwd:'', adminErr:false, adminEditId:null, lightboxOpen:false, cookieSeen:true };

  componentDidMount(){
    try{ var cc=localStorage.getItem('awa_cookie'); if(!cc) this.setState({cookieSeen:false}); }catch(e){ this.setState({cookieSeen:false}); }
    const init = () => {
      if (window.AWA) {
        let stored = null;
        try { const raw = localStorage.getItem('awa_cms_v4'); if (raw) stored = JSON.parse(raw); } catch(e){}
        this.setState({ ready:true, data: stored || window.AWA.defaultData() });
      } else { setTimeout(init, 40); }
    };
    init();
    // Sunucudan gelen başlangıç durumu (derin link / her sayfanın kendi URL'si)
    try{ var is=window.__INITIAL_STATE__; if(is && is.page){ this.setState(is); history.replaceState({dc:is},'',location.pathname); } }catch(e){}
    this._onPop=(e)=>{ var st=(e.state&&e.state.dc)?e.state.dc:this._stateFromPath(location.pathname); this.setState(Object.assign({dropdown:null,searchOpen:false,mobileOpen:false,gi:0},st)); window.scrollTo(0,0); };
    window.addEventListener('popstate', this._onPop);
    try{ if((location.hash||'').toLowerCase().indexOf('admin')>=0) this.setState({page:'admin'}); }catch(e){}
    this._onHash = () => { try{ if((location.hash||'').toLowerCase().indexOf('admin')>=0){ this.setState({page:'admin'}); window.scrollTo(0,0); } }catch(e){} };
    window.addEventListener('hashchange', this._onHash);
    setTimeout(()=>this._scanReveal(), 90);
    this._onScroll = () => { const s = window.scrollY > 40; if (s !== this.state.scrolled) this.setState({scrolled:s}); };
    window.addEventListener('scroll', this._onScroll, {passive:true});
    this._onResize = () => { const m = window.innerWidth < 900; if (m !== this.state.isMobile) this.setState({isMobile:m}); };
    this._onResize();
    window.addEventListener('resize', this._onResize);
    this._timer = setInterval(() => { if (this.state.page==='home' && !this.state.searchOpen) { const n = ((this.getData().slides)||[]).length || 1; this.setState(st=>({hero:(st.hero+1)%n})); } }, 6000);
  }
  componentWillUnmount(){ window.removeEventListener('scroll', this._onScroll); window.removeEventListener('resize', this._onResize); window.removeEventListener('hashchange', this._onHash); clearInterval(this._timer); }
  componentDidUpdate(){ this._scanReveal(); }
  _scanReveal(){
    try{
      if(!this._io){ this._io = new IntersectionObserver((es)=>{ es.forEach(e=>{ if(e.isIntersecting){ e.target.style.opacity='1'; e.target.style.transform='none'; this._io.unobserve(e.target); } }); }, {threshold:0.06, rootMargin:'0px 0px -6% 0px'}); }
      const io=this._io;
      requestAnimationFrame(()=>{ document.querySelectorAll('main section').forEach((el)=>{ if(el.__rev) return; el.__rev=1; el.style.transition='opacity .8s ease, transform .8s cubic-bezier(.2,.7,.2,1)'; const r=el.getBoundingClientRect(); if(r.top < window.innerHeight*0.92){ el.style.opacity='1'; } else { el.style.opacity='0'; el.style.transform='translateY(28px)'; io.observe(el); } }); });
      this._scanCount();
    }catch(e){}
  }
  _scanCount(){
    try{
      if(!this._cio){ this._cio = new IntersectionObserver((es)=>{ es.forEach(e=>{ if(e.isIntersecting){ this._runCount(e.target); this._cio.unobserve(e.target); } }); }, {threshold:0.5}); }
      requestAnimationFrame(()=>{ document.querySelectorAll('[data-countup]').forEach((el)=>{ if(el.__cnt) return; el.__cnt=1; const r=el.getBoundingClientRect(); if(r.top < window.innerHeight*0.92 && r.bottom>0){ this._runCount(el); } else { this._cio.observe(el); } }); });
    }catch(e){}
  }
  _runCount(el){
    const target = parseInt(el.getAttribute('data-count')||'0',10); const suffix = el.getAttribute('data-suffix')||''; if(!target){ return; }
    const dur=1300, t0=performance.now();
    const step=(now)=>{ const p=Math.min(1,(now-t0)/dur); const e=1-Math.pow(1-p,3); el.textContent=Math.round(target*e)+suffix; if(p<1) requestAnimationFrame(step); };
    el.textContent='0'+suffix; requestAnimationFrame(step);
  }

  getData(){ return this.state.data || (window.AWA ? window.AWA.defaultData() : {settings:{},products:[],news:[],dealers:[]}); }
  _save(d){ try{ localStorage.setItem('awa_cms_v4', JSON.stringify(d)); }catch(e){} }
  commit(d){ this._save(d); this.setState({data:d}); }

  nav(o){ var merged=Object.assign({},this.state,o); this.setState(Object.assign({dropdown:null,searchOpen:false,sent:false,mobileOpen:false,gi:0}, o)); window.scrollTo(0,0); this._pushUrl(merged); }
  _pathFor(st){ switch(st.page){
      case 'home': return '/';
      case 'corporate': return '/kurumsal';
      case 'collection': return '/projeler';
      case 'product': return '/projeler/'+(st.product||'');
      case 'news': return '/haberler';
      case 'article': return '/haberler/'+(st.article||'');
      case 'dealers': return '/bayiler';
      case 'contact': return '/iletisim';
      case 'faq': return '/sss';
      case 'legal': return '/'+(st.legal||'mesafeli');
      default: return '/'; } }
  _pushUrl(st){ try{ if(st.page==='admin') return; var p=this._pathFor(st); if(p!==location.pathname){ history.pushState({dc:{page:st.page,product:st.product,cat:st.cat,article:st.article,legal:st.legal}},'',p); } }catch(e){} }
  _stateFromPath(path){ path=(path||'/').replace(/\/+$/,'')||'/'; if(path==='/') return {page:'home'};
      var seg=path.split('/').filter(Boolean); var m={kurumsal:'corporate',haberler:'news',bayiler:'dealers',iletisim:'contact',sss:'faq',projeler:'collection'};
      if(seg.length===1){ if(m[seg[0]]) return {page:m[seg[0]]}; if(['mesafeli','kvkk','gizlilik'].indexOf(seg[0])>=0) return {page:'legal',legal:seg[0]}; }
      if(seg[0]==='projeler'){ var pr=(this.getData().products||[]).find(function(x){return x.id===seg[1];}); if(pr) return {page:'product',product:seg[1],cat:pr.cat}; return {page:'collection',cat:seg[1]}; }
      if(seg[0]==='haberler') return {page:'article',article:seg[1]};
      return {page:'home'}; }
  goHome=()=>this.nav({page:'home'});
  goCorporate=()=>this.nav({page:'corporate'});
  goNews=()=>this.nav({page:'news'});
  goContact=()=>this.nav({page:'contact'});
  goDealers=()=>this.nav({page:'dealers'});
  goCollectionDefault=()=>this.nav({page:'collection',cat:'koltuk'});
  goCollection=(cat)=>this.nav({page:'collection',cat});
  goCollectionCurrent=()=>this.nav({page:'collection'});
  goCatalog=()=>this.nav({page:'collection',cat:'koltuk'});
  goProduct=(id)=>{ const p=this.getData().products.find(x=>x.id===id); this.nav({page:'product',product:id,cat:p?p.cat:this.state.cat}); };
  goLegal=(doc)=>this.nav({page:'legal',legal:doc});
  goMesafeli=()=>this.goLegal('mesafeli');
  goKvkk=()=>this.goLegal('kvkk');
  goAdmin=()=>{ try{ if(location.hash.toLowerCase().indexOf('admin')<0) history.replaceState(null,'','#admin'); }catch(e){} this.nav({page:'admin'}); };
  setAdminTab=(adminTab)=>this.setState({adminTab, adminEditId:null});
  editRecord=(id)=>{ this.setState({adminEditId:id}); window.scrollTo(0,0); };
  closeEdit=()=>this.setState({adminEditId:null});
  setAdminPwd=(e)=>this.setState({adminPwd:e.target.value, adminErr:false});
  submitAdminPwd=()=>{ const ok = (this.state.adminPwd||'') === ((this.props && this.props.adminPassword) || '0000'); this.setState({adminAuthed:ok, adminErr:!ok, adminPwd: ok?'':this.state.adminPwd}); };
  adminLogout=()=>{ try{ history.replaceState(null,'',location.pathname+location.search); }catch(e){} this.setState({adminAuthed:false, adminPwd:''}); this.nav({page:'home'}); };

  openCorp=()=>{ clearTimeout(this._dropT); this.setState({dropdown:'corp'}); };
  openCol=()=>{ clearTimeout(this._dropT); this.setState({dropdown:'col'}); };
  closeDrop=()=>{ clearTimeout(this._dropT); this._dropT=setTimeout(()=>this.setState({dropdown:null}),260); };
  toggleSearch=()=>this.setState(s=>({searchOpen:!s.searchOpen,query:''}));
  setQuery=(e)=>this.setState({query:e.target.value});
  setTR=()=>this.setState({lang:'tr'});
  setEN=()=>this.setState({lang:'en'});
  goHero=(i)=>this.setState({hero:i});
  sendForm=()=>this.setState({sent:true});
  subscribe=()=>this.setState({subscribed:true});
  resetData=()=>{ this.commit(window.AWA.defaultData()); };
  goArticle=(id)=>this.nav({page:'article',article:id});
  acceptCookies=()=>{ try{ localStorage.setItem('awa_cookie','accepted'); }catch(e){} this.setState({cookieSeen:true}); };
  rejectCookies=()=>{ try{ localStorage.setItem('awa_cookie','rejected'); }catch(e){} this.setState({cookieSeen:true}); };
  setGi=(i)=>this.setState({gi:i});
  openLightbox=()=>this.setState({lightboxOpen:true});
  closeLightbox=()=>this.setState({lightboxOpen:false});
  lbNext=()=>this.setState(s=>({gi:(s.gi||0)+1}));
  lbPrev=()=>this.setState(s=>({gi:((s.gi||0)+9999)-1}));
  downloadImg=()=>{ try{ const vm=window.AWA.buildVM(this); const url=vm.lightboxImg; const a=document.createElement('a'); a.href=url; a.download=(url.split('/').pop()||'awa-mobilya')+''; document.body.appendChild(a); a.click(); a.remove(); }catch(e){} };
  toggleMobile=()=>this.setState(s=>({mobileOpen:!s.mobileOpen}));
  closeMobile=()=>this.setState({mobileOpen:false});
  addSlide=()=>{ const d=this.getData(); const sl=(d.slides||[]); const id='s'+Date.now(); this.commit(Object.assign({},d,{slides:sl.concat([{id:id,img:'uploads/1.png',subTr:'YENİ SLAYT',subEn:'NEW SLIDE',productId:(d.products[0]||{}).id}])})); this.setState({adminEditId:id}); };
  updSlide(id,f,v){ const d=this.getData(); this.commit(Object.assign({},d,{slides:(d.slides||[]).map(x=>x.id===id?Object.assign({},x,{[f]:v}):x)})); }
  delSlide(id){ const d=this.getData(); this.commit(Object.assign({},d,{slides:(d.slides||[]).filter(x=>x.id!==id)})); }
  updPage(key,f,v){ const d=this.getData(); this.commit(Object.assign({},d,{pages:Object.assign({},d.pages,{[key]:Object.assign({},(d.pages||{})[key],{[f]:v})})})); }
  _cats(){ const d=this.getData(); return (d.categories&&d.categories.length)?d.categories:(window.AWA.defaultData().categories); }
  addCategory=()=>{ const d=this.getData(); const cats=this._cats(); const id='c'+Date.now(); this.commit(Object.assign({},d,{categories:cats.concat([{id:id,tr:'Yeni Kategori',en:'New Category',img:'uploads/2.png',dTr:'Açıklama...',dEn:'Description...'}])})); this.setState({adminEditId:id}); };
  updCategory(id,f,v){ const d=this.getData(); const cats=this._cats(); this.commit(Object.assign({},d,{categories:cats.map(x=>x.id===id?Object.assign({},x,{[f]:v}):x)})); }
  delCategory(id){ const d=this.getData(); const cats=this._cats(); this.commit(Object.assign({},d,{categories:cats.filter(x=>x.id!==id)})); }
  goFaq=()=>this.nav({page:'faq'});
  setSort=(e)=>this.setState({sort:e.target.value});
  toggleFaq=(i)=>this.setState(s=>({faqOpen:s.faqOpen===i?null:i}));
  heroNext=()=>this.setState(st=>{ const n=((this.getData().slides)||[]).length||1; return {hero:(st.hero+1)%n}; });
  heroPrev=()=>this.setState(st=>{ const n=((this.getData().slides)||[]).length||1; return {hero:(st.hero-1+n)%n}; });
  readFile=(e,apply)=>{ const f=e.target.files&&e.target.files[0]; if(!f) return; const r=new FileReader(); r.onload=()=>apply(r.result); r.readAsDataURL(f); };

  updProduct(id,f,v){ const d=this.getData(); this.commit(Object.assign({},d,{products:d.products.map(p=>p.id===id?Object.assign({},p,{[f]:v}):p)})); }
  addProduct=()=>{ const d=this.getData(); const id='p'+Date.now(); this.commit(Object.assign({},d,{products:[{id:id,cat:(this._cats()[0]||{}).id||'koltuk',tr:'Yeni Ürün',en:'New Product',img:'uploads/2.png'}].concat(d.products)})); this.setState({adminEditId:id}); };
  delProduct(id){ const d=this.getData(); this.commit(Object.assign({},d,{products:d.products.filter(p=>p.id!==id)})); }
  updNews(id,f,v){ const d=this.getData(); this.commit(Object.assign({},d,{news:d.news.map(n=>n.id===id?Object.assign({},n,{[f]:v}):n)})); }
  addNews=()=>{ const d=this.getData(); const id='n'+Date.now(); this.commit(Object.assign({},d,{news:[{id:id,date:'01.01.2026',catTr:'Haber',catEn:'News',tr:'Yeni Haber',en:'New Article',exTr:'Açıklama...',exEn:'Description...',bodyTr:'',bodyEn:''}].concat(d.news)})); this.setState({adminEditId:id}); };
  delNews(id){ const d=this.getData(); this.commit(Object.assign({},d,{news:d.news.filter(n=>n.id!==id)})); }
  updDealer(id,f,v){ const d=this.getData(); this.commit(Object.assign({},d,{dealers:d.dealers.map(x=>x.id===id?Object.assign({},x,{[f]:v}):x)})); }
  addDealer=()=>{ const d=this.getData(); const id='d'+Date.now(); this.commit(Object.assign({},d,{dealers:d.dealers.concat([{id:id,city:'Yeni Bayi',addr:'Adres',tel:'+90 ...'}])})); this.setState({adminEditId:id}); };
  delDealer(id){ const d=this.getData(); this.commit(Object.assign({},d,{dealers:d.dealers.filter(x=>x.id!==id)})); }
  updSetting(f,v){ const d=this.getData(); this.commit(Object.assign({},d,{settings:Object.assign({},d.settings,{[f]:v})})); }

  renderVals(){
    if (!this.state.ready || !window.AWA) return {};
    return window.AWA.buildVM(this);
  }
}
</script>
@endverbatim
</body>
</html>
