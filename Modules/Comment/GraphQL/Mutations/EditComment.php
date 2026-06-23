<?php

namespace Modules\Comment\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use Modules\Comment\Entities\Comment;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;

class EditComment
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args): Comment
    {
        $guard = Auth::guard(config('auth.defaults.guard', 'web'));
        $user = $guard->user();

        $comment = $user->comments()->where('id', $args['id'])->first();

        if ($comment) {
            $comment->update([
                'comment' => $args['comment'],
            ]);

            return $comment;
        } else {
            throw new AuthorizationException();
        }
    }
}
