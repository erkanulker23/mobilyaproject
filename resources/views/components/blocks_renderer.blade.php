@if($blocks && is_array($blocks))
@foreach ($blocks as $section)
        @switch($section["type"])
            @case("header_section")
                <x-header-section :data="$section['data']" />
                @break

            @case("hero_slider")
                <x-slider :data="$section['data']" />
                @break

            @case("plans_section")
                <x-plans-section
                    :data="$section['data']"
                />
                @break

            @case("service_post_slider")
                <x-service-post-slider-section
                    :data="$section['data']"
                />
                @break

            @case("testimonials_list")
                <x-testimonials-section
                    :data="$section['data']"
                />
                @break

            @case("google_reviews_section")
                <x-google-reviews-section
                    :data="$section['data']"
                />
                @break

            @case("faq_section")
                <x-faq-section
                    :data="$section['data']"
                />
                @break

            @case("faqs_section")
                <x-faqs-section
                    :data="$section['data']"
                />
                @break

            @case("references_section")
                <x-references-section
                    :data="$section['data']"
                />
                @break

            @case("blog_post_slider_section")
                <x-blog-post-slider-section
                    :data="$section['data']"
                />
                @break

            @case("features_section")
                <x-features-section
                    :data="$section['data']"
                />
                @break

            @case("our_team_section")
                <x-our-team-section
                    :data="$section['data']"
                />
                @break

            @case("newsletter_form_section")
                <x-newsletter-form-section
                    :data="$section['data']"
                />
                @break

            @case("counters_section")
                <x-counters-section
                    :data="$section['data']"
                />
                @break

            @case("operations_section")
                <x-operations-section
                    :data="$section['data']"
                />
                @break

            @case("latest_blog_post_section")
                <x-latest-blog-post-section
                    :data="$section['data']"
                />
                @break

            @case("request_form_section")
                <x-request-form-section
                    :data="$section['data']"
                />
                @break

            @case("footer_section")
                <x-footer-section :data="$section['data']" />
                @break

            @case("about_us_section")
                <x-about-us-section :data="$section['data']" />
                @break

            @case("service_category_slider")
                <x-service-category-slider-section :data="$section['data']" />
                @break

            @case("projects_section")
                <x-projects-section :data="$section['data']" />
                @break

            @default
                <div class="alert alert-danger text-center fw-bold">
                    <h3>{{ $section["type"] }} is not supported or not found.</h3>
                </div>
        @endswitch
    @endforeach
@endif
