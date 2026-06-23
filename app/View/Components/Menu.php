<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Menu extends Component
{
    public $menu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $menuName, public string $viewName)
    {

        $menu = \Modules\Menu\Entities\Menu::query()
            ->where('name', $menuName)
            ->first();

        if (! $menu) {
            return;
        }

        $this->menu = Cache::remember('menu-component-'.$menu->id.'-'.$menu->updated_at?->format('Y-m-d-h:i:s'), 60, function () use ($menu) {
            return $menu
                ->load([
                    'items' => function ($query) {
                        $query->whereIsRoot()->defaultOrder()->with([
                            'childrenDeep' => function ($query) {
                                $query->defaultOrder();
                            },
                        ]);
                    },
                    'items.menuable',
                ]);
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view($this->viewName, [
            'menu' => $this->menu,
        ]);
    }
}
