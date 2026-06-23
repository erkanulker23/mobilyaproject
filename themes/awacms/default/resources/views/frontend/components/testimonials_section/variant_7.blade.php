<section class="testimonials-v7-modern"
         aria-labelledby="testimonial-title-7"
         style="background-color: {{ isset($bgColor) ? $bgColor : '#f9fafb' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\');background-size:cover;background-position:center' : '' }}">

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                @if($subtitle)
                <span class="testimonials-v7-subtitle">{{ $subtitle }}</span>
                @endif
                <h2 id="testimonial-title-7" class="testimonials-v7-title">
                    {{ $title ?? 'Müşteri Yorumları' }}
                </h2>
            </div>
        </div>

        <div class="swiper testimonials-v7-swiper">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="testimonial-v7-card">
                        <div class="testimonial-v7-quote">
                            <i class="fas fa-quote-left"></i>
                        </div>

                        <div class="testimonial-v7-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $testimonial->rating ? 'active' : '' }}"></i>
                            @endfor
                        </div>

                        <div class="testimonial-v7-text">
                            <p>{{ $testimonial->description }}</p>
                        </div>

                        <div class="testimonial-v7-author">
                            @if($testimonial->image)
                            <img src="{{ $testimonial->image }}" alt="{{ $testimonial->name }}" class="testimonial-v7-avatar">
                            @else
                            <div class="testimonial-v7-avatar-placeholder">
                                <span>{{ mb_substr($testimonial->name, 0, 1) }}</span>
                            </div>
                            @endif
                            <div class="testimonial-v7-author-info">
                                <h4 class="testimonial-v7-name">{{ $testimonial->name }}</h4>
                                @if($testimonial->title || $testimonial->company)
                                <p class="testimonial-v7-position">{{ $testimonial->title }} @if($testimonial->title && $testimonial->company) - @endif {{ $testimonial->company }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="testimonials-v7-nav">
                <div class="swiper-button-prev testimonials-v7-prev"></div>
                <div class="swiper-button-next testimonials-v7-next"></div>
            </div>
            <div class="swiper-pagination testimonials-v7-pagination"></div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ url('tr/musteri-yorumlari') }}" class="testimonials-v7-all-btn">Tüm Yorumları Gör</a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.testimonials-v7-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: {{ count($testimonials) >= 3 ? 'true' : 'false' }},
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.testimonials-v7-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.testimonials-v7-next',
            prevEl: '.testimonials-v7-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
    });
});
</script>

<style>
.testimonials-v7-modern {
    padding: 80px 0;
}

.testimonials-v7-subtitle {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #667eea;
    margin-bottom: 10px;
}

.testimonials-v7-title {
    font-size: 38px;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
}

.testimonials-v7-swiper {
    padding: 20px 10px 70px;
    position: relative;
}

.testimonial-v7-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 36px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 2px solid transparent;
}

.testimonial-v7-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
    border-color: #667eea;
}

.testimonial-v7-quote {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
}

.testimonial-v7-quote i {
    font-size: 20px;
    color: #ffffff;
}

.testimonial-v7-rating {
    display: flex;
    gap: 4px;
    margin-bottom: 20px;
}

.testimonial-v7-rating i {
    font-size: 16px;
    color: #e5e7eb;
}

.testimonial-v7-rating i.active {
    color: #fbbf24;
}

.testimonial-v7-text {
    flex: 1;
    margin-bottom: 24px;
}

.testimonial-v7-text p {
    font-size: 15px;
    line-height: 1.7;
    color: #4b5563;
    margin: 0;
}

.testimonial-v7-author {
    display: flex;
    align-items: center;
    gap: 16px;
    padding-top: 24px;
    border-top: 1px solid #e5e7eb;
}

.testimonial-v7-avatar,
.testimonial-v7-avatar-placeholder {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
}

.testimonial-v7-avatar-placeholder {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    font-weight: 700;
    color: #ffffff;
}

.testimonial-v7-author-info {
    flex: 1;
}

.testimonial-v7-name {
    font-size: 17px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 4px 0;
}

.testimonial-v7-position {
    font-size: 13px;
    color: #6b7280;
    margin: 0;
}

.testimonials-v7-nav {
    display: flex;
    gap: 12px;
    justify-content: center;
    margin-top: 30px;
}

.testimonials-v7-prev,
.testimonials-v7-next {
    position: static !important;
    width: 48px !important;
    height: 48px !important;
    background: #667eea !important;
    border-radius: 50%;
    margin: 0 !important;
}

.testimonials-v7-prev::after,
.testimonials-v7-next::after {
    font-size: 18px;
    color: #ffffff;
    font-weight: 700;
}

.testimonials-v7-prev:hover,
.testimonials-v7-next:hover {
    background: #764ba2 !important;
}

.testimonials-v7-pagination {
    margin-top: 30px;
}

.testimonials-v7-pagination .swiper-pagination-bullet {
    width: 10px !important;
    height: 10px !important;
    background: #667eea;
    opacity: 0.3;
}

.testimonials-v7-pagination .swiper-pagination-bullet-active {
    opacity: 1;
    width: 24px !important;
    border-radius: 5px;
}

.testimonials-v7-all-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #667eea;
    color: white;
    padding: 14px 32px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.testimonials-v7-all-btn:hover {
    background: #764ba2;
    color: white;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .testimonials-v7-modern {
        padding: 60px 0;
    }

    .testimonials-v7-title {
        font-size: 28px;
    }

    .testimonial-v7-card {
        padding: 28px;
    }
}
</style>
