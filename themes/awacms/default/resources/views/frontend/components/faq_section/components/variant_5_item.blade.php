@php
$target = $parent .'-accordion-' . $item->slug;
@endphp

<div class="faq_section_v5_item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <button class="faq_section_v5_question collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#{{ $target }}"
            aria-expanded="{{ $active ? 'true' : 'false' }}"
            aria-controls="{{ $target }}">
        <span class="faq_section_v5_number">{{ sprintf('%02d', $index) }}</span>
        <h3 class="faq_section_v5_question_text" itemprop="name">{{ $item->title }}</h3>
        <span class="faq_section_v5_icon">
            <i class="fas fa-plus"></i>
        </span>
    </button>
    <div id="{{ $target }}"
         class="faq_section_v5_answer collapse {{ $active ? 'show' : '' }}"
         data-bs-parent="#{{ $parent }}-accordion"
         itemscope
         itemprop="acceptedAnswer"
         itemtype="https://schema.org/Answer">
        <div class="faq_section_v5_answer_content" itemprop="text">
            {!! $item->description !!}
        </div>
    </div>
</div>
