@extends('frontend.layouts.app')

@push('metas')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Müşteri yorumları ve referanslar. Müşterilerimizin deneyimlerini dinleyin ve bizimle çalışmanın farkını keşfedin.">
    <meta name="keywords" content="müşteri yorumları, referanslar, testimonials, müşteri memnuniyeti">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Müşteri Yorumları">
    <meta property="og:description" content="Müşterilerimizin deneyimlerini dinleyin ve bizimle çalışmanın farkını keşfedin.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')

<!-- Hero Section -->
<section class="service-hero-new">
    <picture>
        <source media="(max-width: 768px)" srcset="{{ $heroImageMobile }}">
        <img src="{{ $heroImage }}"
        alt="Müşteri Yorumları görseli"
        loading="lazy"
        class="service-hero-bg">
    </picture>
    <div class="container">
      <div class="service-hero-content">
        <div class="service-hero-text">
          <p class="service-category">Müşterilerimiz</p>
          <h1 class="service-title">Müşteri Yorumları</h1>
          <p style="color: #fff; font-size: 1rem; margin-top: 10px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);">Müşterilerimizin deneyimlerini dinleyin ve bizimle çalışmanın farkını keşfedin</p>
        </div>
      </div>
    </div>
  </section>

<!-- Modern Minimal Testimonials Grid -->
<section class="testimonials-grid-minimal testimonials-grid-mobile">
    <div class="container">
        <div class="row g-4">
            @foreach($testimonials as $testimonial)
            <div class="col-12 col-md-6 col-lg-4">
                <article class="testimonial-card-minimal" itemscope itemtype="https://schema.org/Review">
                    <!-- Quote Icon -->
                    <div class="testimonial-quote-icon" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 8C10 5.79086 8.20914 4 6 4C3.79086 4 2 5.79086 2 8C2 10.2091 3.79086 12 6 12C6.55228 12 7 12.4477 7 13V14C7 15.6569 5.65685 17 4 17C3.44772 17 3 17.4477 3 18C3 18.5523 3.44772 19 4 19C6.76142 19 9 16.7614 9 14V13C9 11.8954 8.10457 11 7 11C5.34315 11 4 9.65685 4 8C4 6.34315 5.34315 5 7 5C8.65685 5 10 6.34315 10 8Z" fill="currentColor" opacity="0.15"/>
                            <path d="M22 8C22 5.79086 20.2091 4 18 4C15.7909 4 14 5.79086 14 8C14 10.2091 15.7909 12 18 12C18.5523 12 19 12.4477 19 13V14C19 15.6569 17.6569 17 16 17C15.4477 17 15 17.4477 15 18C15 18.5523 15.4477 19 16 19C18.7614 19 21 16.7614 21 14V13C21 11.8954 20.1046 11 19 11C17.3431 11 16 9.65685 16 8C16 6.34315 17.3431 5 19 5C20.6569 5 22 6.34315 22 8Z" fill="currentColor" opacity="0.15"/>
                        </svg>
                    </div>

                    <!-- Content -->
                    <div class="testimonial-content" itemprop="reviewBody">
                        <p class="testimonial-text">{{ $testimonial->description }}</p>
                    </div>

                    <!-- Author Info -->
                    <div class="testimonial-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                        <div class="testimonial-avatar">
                            <img src="{{ $testimonial->image }}" alt="{{ $testimonial->name }} fotoğrafı" itemprop="image" loading="lazy">
                        </div>
                        <div class="testimonial-info">
                            <h2 class="testimonial-name h6" itemprop="name">{{ $testimonial->name }}</h2>
                            @if($testimonial->company)
                            <p class="testimonial-company">{{ $testimonial->company }}</p>
                            @endif
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="testimonials-pagination">
            {{ $testimonialPaginated->links('frontend.components.pagination') }}
        </div>
    </div>
</section>

@endsection
