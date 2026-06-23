@php
$target = $parent .'-accordion-' . $item->slug;
@endphp

<article class="faq_v3_item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <div class="faq_v3_marker">
        <div class="faq_v3_number">{{ $index }}</div>
        <div class="faq_v3_line"></div>
    </div>

    <div class="faq_v3_content">
        <div class="faq_v3_question collapsed"
             role="button"
             data-bs-toggle="collapse"
             data-bs-target="#{{ $target }}"
             aria-expanded="{{ $active ? 'true' : 'false' }}"
             aria-controls="{{ $target }}">
            <h3 class="faq_v3_question_title" itemprop="name">
                {{ $item->title }}
            </h3>
            <div class="faq_v3_icon">
                <i class="fas fa-angle-down"></i>
            </div>
        </div>
        <div id="{{ $target }}"
             class="faq_v3_answer collapse {{ $active ? 'show' : '' }}"
             data-bs-parent="#{{ $parent }}-accordion"
             itemscope
             itemprop="acceptedAnswer"
             itemtype="https://schema.org/Answer">
            <div class="faq_v3_answer_text" itemprop="text">
                {!! $item->description !!}
            </div>
        </div>
    </div>
</article>
