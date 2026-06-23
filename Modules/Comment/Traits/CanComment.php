<?php

namespace Modules\Comment\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Comment\Entities\Comment;

trait CanComment
{
    public function comment(Model $commentable, string $commentText = '', ?Comment $parent = null): Comment
    {
        $commentModel = config('comment.model');
        $comment = new $commentModel([
            'comment' => $commentText,
            'is_approved' => $commentable->mustBeApproved() && ! $this->canCommentWithoutApprove() ? false : true,
            'commented_id' => $this->primaryId(),
            'commented_type' => get_class(),
            'parent_id' => $parent?->id,
        ]);

        $commentable->comments()->save($comment);

        return $comment;
    }

    public function canCommentWithoutApprove(): bool
    {
        return false;
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(config('comment.model'), 'commented');
    }

    public function isCommentBelongsToCommented(Comment $comment)
    {
        return $comment->commented_type === get_class($this) && $comment->commented_id == $this->id;
    }

    private function primaryId(): string
    {
        return (string) $this->getAttribute($this->primaryKey);
    }
}
