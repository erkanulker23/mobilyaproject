<?php

namespace App\View\Components;

use App\DTOs\Member\MemberData;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Modules\Members\Entities\Member;

class OurTeamSection extends Component
{
    use HasViewVariants;

    public int $limit;

    public string $title;

    public string $subtitle;

    public ?string $bgColor;

    public string $bgImage = '';

    public $members;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->limit = $data['limit'] ?? 5;
        $this->title = $data['section_title'] ?? 'Our Team';
        $this->subtitle = $data['section_subtitle'] ?? 'Meet our team members and get to know them better.';
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';

        $this->members = Cache::remember('members_section', 60 * 60, function () {
            $models = Member::limit($this->limit)->get();

            return MemberData::collection($models);
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $view = $this->variantViewPath();

        return view($view);
    }

    public function path()
    {
        return 'frontend.components.our_team_section';
    }
}
