<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 — Sayfa Bulunamadı · AWA Mobilya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@600;700;800;900&family=Montserrat:wght@400;500;600&family=Space+Mono&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box}
        body{margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;background:#f6f3ed;color:#17140f;font-family:'Montserrat',sans-serif;padding:40px 20px}
        .wrap{max-width:640px;text-align:center}
        .kick{font-family:'Space Mono',monospace;font-size:12px;letter-spacing:.22em;text-transform:uppercase;color:#9c8463;margin-bottom:18px}
        h1{font-family:'Archivo',sans-serif;font-weight:900;font-size:clamp(96px,20vw,200px);line-height:.9;letter-spacing:-.04em;margin:0;color:#17140f}
        h1 span{color:#9c8463}
        h2{font-family:'Archivo',sans-serif;font-weight:700;font-size:clamp(20px,3vw,30px);margin:18px 0 0}
        p{margin:16px auto 0;max-width:46ch;font-size:16px;line-height:1.7;color:#5d564b}
        .btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap;margin-top:36px}
        a.btn{display:inline-flex;align-items:center;gap:10px;text-decoration:none;font-family:'Archivo',sans-serif;font-weight:700;font-size:12px;letter-spacing:.13em;text-transform:uppercase;padding:16px 30px;border-radius:999px;transition:transform .3s,background .3s}
        a.primary{background:#17140f;color:#fff}
        a.primary:hover{background:#3a332a;transform:translateY(-2px)}
        a.ghost{background:transparent;color:#17140f;border:1px solid #d3cabb}
        a.ghost:hover{background:#efe9dd;transform:translateY(-2px)}
        .links{display:flex;gap:8px 26px;justify-content:center;flex-wrap:wrap;margin-top:44px;padding-top:28px;border-top:1px solid #e4ddce}
        .links a{font-size:14px;font-weight:600;color:#6b6356;text-decoration:none;transition:color .3s}
        .links a:hover{color:#9c8463}
    </style>
</head>
<body>
    <div class="wrap">
        <div class="kick">Sayfa Bulunamadı</div>
        <h1>4<span>0</span>4</h1>
        <h2>Aradığınız sayfayı bulamadık</h2>
        <p>Sayfa taşınmış, kaldırılmış ya da hiç var olmamış olabilir. Sizi doğru yere yönlendirelim.</p>
        <div class="btns">
            <a class="btn primary" href="{{ url('/') }}">← Anasayfa</a>
            <a class="btn ghost" href="{{ url('/urunler') }}">Ürünleri İncele</a>
        </div>
        <div class="links">
            <a href="{{ url('/kurumsal') }}">Kurumsal</a>
            <a href="{{ url('/urunler') }}">Ürünler</a>
            <a href="{{ url('/haberler') }}">Haberler</a>
            <a href="{{ url('/bayiler') }}">Bayiler</a>
            <a href="{{ url('/iletisim') }}">İletişim</a>
        </div>
    </div>
</body>
</html>
