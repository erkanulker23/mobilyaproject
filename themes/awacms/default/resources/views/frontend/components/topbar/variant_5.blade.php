<div class="topbar-variant5" role="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 text-center text-md-start">
                    <span><i class="fa-solid fa-location-dot me-2"></i>{{ $topbarSettings->address }}</span>
                </div>
                <div class="col-12 col-md-6 text-center text-md-end">
                    @if($showPhone)
                    <a href="tel:{{ $topbarSettings->gsm }}" class="me-3"><i class="fa-solid fa-phone me-2"></i>{{ $topbarSettings->gsm }}</a>
                    @endif
                    <a href="mailto:{{ $topbarSettings->email }}"><i class="fa-solid fa-envelope me-2"></i>{{ $topbarSettings->email }}</a>
                </div>
            </div>
        </div>
</div>
