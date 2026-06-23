{{-- Latest Blog Post Section - Fixed detailImage property --}}
<section class="latest-blog-section-modern pt-5 pb-5"
style="background-color: {{ isset($bgColor) ? $bgColor : '#f9fafb' }};">

    <div class="container">

        <div class="row justify-content-center mb-4">
            <div class="col-lg-10 text-center">
                @if($subtitle)
                <span class="latest-blog-subtitle">{{ $subtitle }}</span>
                @endif
                <h2 class="latest-blog-title">{{ $title }}</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            @if($post)
                <div class="col-lg-12">
                    <article class="latest-blog-card">
                        @if($post->detailImage && !str_contains($post->detailImage, '/defaults/placeholder-image.jpg'))
                        <div class="latest-blog-image">
                            <a href="{{ $post->url }}">
                                <img src="{{ $post->detailImage }}" alt="{{ $post->title }}" loading="lazy">
                            </a>
                        </div>
                        @endif

                        <div class="latest-blog-content">
                            <div class="latest-blog-meta">
                                @if($post->category)
                                <span class="latest-blog-category">{{ $post->category->title }}</span>
                                @endif
                                <span class="latest-blog-date">
                                    {{ $post->publishAt ? $post->publishAt->format('d.m.Y') : $post->createdAt->format('d.m.Y') }}
                                </span>
                            </div>

                            <h3 class="latest-blog-post-title">
                                <a href="{{ $post->url }}">{{ $post->title }}</a>
                            </h3>

                            @php
                                $plainText = strip_tags($post->content);
                                $excerpt = Str::limit($plainText, 300, '');
                                $isLong = strlen($plainText) > 300;
                            @endphp

                            <div class="latest-blog-text-container">
                                <p class="latest-blog-excerpt" id="blog-excerpt-{{$post->id}}">{{ $excerpt }}@if($isLong)...@endif</p>

                                @if($isLong)
                                <p class="latest-blog-full-text" id="blog-full-{{$post->id}}" style="display: none;">{{ $plainText }}</p>

                                <button class="latest-blog-expand-btn" onclick="toggleBlogText({{$post->id}})" id="blog-toggle-{{$post->id}}">
                                    <span class="show-more-text">Daha Fazla Göster</span>
                                    <span class="show-less-text" style="display: none;">Daha Az Göster</span>
                                    <i class="fas fa-chevron-down ms-2 expand-icon"></i>
                                </button>
                                @endif
                            </div>

                            <a href="{{ $post->url }}" class="latest-blog-link mt-3 d-inline-flex">
                                Devamını Oku
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>

                            <script>
                            function toggleBlogText(postId) {
                                const excerpt = document.getElementById('blog-excerpt-' + postId);
                                const fullText = document.getElementById('blog-full-' + postId);
                                const btn = document.getElementById('blog-toggle-' + postId);
                                const showMore = btn.querySelector('.show-more-text');
                                const showLess = btn.querySelector('.show-less-text');
                                const icon = btn.querySelector('.expand-icon');

                                if (fullText.style.display === 'none') {
                                    excerpt.style.display = 'none';
                                    fullText.style.display = 'block';
                                    showMore.style.display = 'none';
                                    showLess.style.display = 'inline';
                                    icon.style.transform = 'rotate(180deg)';
                                } else {
                                    excerpt.style.display = 'block';
                                    fullText.style.display = 'none';
                                    showMore.style.display = 'inline';
                                    showLess.style.display = 'none';
                                    icon.style.transform = 'rotate(0deg)';
                                }
                            }
                            </script>
                        </div>
                    </article>
                </div>
            @endif
        </div>

    </div>
</section>
