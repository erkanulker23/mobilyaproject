<?php

namespace App\DTOs;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Enumerable;
use Modules\Badge\Entities\Badge;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class BadgeData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $bg_color,
        public string $text_color,
        public string $display_type,
        public string $display_position,
        public ?string $image,
    ) {
        //
    }

    public static function fromModel(Badge $badge): self
    {
        return new self(
            id: $badge->id,
            name: $badge->name,
            bg_color: $badge->bg_color,
            text_color: $badge->text_color,
            display_type: $badge->display_type,
            display_position: $badge->display_position,
            image: $badge->getFirstMediaUrl('image'),
        );
    }

    public static function collection(Paginator|Enumerable|array|AbstractCursorPaginator|DataCollection|AbstractPaginator|CursorPaginator|null $items): DataCollection|CursorPaginatedDataCollection|PaginatedDataCollection
    {
        if ($items->count() > 0) {
            $items->load([
                'media',
            ]);
        }

        return parent::collection($items);
    }
}
