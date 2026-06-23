<?php

namespace Modules\Comment\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Comment\Entities\Comment;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;

        return $user->can('view_any_comment');
    }

    public function view(User $user, Comment $comment)
    {
        return true;

        return $user->can('view_comment');
    }

    public function create(User $user)
    {
        return true;

        return $user->can('create_comment');
    }

    public function update(User $user, Comment $comment)
    {
        return true;

        return $user->can('update_comment') || $user->isCommentBelongsToCommented($comment);
    }

    public function delete(User $user, Comment $comment)
    {
        return true;

        return $user->can('delete_comment') || $user->isCommentBelongsToCommented($comment);
    }

    public function restore(User $user, Comment $comment)
    {
        return true;

        return $user->can('restore_comment') || $user->isCommentBelongsToCommented($comment);
    }

    public function forceDelete(User $user, Comment $comment)
    {
        return true;

        return $user->can('force_delete_comment') || $user->isCommentBelongsToCommented($comment);
    }
}
