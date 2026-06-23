@if ($showPopup)
<!-- start subscription popup -->
<div id="subscribe-popup" class="mfp-hide subscribe-popup">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-md-10 bg-white">
                <div class="row position-relative box-shadow-quadruple-large">
                    <div class="col-lg-6 newsletter-popup p-8 pt-10 pb-10 lg-p-5 md-p-6 xs-p-8 position-relative">
                        <h4 class="d-inline-block alt-font ls-minus-1px fw-700 text-dark-gray mb-15px">
                            {{ $title }}
                        </h4>
                        {!! $content !!}
                        <label for="newsletter-off" class="fs-15"><input class="w-auto me-10px position-relative top-1px p-0" type="checkbox" id="newsletter-off" name="newsletter-off">
                            Bir daha gösterme
                        </label>
                    </div>
                    <button title="Close (Esc)" type="button" class="mfp-close text-dark-gray"></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end subscription popup -->
@endif