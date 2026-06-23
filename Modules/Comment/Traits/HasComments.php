<?php

namespace Modules\Comment\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

/**
 * @property Collection $comments
 */
trait HasComments
{
    public function comments(): MorphMany
    {
        return $this->morphMany(config('comment.model'), 'commentable');
    }

    public function mustBeApproved(): bool
    {
        return false;
    }

    public function primaryId(): string
    {
        return (string) $this->getAttribute($this->primaryKey);
    }

    public function totalCommentsCount(): int
    {
        if (! $this->mustBeApproved()) {
            return $this->comments()->count() ?? 0;
        }

        return $this->comments()->approved()->count() ?? 0;
    }

    public function totalCommentsAverage(): int
    {
        if (! $this->mustBeApproved()) {
            return $this->comments()->avg('rating') ?? 0;
        }

        return $this->comments()->approved()->avg('rating') ?? 0;
    }
}
