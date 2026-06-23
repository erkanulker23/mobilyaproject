<section class="faq_variant1"
         style="background-color: {{ isset($bgColor) ? $bgColor : '#f8fafc' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\'); background-size: cover; background-position: center;' : '' }};"
         itemscope
         itemtype="https://schema.org/FAQPage"
         aria-labelledby="faq-title-1">

    <div class="container">
        <div class="faq_v1_header text-center">
            <span class="faq_v1_badge">FAQ</span>
            <h2 id="faq-title-1" class="faq_v1_title" itemprop="name">
                {{ $title ?? 'Sıkça Sorulan Sorular' }}
            </h2>
            <p class="faq_v1_subtitle" itemprop="description">
                {{ $subtitle ?? 'Merak ettiklerinizin cevaplarını burada bulabilirsiniz' }}
            </p>
        </div>

        <div class="faq_v1_list" id="{{ $faq->slug }}-accordion">
            @foreach($faq->items as $faqItem)
                @include('frontend.components.faq_section.components.variant_1_item', [
                    'item' => $faqItem,
                    'active' => $loop->first ? 'active' : '',
                    'parent' => $faq->slug,
                    'index' => $loop->iteration,
                ])
            @endforeach
        </div>
    </div>
</section>
