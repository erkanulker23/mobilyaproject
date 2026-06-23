<?php

namespace App\DTOs\Menu;

use Modules\Menu\Entities\Menu;
use Spatie\LaravelData\Resolvers\DataFromSomethingResolver;

class MenuData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $name,
        public $items,
    ) {
        //
    }

    public static function fromModel(Menu $menu): self
    {
        $items = MenuItemData::collection($menu->items()->with('menuable')->defaultOrder()->get()->toTree());

        return new self(
            id: $menu->id,
            name: $menu->name,
            items: $items,
        );
    }

    public static function from(mixed ...$payloads): static
    {
        // if its integer, then it's a menu id
        if (is_int($menu = $payloads[0])) {
            $menuModel = Menu::find($menu);

            return self::fromModel($menuModel);
        }

        if (! $payloads[0]) {
            return new static(
                id: 0,
                name: '',
                items: [],
            );
        }

        return app(DataFromSomethingResolver::class)->execute(
            static::class,
            ...$payloads
        );
    }
}
