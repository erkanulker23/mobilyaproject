@extends('frontend.layouts.app')

@push('metas')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Foto galeri ve video galeri. Çalışmalarımızı, projelerimizi ve başarılarımızı görsellerle keşfedin.">
    <meta name="keywords" content="galeri, fotoğraf galerisi, video galeri, görsel galeri">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Galeri">
    <meta property="og:description" content="Foto galeri ve video galeri. Projelerimizi görsellerle keşfedin.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')

<!-- Hero Section -->
<section class="service-hero-new">
    <picture>
        <source media="(max-width: 768px)" srcset="{{ $heroImageMobile }}">
        <img src="{{ $heroImage }}"
        alt="Galeri görseli"
        loading="lazy"
        class="service-hero-bg">
    </picture>
    <div class="container">
      <div class="service-hero-content">
        <div class="service-hero-text">
          <h1 class="service-title">Galeri</h1>
          <p style="color: #fff; font-size: 1rem; margin-top: 10px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);">Firmamıza ait olan tüm galeri resimlerinin bir kaçını görebilirsiniz</p>
        </div>
      </div>
    </div>
  </section>



    <section class="gallery-container gallery-grid-mobile">
    <div class="container">
        <!-- Filter Buttons -->
        <div class="gallery-filter-container">
            <button class="gallery-filter-btn active" gallery-data-filter="all" aria-label="Tüm galeri öğelerini göster">Tümünü Göster</button>
            @foreach($galleryCategories as $galleryCategory)
                <button class="gallery-filter-btn" gallery-data-filter="{{ $galleryCategory->slug }}" aria-label="{{ $galleryCategory->name }} kategorisini filtrele">{{ $galleryCategory->name }}</button>
            @endforeach
        </div>

        <!-- Gallery Grid with Bootstrap Columns -->
        <div class="row gallery-grid">
            @php
                $totalItems = 0;
            @endphp
            @foreach($galleryCategories as $galleryCategory)
                @foreach($galleryCategory->entries as $entry)
                    @if($entry->youtube_embed_url)
                        <!-- Video Item -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="gallery-item"
                                 gallery-data-category="{{ $galleryCategory->slug }}"
                                 data-fancybox="gallery"
                                 data-src="{{ $entry->youtube_embed_url }}"
                                 data-type="video"
                                 role="button"
                                 aria-label="{{ $entry->title ?? 'Video' }}"
                                 @if($entry->getFirstMediaUrl('image'))
                                     style="background-image: url('{{ $entry->getFirstMediaUrl('image') }}'); background-size: cover; background-position: center;"
                                 @endif>
                                <video src="{{ $entry->youtube_embed_url }}" muted class="w-100" style="display: none;"></video>
                                <i class="fas fa-play play-icon" aria-hidden="true"></i>
                            </div>
                        </div>
                        @php $totalItems++; @endphp
                    @else
                        <!-- Image Items (Multiple Images Support) -->
                        @foreach($entry->getMedia('image') as $media)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="gallery-item"
                                     gallery-data-category="{{ $galleryCategory->slug }}"
                                     data-fancybox="gallery"
                                     data-src="{{ $media->getUrl() }}"
                                     data-type="image"
                                     data-caption="{{ $entry->title }}"
                                     role="button"
                                     aria-label="{{ $entry->title }}">
                                    <img src="{{ $media->getUrl() }}" alt="{{ $entry->title }} görseli" class="w-100" loading="lazy">
                                </div>
                            </div>
                            @php $totalItems++; @endphp
                        @endforeach
                    @endif
                @endforeach
            @endforeach
        </div>

    </div>
</section>


@endsection

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
