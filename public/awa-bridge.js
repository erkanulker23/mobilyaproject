/*
 * AWA Bridge — mevcut frontend render motoru ile Laravel backend arasındaki köprü.
 * Tasarımı hiç değiştirmez; yalnızca:
 *  1) İçeriği DB'den (window.__SERVER_DATA__) besler,
 *  2) İletişim formu ve e-bülteni Laravel'e kaydeder,
 *  3) "Yönetim Paneli" linkini Filament (/admin) paneline yönlendirir.
 */
(function () {
  // 1) Veri kaynağını DB verisine bağla
  var bind = function () {
    if (window.AWA && typeof window.AWA.defaultData === 'function') {
      var orig = window.AWA.defaultData;
      window.AWA.defaultData = function () { return window.__SERVER_DATA__ || orig(); };
      try { localStorage.removeItem('awa_cms_v4'); } catch (e) {}
    } else {
      setTimeout(bind, 20);
    }
  };
  bind();

  // Yardımcı: Laravel'e JSON POST
  function post(url, payload) {
    try {
      return fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': window.__CSRF__ || '',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(payload)
      });
    } catch (e) {}
  }

  function val(el) { return (el && el.value ? el.value : '').trim(); }

  // 2) & 3) Tıklama delegasyonu (yakalama fazı)
  document.addEventListener('click', function (ev) {
    var node = ev.target;

    // 3) Yönetim Paneli linki → Filament
    var labelEl = node.closest ? node : null;
    var txt = (node && node.textContent ? node.textContent : '').trim();
    if (txt === 'Yönetim Paneli' || txt === 'Admin Panel') {
      ev.preventDefault();
      window.location.href = window.__ADMIN_URL__ || '/admin';
      return;
    }

    // 2) Form gönderimleri — yalnızca ok ikonlu (svg) submit butonları
    var btn = node.closest ? node.closest('button') : null;
    if (!btn || !btn.querySelector('svg')) return;
    var box = btn.parentElement;
    if (!box) return;

    var textarea = box.querySelector('textarea');
    var inputs = box.querySelectorAll('input');

    // İletişim formu: textarea + en az 3 input (ad, e-posta, telefon)
    if (textarea && inputs.length >= 3) {
      var lead = {
        name: val(inputs[0]),
        email: val(inputs[1]),
        phone: val(inputs[2]),
        message: val(textarea)
      };
      if (lead.email || lead.phone || lead.message) {
        post('/lead', lead);
      }
      return;
    }

    // E-bülten: tek input (e-posta), textarea yok
    if (!textarea && inputs.length === 1) {
      var email = val(inputs[0]);
      if (email) { post('/subscribe', { email: email }); }
      return;
    }
  }, true);
})();
