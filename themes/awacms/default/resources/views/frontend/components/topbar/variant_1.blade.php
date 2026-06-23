<div class="topbar-variant1" role="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 text-center text-md-start">
                    @if($showPhone)
                    <span class="me-3"><i class="fa-solid fa-phone me-2"></i><a href="tel:{{ $topbarSettings->gsm }}">{{ $topbarSettings->gsm }}</a></span>
                    @endif
                    <span><i class="fa-solid fa-envelope me-2"></i><a href="mailto:{{ $topbarSettings->email }}">{{ $topbarSettings->email }}</a></span>
                </div>
                <div class="col-12 col-md-6 text-center text-md-end">
                    @foreach($socialMediaLinks as $social)
                        <a href="{{ $social->link }}" target="_blank" class="me-3"><i class="{{ $social->customIcon }}"></i></a>
                    @endforeach
                </div>
            </div>
        </div>
</div>

