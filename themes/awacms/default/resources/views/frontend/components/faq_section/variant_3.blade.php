<section class="faq_variant3"
         style="background: {{ isset($bgColor) ? $bgColor : 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\'); background-size: cover; background-position: center;' : '' }};"
         itemscope
         itemtype="https://schema.org/FAQPage"
         aria-labelledby="faq-title-3">

    <div class="container">
        <div class="faq_v3_header text-center">
            <h2 id="faq-title-3" class="faq_v3_title" itemprop="name">
                {{ $title ?? 'Got Questions?' }}
            </h2>
            <p class="faq_v3_subtitle" itemprop="description">
                {{ $subtitle ?? 'We have answers' }}
            </p>
        </div>

        <div class="faq_v3_timeline" id="{{ $faq->slug }}-accordion">
            @foreach($faq->items as $faqItem)
                @include('frontend.components.faq_section.components.variant_3_item', [
                    'item' => $faqItem,
                    'active' => $loop->first ? 'active' : '',
                    'parent' => $faq->slug,
                    'index' => $loop->iteration,
                ])
            @endforeach
        </div>
    </div>
</section>
