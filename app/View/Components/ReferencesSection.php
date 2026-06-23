<?php

namespace App\View\Components;

use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class ReferencesSection extends Component
{
    use HasViewVariants;

    public int $limit;

    public string $title;

    public string $subtitle;

    public string $bgImage = '';

    public ?string $bgColor;

    public $references;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->limit = $data['limit'] ?? 5;
        $this->title = $data['section_title'] ?? 'Testimonials';
        $this->subtitle = $data['section_subtitle'] ?? 'Testimonials';
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';

        $this->references = Cache::remember('references_section', 60 * 60, function () {
            $references = \Modules\References\Entities\Reference::orderBy('order_column', 'asc')->get();

            $referenceItems = collect();

            foreach ($references as $reference) {
                // Eğer media library'de resimler varsa
                $mediaItems = $reference->getMedia('logo');

                if ($mediaItems->count() > 0) {
                    // Her resim için ayrı item oluştur
                    foreach ($mediaItems as $media) {
                        $referenceItems->push((object)[
                            'id' => $reference->id . '-' . $media->id,
                            'title' => $reference->title,
                            'logo' => $media->getUrl(),
                            'order_column' => $reference->order_column,
                        ]);
                    }
                } else {
                    // Eski logo field'ı varsa onu kullan
                    $referenceItems->push(\App\DTOs\Reference\ReferenceData::from($reference));
                }

                // Limit kontrolü
                if ($referenceItems->count() >= $this->limit) {
                    break;
                }
            }

            return $referenceItems->take($this->limit);
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
        return 'frontend.components.references_section';
    }
}
