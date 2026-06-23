<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait Publishable
{
    public function initializePublishable(): void
    {
        $this->casts = array_merge($this->casts, [
            'publish_at' => 'datetime',
            'unpublish_at' => 'datetime',
        ]);
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('publish_at', '<=', Carbon::now())
            ->where(function ($q) {
                $q->whereNull('unpublish_at')
                    ->orWhere('unpublish_at', '>', Carbon::now());
            });
    }

    public function scopeUnpublished(Builder $query)
    {
        return $query->where('publish_at', '>', Carbon::now())
            ->orWhere(function ($q) {
                $q->whereNotNull('unpublish_at')
                    ->where('unpublish_at', '<=', Carbon::now());
            });
    }

    public function isPublished()
    {
        return $this->publish_at->lte(Carbon::now()) &&
            ($this->unpublish_at === null || $this->unpublish_at->gte(Carbon::now()));
    }

    public function isUnpublished()
    {
        return ! $this->isPublished();
    }

    public function publish()
    {
        $this->publish_at = Carbon::now();

        if (! is_null($this->unpublish_at) && $this->unpublish_at->lte(Carbon::now())) {
            $this->unpublish_at = null;
        }

        return $this->save();
    }

    public function publishQuietly()
    {
        $this->publish_at = Carbon::now();

        if (! is_null($this->unpublish_at) && $this->unpublish_at->lte(Carbon::now())) {
            $this->unpublish_at = null;
        }

        return $this->saveQuietly();
    }

    public function unpublish()
    {
        $this->unpublish_at = Carbon::now();

        return $this->save();
    }

    public function unpublishQuietly()
    {
        $this->unpublish_at = Carbon::now();

        return $this->saveQuietly();
    }
}
