@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gradient-quartz-white top-space-margin position-relative z-index-0 border-radius-6px lg-border-radius-0px overflow-hidden">
                <div class="container">
                    <div class="row justify-content-center mb-3">
                        <div class="col-xl-10 col-lg-6 text-center appear anime-child anime-complete" >
                            <h3 class="text-dark-gray fw-700 ls-minus-1px" style="">{{ $category->name }}</h3>
                            <p class="text-dark-gray d-inline-block fs-17">{{ $category->shortDescription }}</p>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-xl-3 row-cols-lg-3 row-cols-md-2
                    row-cols-sm-1 justify-content-center mb-5
                    transition-inner-all appear anime-child anime-complete">
                        <!-- start interactive banner item -->
                        @foreach($posts as $post)
                        <div class="col interactive-banner-style-02 mb-3"">
                            <div class="h-100 text-center position-relative border-radius-6px box-shadow-quadruple-large overflow-hidden">
                                <figure class="m-0">
                                    <a href="{{ $post->url }}" class="position-relative d-block">
                                        <img src="{{ $post->listingImage }}" alt="{{ $post->title }}" data-no-retina="">
                                        <div class="label position-absolute right-20px top-20px bg-base-color fw-600 text-white text-uppercase border-radius-30px ps-15px pe-15px fs-11 ls-05px">

                                        </div>
                                    </a>
                                    <figcaption class="w-100 position-absolute bottom-0px bg-white">
                                        <div class="position-relative z-index-2 p-40px pt-25px pb-15px border-bottom border-dark-opacity">
                                            <i class="features-icon line-icon-Archery-2 d-block icon-extra-large"></i>
                                            <a href="{{ $post->url }}"
                                                class="fw-600 d-inline-block mb-5px text-dark-gray fs-18">{{ $post->title }}</a>
                                            <p class="w-80 lg-w-100 fs-16 mx-auto mb-15px lg-mb-10px text-light-opacity">
                                                {!! $post->shortDescription !!}
                                            </p>
                                        </div>
                                        <a href="{{ $post->url }}" class="btn btn-link btn-hover-animation-switch btn-small fw-700 text-dark-gray text-uppercase p-20px z-index-1">
                                            <span>
                                                <span class="btn-text">Detay</span>
                                                <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                                                <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                                            </span>
                                        </a>
                                        <div class="box-overlay bg-base-color"></div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </section>

    <!-- end section -->
@endsection
