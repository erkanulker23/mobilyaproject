<?php

namespace Modules\Menu\Http\Livewire;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Support\Enums\ActionSize;
use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\MenuItem;
use Modules\Menu\Filament\Resources\MenuItemResource;

class MenuBuilder extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public int $menuId;

    public Collection $items;

    public array $data = [];

    protected $listeners = [
        'menu-item-created' => 'fillItems',
    ];

    public function mount(int $menuId): void
    {
        $this->menuId = $menuId;
        $this->fillItems();
    }

    public function deleteAction(): Action
    {
        // TODO: extend action and make new delete action for this component
        return Action::make('delete')
            ->size(ActionSize::ExtraSmall)
            ->icon('heroicon-m-trash')
            ->iconButton()
            ->requiresConfirmation()
            ->modalHeading('Menü Öğesini Sil')
            ->modalDescription('Bu menü öğesini silmek istediğinizden emin misiniz? Altındaki tüm öğeler de silinecek.')
            ->modalSubmitActionLabel('Sil')
            ->action(function (array $arguments) {
                $menuItemId = $arguments['menuItemId'];

                $menuItem = MenuItem::find($menuItemId);
                if (! $menuItem) {
                    return;
                }
                MenuItem::descendantsOf($menuItem)->each(function (MenuItem $menuItem) {
                    $menuItem->delete();
                });

                $menuItem->delete();
            });
    }

    public function editAction(): Action
    {
        // TODO: extend action and make new edit action for this component
        return Action::make('edit')
            ->size(ActionSize::ExtraSmall)
            ->icon('heroicon-m-pencil')
            ->iconButton()
            ->fillForm(function (array $arguments) {
                $menuItemId = $arguments['menuItemId'];
                $menuItem = MenuItem::find($menuItemId);

                return [
                    'name' => $menuItem->name,
                    'icon' => $menuItem->icon,
                    'target' => $menuItem->target,
                    'link_class' => $menuItem->link_class,
                    'wrapper_class' => $menuItem->wrapper_class,
                    'menuable_type' => $menuItem->menuable_type,
                    'menuable_id' => $menuItem->menuable_id,
                    'url' => $menuItem->url,
                    'parameters' => $menuItem->parameters->toArray(),
                ];
            })
            ->form(fn () => MenuItemResource::getFormSchema())
            ->action(function (array $arguments, $data) {
                $menuItemId = $arguments['menuItemId'];

                $menuItem = MenuItem::find($menuItemId);
                if (! $menuItem) {
                    return;
                }

                $menuItem->update($data);
            });
    }

    public function createSubItemAction(): Action
    {
        // TODO: extend action and make new edit action for this component
        return Action::make('createSubItem')
            ->size(ActionSize::ExtraSmall)
            ->icon('heroicon-m-plus')
            ->iconButton()
            ->form(fn () => MenuItemResource::getFormSchema())
            ->action(function (array $arguments, $data) {
                $parent = MenuItem::find($arguments['menuItemId']);
                if (! $parent) {
                    return;
                }

                $menuItem = MenuItem::create([
                    ...$data,
                    'menu_id' => $this->menuId,
                ]);
                $parent->appendNode($menuItem);
            });
    }

    public function viewAction(): Action
    {
        // TODO: extend action and make new edit action for this component
        return Action::make('view')
            ->size(ActionSize::ExtraSmall)
            ->icon('heroicon-m-eye')
            ->iconButton()
            ->action(function (array $arguments) {
                $menuItemId = $arguments['menuItemId'];
            });
    }

    public function render()
    {
        return view('menu::livewire.menu-builder');
    }

    public function fillItems(): void
    {
        $this->items = Menu::find($this->menuId)
            ->items()
            ->with(['childrenDeep' => function ($query) {
                $query->defaultOrder();
            }])
            ->whereIsRoot()
            ->defaultOrder()
            ->get();
    }

    public function save(): void
    {
        if (empty($this->data)) {
            return;
        }

        MenuItem::rebuildTree($this->data);

        Notification::make()
            ->title('Menü Kaydedildi!')
            ->success()
            ->send();

        $this->fillItems();
    }
}
