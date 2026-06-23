<div class="topbar-variant2" role="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-4 text-center text-md-start">
                    @if($showPhone)
                    <div class="topbar-variant2__contact">
                        <i class="fa-solid fa-phone me-2"></i>
                        <a href="tel:{{ $topbarSettings->gsm }}">{{ $topbarSettings->gsm }}</a>
                    </div>
                    @endif
                </div>
                <div class="col-12 col-md-4 text-center">
                    <div class="topbar-variant2__hours">
                        <i class="fa-solid fa-clock me-2"></i>
                        <span>{!! $topbarText !!}</span>
                    </div>
                </div>
                <div class="col-12 col-md-4 text-center text-md-end">
                    <div class="topbar-variant2__social d-flex justify-content-center justify-content-md-end align-items-center gap-3">
                        @foreach($socialMediaLinks as $social)
                            <a href="{{ $social->link }}" target="_blank" class="topbar-variant2__social-link">
                                <i class="{{ $social->customIcon }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</div>

