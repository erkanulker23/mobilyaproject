<?php

namespace Modules\Menu\Http\Livewire;

use Filament\Forms;
use Filament\Forms\Form;
use Livewire\Component;
use Modules\Menu\Entities\MenuItem;
use Modules\Menu\Filament\Resources\MenuItemResource;

class MenuItemForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public int $menuId;

    public $data;

    public function mount(int $menuId): void
    {
        $this->menuId = $menuId;
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Menu Item')
                    ->description('Create New Menu Item')
                    ->schema(MenuItemResource::getFormSchema()),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $menuItem = array_merge($this->data, [
            'menu_id' => $this->menuId,
        ]);

        $menuItem = MenuItem::query()->create($menuItem);

        $this->form->fill();

        $this->dispatch('menu-item-created', menuId: $this->menuId, menuItemId: $menuItem->id);
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    public function render()
    {
        return view('menu::livewire.menu-item-form');
    }
}
