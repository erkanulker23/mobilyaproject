<section class="faq_section_v5"
         style="background-color: {{ isset($bgColor) ? $bgColor : '#fafafa' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\'); background-size: cover; background-position: center;' : '' }};"
         itemscope
         itemtype="https://schema.org/FAQPage"
         aria-labelledby="faq-title-5">

    <div class="container">
        <div class="faq_section_v5_header text-center">
            <h2 id="faq-title-5" class="faq_section_v5_title" itemprop="name">
                {{ $title ?? 'Sıkça Sorulan Sorular' }}
            </h2>
            <p class="faq_section_v5_subtitle" itemprop="description">
                {{ $subtitle ?? 'Merak ettiklerinizin cevaplarını bulun' }}
            </p>
        </div>

        <div class="faq_section_v5_wrapper" id="{{ $faq->slug }}-accordion">
            @foreach($faq->items as $faqItem)
                @include('frontend.components.faq_section.components.variant_5_item', [
                    'item' => $faqItem,
                    'active' => $loop->first ? 'active' : '',
                    'parent' => $faq->slug,
                    'index' => $loop->iteration,
                ])
            @endforeach
        </div>
    </div>
</section>
