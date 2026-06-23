<?php

namespace Modules\Comment\Filament\Resources\CommentResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Comment\Filament\Resources\CommentResource;

class CreateComment extends CreateRecord
{
    protected static string $resource = CommentResource::class;
}
