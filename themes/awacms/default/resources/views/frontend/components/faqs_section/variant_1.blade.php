<section class="faqs-variant1-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 mb-4 mb-lg-0">
                <div class="faqs-variant1-position-sticky">
                    <ul class="nav faqs-variant1-nav-tabs flex-column" role="tablist">
                        @foreach($faqs as $faq)
                        <li class="nav-item">
                            <a class="nav-link @if($loop->iteration === 1) active @endif" data-bs-toggle="tab" href="#tab_{{$faq->slug}}" role="tab" aria-controls="tab_{{$faq->slug}}" aria-selected="@if($loop->iteration === 1) true @else false @endif">
                                <span class="d-flex align-items-center">
                                    <i data-feather="file-text"></i>
                                    <span>{{ $faq->name }}</span>
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 faqs-variant1-content-area">
                <div class="faqs-variant1-tab-content">
                    @foreach($faqs as $faq)
                    <div class="tab-pane fade faqs-variant1-tab-pane @if($loop->iteration === 1) show active @endif" id="tab_{{$faq->slug}}" role="tabpanel" aria-labelledby="tab_{{$faq->slug}}-tab">
                        <div class="accordion" id="accordion_{{$faq->slug}}">
                            @foreach($faq->items as $item)
                            <div class="faqs-variant1-accordion-item">
                                <h2 class="faqs-variant1-accordion-header" id="heading_{{$faq->slug}}_{{$item->slug}}_{{$loop->iteration}}">
                                    <button class="faqs-variant1-accordion-button @if($loop->iteration !== 1) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$faq->slug}}_{{$item->slug}}_{{$loop->iteration}}" aria-expanded="@if($loop->iteration === 1) true @else false @endif" aria-controls="collapse_{{$faq->slug}}_{{$item->slug}}_{{$loop->iteration}}">
                                        <i data-feather="minus"></i>
                                        <i data-feather="plus"></i>
                                        {{ $item->title }}
                                    </button>
                                </h2>
                                <div id="collapse_{{$faq->slug}}_{{$item->slug}}_{{$loop->iteration}}" class="accordion-collapse collapse @if($loop->iteration === 1) show @endif" aria-labelledby="heading_{{$faq->slug}}_{{$item->slug}}_{{$loop->iteration}}" data-bs-parent="#accordion_{{$faq->slug}}">
                                    <div class="faqs-variant1-accordion-body @if($loop->iteration === $faq->items->count()) faqs-variant1-border-color-transparent @endif">
                                        {!! $item->description !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

