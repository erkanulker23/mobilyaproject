<section class="team-variant1"
style="background-color: {{ isset($bgColor) ? $bgColor : '#2d1866' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\')' : '' }}">

        <div class="container">
            <div class="sec-head">
                <h6 class="sub-title">{{ $title }}</h6>
                <h2 class="main-title">{{ $subtitle }}</h2>
            </div>
            <div class="row">
            @foreach($members as $member)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="team-card">
                        <div class="img">
                            <img src="{{ $member->photo }}" alt="{{ $member->position }}">
                        </div>
                        <div class="info">
                            <span class="role">{{ $member->fullName }}</span>
                            <h6 class="name">{{ $member->position }}</h6>
                        </div>
                        <div class="social">
                        @foreach($member->socialMediaLinks as $social)
                                <a aria-label="{{ $social->type }}"
                                href="{{ $social->link }}"
                                target="_blank" class="{{ $social->type }}">
                                <i class="{{ $social->customIcon }}"></i>
                                    @if($social->icon)
                                    <x-icon :name="$social->icon" style="max-height:15px"/><span></span>
                                    @endif</a>
                                @endforeach
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </section>
