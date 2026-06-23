<?php

namespace App\DTOs\Menu;

use Modules\Menu\Entities\MenuItem;

class MenuItemData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $target,
        public ?string $icon,
        public ?string $linkClass,
        public ?string $wrapperClass,
        public int $menuId,
        public $parameters,
        public ?int $menuableId,
        public ?string $menuableType,
        public ?bool $megaMenu,
        public ?int $columns,
        public ?string $link,
        public $children,
    ) {
        //
    }

    public static function fromModel(MenuItem $menuItem): self
    {
        $children = self::collection($menuItem->children);

        return new self(
            id: $menuItem->id,
            name: $menuItem->name,
            target: $menuItem->target,
            icon: $menuItem->icon,
            linkClass: $menuItem->link_class,
            wrapperClass: $menuItem->wrapper_class,
            menuId: $menuItem->menu_id,
            parameters: $menuItem->parameters,
            menuableId: $menuItem->menuable_id,
            menuableType: $menuItem->menuable_type,
            megaMenu: (bool) $menuItem->parameters->get('mega_menu'),
            columns: (int) $menuItem->parameters->get('mega_menu_columns'),
            link: $menuItem->link,
            children: $children,
        );
    }
}
