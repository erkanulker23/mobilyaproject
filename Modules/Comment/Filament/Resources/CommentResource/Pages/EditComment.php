<?php

namespace Modules\Comment\Filament\Resources\CommentResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Comment\Filament\Resources\CommentResource;

class EditComment extends EditRecord
{
    protected static string $resource = CommentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('go_to_content')
                ->label('Yazıya Git')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('info')
                ->url(function () {
                    $comment = $this->record;

                    if ($comment->commentable_type === 'App\\Models\\BlogPost') {
                        $blogPost = \App\Models\BlogPost::find($comment->commentable_id);
                        if ($blogPost) {
                            return route('tr.blog.post.show', $blogPost->slug);
                        }
                    }

                    return '#';
                })
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }
}
