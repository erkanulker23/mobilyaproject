/*
 * AWA Mobilya — DB köprüsü.
 * DC tasarımının verisini (window.AWA.defaultData) sunucudan gelen
 * window.__SERVER_DATA__ (admin/DB içeriği) ile değiştirir. Böylece tasarım
 * birebir korunurken tüm içerik yönetim panelinden yönetilir.
 */
(function () {
  function apply() {
    if (!window.AWA || !window.__SERVER_DATA__) return false;
    var orig = window.AWA.defaultData;
    window.AWA.defaultData = function () {
      var base = {};
      try { base = orig ? orig() : {}; } catch (e) { base = {}; }
      var srv = window.__SERVER_DATA__ || {};
      var merged = Object.assign({}, base, srv);
      // settings'i derin birleştir (sunucu öncelikli, eksikler tabandan)
      merged.settings = Object.assign({}, base.settings || {}, srv.settings || {});
      // diziler boşsa tabandaki örnekleri kullanma; sunucu boşsa boş kalsın
      ['categories', 'products', 'slides', 'news', 'dealers'].forEach(function (k) {
        if (!Array.isArray(srv[k])) merged[k] = base[k] || [];
      });
      if (!srv.pages) merged.pages = base.pages || {};
      return merged;
    };
    // Eski tarayıcı düzenlemelerini yok say — içerik daima DB'den gelir
    try { localStorage.removeItem('awa_cms_v4'); } catch (e) {}
    return true;
  }

  if (!apply()) {
    var tries = 0;
    var t = setInterval(function () {
      if (apply() || ++tries > 200) clearInterval(t);
    }, 25);
  }
})();
