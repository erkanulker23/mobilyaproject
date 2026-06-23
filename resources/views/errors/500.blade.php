@extends('frontend.layouts.app')

@section('content')

<section class="404">
    <div class="container">
        <div class="row align-items-center justify-content-center h-100">
            <div class="col-12 col-xl-6 col-lg-7 col-md-9 text-center" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <h6 class="text-dark-gray fw-600 mb-5px text-uppercase">Ooops!</h6>
                <h1 class="fs-200 sm-fs-170 text-dark-gray fw-700 ls-minus-8px">500</h1>
                <h4 class="text-dark-gray fw-600 sm-fs-22 mb-10px ls-minus-1px">Sunucu taraflı bir hata oluştu. Lütfen daha sonra tekrar deneyin.</h4>
                <a href="/" class="btn btn-large left-icon btn-rounded btn-dark-gray btn-box-shadow text-transform-none">
                    <i class="fa-solid fa-arrow-left"></i>Anasayfaya Git</a>
            </div>
        </div>
    </div>
</section>
@endsection
