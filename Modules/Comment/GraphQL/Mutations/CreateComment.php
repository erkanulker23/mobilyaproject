<?php

namespace Modules\Comment\GraphQL\Mutations;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Modules\Comment\Entities\Comment;

class CreateComment
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args): Comment
    {
        $guard = Auth::guard(config('auth.defaults.guard', 'web'));
        $user = $guard->user();
        $commentable = config('comment.available_commentables.'.$args['commentableType'])::query()->find($args['commentableId']);

        if (isset($args['parentId'])) {
            $parent = $commentable->comments()->where('id', $args['parentId'])->first();
            if (! $parent) {
                throw new ModelNotFoundException('Parent not found');
            }

            return $user->comment($commentable, $args['comment'], $parent);
        } else {
            return $user->comment($commentable, $args['comment']);
        }
    }
}
