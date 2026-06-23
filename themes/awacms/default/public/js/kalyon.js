/* ==========================================================================
   Kalyon İnşaat — frontend runtime
   Tasarımdaki DC (React) davranışlarının saf JS karşılığı:
   style-hover, data-reveal, data-count, data-bar, hero slider,
   proje filtresi, FAQ akordeon, mobil menü, header scroll.
   ========================================================================== */
(function () {
  'use strict';

  /* ---- style-hover: elemana hover'da inline stil uygula ----
     Base stil HOVER ANINDA dinamik yakalanır; böylece data-reveal'in
     açtığı opacity/transform gibi değerler korunur (yoksa hover'da
     eleman tekrar opacity:0 olup "kaybolur"). ---- */
  function initHover() {
    document.querySelectorAll('[style-hover]').forEach(function (el) {
      var hover = el.getAttribute('style-hover') || '';
      el.addEventListener('mouseenter', function () {
        // o anki (hover olmayan) stili sakla, üstüne hover ekle
        el._kalBase = el.getAttribute('style') || '';
        el.setAttribute('style', el._kalBase + ';' + hover);
      });
      el.addEventListener('mouseleave', function () {
        if (el._kalBase !== undefined) {
          el.setAttribute('style', el._kalBase);
        }
      });
    });
  }

  /* ---- data-reveal: scroll'a girince yumuşak görünür ol ---- */
  function initReveal() {
    var items = document.querySelectorAll('[data-reveal]');
    if (!items.length) return;
    items.forEach(function (el) {
      var delay = parseFloat(el.getAttribute('data-rd') || '0');
      el.style.transition = 'opacity .9s cubic-bezier(.16,1,.3,1) ' + delay + 's, transform .9s cubic-bezier(.16,1,.3,1) ' + delay + 's';
      el.style.transform = 'translateY(28px)';
    });
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          e.target.style.opacity = '1';
          e.target.style.transform = 'translateY(0)';
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.12 });
    items.forEach(function (el) { io.observe(el); });
  }

  /* ---- data-count: sayaç animasyonu (data-dec ondalık, data-suffix) ---- */
  function animateCount(el) {
    var target = parseFloat(el.getAttribute('data-count') || '0');
    var dec = parseInt(el.getAttribute('data-dec') || '0', 10);
    var dur = 1600, start = null;
    function step(ts) {
      if (!start) start = ts;
      var p = Math.min((ts - start) / dur, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      var val = target * eased;
      el.textContent = dec > 0 ? val.toFixed(dec) : Math.round(val).toLocaleString('tr-TR');
      if (p < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }
  function initCounters() {
    var counters = document.querySelectorAll('[data-count]');
    if (!counters.length) return;
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { animateCount(e.target); io.unobserve(e.target); }
      });
    }, { threshold: 0.5 });
    counters.forEach(function (el) { io.observe(el); });
  }

  /* ---- data-bar: ilerleme çubuğu genişliği ---- */
  function initBars() {
    var bars = document.querySelectorAll('[data-bar]');
    if (!bars.length) return;
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          e.target.style.width = e.target.getAttribute('data-bar') + '%';
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.4 });
    bars.forEach(function (el) { io.observe(el); });
  }

  /* ---- hero slider ---- */
  function initHero() {
    var hero = document.querySelector('[data-hero]');
    if (!hero) return;
    var slides = hero.querySelectorAll('[data-slide]');
    var dots = hero.querySelectorAll('[data-hdot]');
    if (slides.length < 2) return;
    var i = 0;
    function setDot(d, active) {
      if (!d) return;
      d.classList.toggle('is-active', active);
      // düz çubuk dot'lar için inline stil (thumbnail dot'larda data-thumb var → atla)
      if (d.getAttribute('data-thumb') === null) {
        d.style.width = active ? '34px' : '14px';
        d.style.background = active ? '#D97757' : 'rgba(255,255,255,.4)';
      }
    }
    function go(n) {
      slides[i].style.opacity = '0';
      setDot(dots[i], false);
      i = (n + slides.length) % slides.length;
      slides[i].style.opacity = '1';
      var img = slides[i].querySelector('img');
      if (img) { img.style.animation = 'none'; void img.offsetWidth; img.style.animation = 'kenburns 8s ease-out forwards'; }
      setDot(dots[i], true);
    }
    dots.forEach(function (d, idx) { d.addEventListener('click', function () { go(idx); }); });
    setInterval(function () { go(i + 1); }, 5500);
  }

  /* ---- proje filtresi ---- */
  function initFilter() {
    var btns = document.querySelectorAll('[data-filterbtn]');
    if (!btns.length) return;
    var cards = document.querySelectorAll('[data-card]');
    btns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var f = btn.getAttribute('data-filterbtn');
        btns.forEach(function (b) {
          b.style.color = '#2B2926'; b.style.background = 'transparent'; b.style.borderColor = '#C9BFAD';
        });
        btn.style.color = '#fff'; btn.style.background = '#2B2926'; btn.style.borderColor = '#2B2926';
        cards.forEach(function (c) {
          var cat = c.getAttribute('data-cat') || '';
          var show = (f === 'all') || cat.indexOf(f) !== -1;
          c.style.display = show ? '' : 'none';
        });
      });
    });
  }

  /* ---- FAQ akordeon ---- */
  function initFaq() {
    document.querySelectorAll('[data-faq-q]').forEach(function (q) {
      q.addEventListener('click', function () {
        var item = q.closest('[data-faq]');
        if (!item) return;
        var a = item.querySelector('[data-faq-a]');
        var icon = item.querySelector('[data-faq-icon]');
        var open = item.getAttribute('data-open') === '1';
        if (a) a.style.maxHeight = open ? '0px' : (a.scrollHeight + 'px');
        if (icon) icon.style.transform = open ? 'rotate(0deg)' : 'rotate(45deg)';
        item.setAttribute('data-open', open ? '0' : '1');
      });
    });
  }

  /* ---- mobil menü (tam ekran overlay) ---- */
  function initMobileMenu() {
    var panel = document.querySelector('[data-mobile-menu]');
    var toggles = document.querySelectorAll('[data-menu-toggle]');
    if (!panel || !toggles.length) return;
    function open() { panel.classList.add('open'); panel.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden'; }
    function close() { panel.classList.remove('open'); panel.setAttribute('aria-hidden', 'true'); document.body.style.overflow = ''; }
    toggles.forEach(function (t) {
      t.addEventListener('click', function () {
        panel.classList.contains('open') ? close() : open();
      });
    });
    panel.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', close);
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });
  }

  /* ---- transparan header → scroll'da katı ---- */
  function initHeaderScroll() {
    var header = document.querySelector('[data-header]');
    if (!header) return;
    function onScroll() {
      if (window.scrollY > 30) header.classList.add('scrolled');
      else header.classList.remove('scrolled');
    }
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* ---- lightbox galeri ---- */
  function initLightbox() {
    var triggers = Array.prototype.slice.call(document.querySelectorAll('[data-lightbox]'));
    if (!triggers.length) return;
    var images = triggers.map(function (t) { return t.getAttribute('data-lightbox'); });
    var current = 0;

    var box = document.createElement('div');
    box.className = 'kal-lightbox';
    box.innerHTML =
      '<button class="kal-lb-close" aria-label="Kapat"><i class="fa-solid fa-xmark"></i></button>' +
      '<button class="kal-lb-prev" aria-label="Önceki"><i class="fa-solid fa-chevron-left"></i></button>' +
      '<figure class="kal-lb-figure"><img alt=""><figcaption class="kal-lb-count"></figcaption></figure>' +
      '<button class="kal-lb-next" aria-label="Sonraki"><i class="fa-solid fa-chevron-right"></i></button>';
    document.body.appendChild(box);

    var imgEl = box.querySelector('img');
    var countEl = box.querySelector('.kal-lb-count');
    function show(i) {
      current = (i + images.length) % images.length;
      imgEl.src = images[current];
      countEl.textContent = (current + 1) + ' / ' + images.length;
    }
    function open(i) { show(i); box.classList.add('open'); document.body.style.overflow = 'hidden'; }
    function close() { box.classList.remove('open'); document.body.style.overflow = ''; }

    triggers.forEach(function (t, i) {
      t.style.cursor = 'zoom-in';
      t.addEventListener('click', function (e) { e.preventDefault(); open(i); });
    });
    box.querySelector('.kal-lb-close').addEventListener('click', close);
    box.querySelector('.kal-lb-next').addEventListener('click', function () { show(current + 1); });
    box.querySelector('.kal-lb-prev').addEventListener('click', function () { show(current - 1); });
    box.addEventListener('click', function (e) { if (e.target === box) close(); });
    document.addEventListener('keydown', function (e) {
      if (!box.classList.contains('open')) return;
      if (e.key === 'Escape') close();
      else if (e.key === 'ArrowRight') show(current + 1);
      else if (e.key === 'ArrowLeft') show(current - 1);
    });
  }

  function init() {
    initHover(); initReveal(); initCounters(); initBars();
    initHero(); initFilter(); initFaq(); initMobileMenu(); initHeaderScroll(); initLightbox();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else { init(); }
})();
