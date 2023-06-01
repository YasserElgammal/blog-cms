<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{

    public function viewAny(User $user)
    {
        return $user->getRole('Admin');
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->id == $comment->user->id;
    }
}
