<div class="topbar-variant6" role="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 text-center text-md-start">
                    <span><i class="fa-solid fa-map-marker-alt me-2"></i>{{ $topbarSettings->address }}</span>
                </div>
                <div class="col-12 col-md-6 text-center text-md-end">
                    @foreach($socialMediaLinks as $social)
                        <a href="{{ $social->link }}" target="_blank" class="me-3"><i class="{{ $social->customIcon }}"></i></a>
                    @endforeach
                </div>
            </div>
        </div>
</div>
