<div class="topbar-variant3" role="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-8 text-center text-md-start">
                    <span><i class="fa-solid fa-bullhorn me-2"></i>{!! $topbarText !!}</span>
                </div>
                <div class="col-12 col-md-4 text-center text-md-end">
                    @if($showPhone)
                    <a href="tel:{{ $topbarSettings->gsm }}" class="me-3"><i class="fa-solid fa-phone me-2"></i>Ara</a>
                    @endif
                    <a href="/tr/iletisim"><i class="fa-solid fa-envelope me-2"></i>İletişim</a>
                </div>
            </div>
        </div>
</div>
