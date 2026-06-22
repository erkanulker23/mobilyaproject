/* AWA Mobilya — frontend etkileşimleri (progressive enhancement) */
(function () {
  'use strict';

  /* Header: hero üzerindeyken şeffaf, kaydırınca opak */
  var header = document.querySelector('[data-header]');
  var hero = document.querySelector('[data-hero]');
  if (header) {
    var onScroll = function () {
      var overHero = hero && window.scrollY < (hero.offsetHeight - 120);
      header.classList.toggle('site-header--hero', !!overHero && window.scrollY < 40);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* Hero slider */
  var heroEl = document.querySelector('[data-hero]');
  if (heroEl) {
    var slides = heroEl.querySelectorAll('.hero__slide');
    var dots = heroEl.querySelectorAll('.hero__dot');
    var i = 0, timer;
    var go = function (n) {
      i = (n + slides.length) % slides.length;
      slides.forEach(function (s, k) { s.classList.toggle('is-active', k === i); });
      dots.forEach(function (d, k) { d.classList.toggle('is-active', k === i); });
    };
    dots.forEach(function (d, k) { d.addEventListener('click', function () { go(k); restart(); }); });
    var restart = function () { clearInterval(timer); timer = setInterval(function () { go(i + 1); }, 6000); };
    if (slides.length > 1) restart();
  }

  /* Mobil menü */
  var mToggle = document.querySelector('[data-mobile-toggle]');
  var mMenu = document.querySelector('[data-mobile-menu]');
  var mClose = document.querySelector('[data-mobile-close]');
  if (mToggle && mMenu) {
    var openM = function () { mMenu.classList.add('is-open'); document.body.style.overflow = 'hidden'; };
    var closeM = function () { mMenu.classList.remove('is-open'); document.body.style.overflow = ''; };
    mToggle.addEventListener('click', openM);
    if (mClose) mClose.addEventListener('click', closeM);
    mMenu.querySelectorAll('a').forEach(function (a) { a.addEventListener('click', closeM); });
  }

  /* Ürün galerisi: küçük görsele tıklayınca ana görseli değiştir */
  var gal = document.querySelector('[data-gallery]');
  if (gal) {
    var main = gal.querySelector('[data-gallery-main]');
    gal.querySelectorAll('[data-gallery-thumb]').forEach(function (thumb) {
      thumb.addEventListener('click', function () {
        var bg = thumb.style.backgroundImage;
        if (main && bg) main.style.backgroundImage = bg;
        gal.querySelectorAll('[data-gallery-thumb]').forEach(function (t) { t.classList.remove('is-active'); });
        thumb.classList.add('is-active');
      });
    });
  }

  /* Reveal on scroll */
  var reveals = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window && reveals.length) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } });
    }, { threshold: 0.08, rootMargin: '0px 0px -6% 0px' });
    reveals.forEach(function (el) { io.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add('is-in'); });
  }

  /* Sayaç animasyonu (data-count) */
  var counters = document.querySelectorAll('[data-count]');
  if ('IntersectionObserver' in window && counters.length) {
    var cio = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (!e.isIntersecting) return;
        var el = e.target, target = parseInt(el.getAttribute('data-count'), 10) || 0, suffix = el.getAttribute('data-suffix') || '';
        var t0 = performance.now();
        (function step(now) {
          var p = Math.min(1, (now - t0) / 1300), v = Math.round(target * (1 - Math.pow(1 - p, 3)));
          el.textContent = v + suffix;
          if (p < 1) requestAnimationFrame(step);
        })(t0);
        cio.unobserve(el);
      });
    }, { threshold: 0.5 });
    counters.forEach(function (el) { cio.observe(el); });
  }
})();
