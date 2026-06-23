<?php

namespace Modules\Comment\Entities;

use Carbon\Carbon;
use Cog\Flag\Traits\Classic\HasApprovedFlag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use Modules\Comment\Database\Factories\CommentFactory;
use Qirolab\Laravel\Reactions\Contracts\ReactableInterface;
use Qirolab\Laravel\Reactions\Traits\Reactable;

/**
 * @property string $comment
 * @property float $rate
 * @property bool $is_approved
 * @property string $commentable_id
 * @property string $commentable_type
 * @property Model $commentable
 * @property string $commented_id
 * @property string $commented_type
 * @property Model $commented
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Comment extends Model implements ReactableInterface
{
    use HasApprovedFlag;
    use HasFactory;
    use NodeTrait;
    use Reactable;

    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'commented_type',
        'commented_id',
        'fullname',
        'email',
        'comment',
        'is_approved',
        'parent_id',
        'rating',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'rating' => 'float',
        'created_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return CommentFactory::new();
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function commented(): MorphTo
    {
        return $this->morphTo();
    }

    public function getCommentedFullNameAttribute()
    {
        return $this->commented->first_name.' '.$this->commented->last_name;
    }

    public function getCommentedFullNameCensoredAttribute()
    {
        if ($this->commented) {
            return $this->commented->name.' '.Str::mask($this->commented->surname, '*', 1);
        } else {
            return $this->fullname ?? 'Anonim';
        }
    }

    public function scopeApproved(Builder $query): void
    {
        $query->where('is_approved', true);
    }
}
