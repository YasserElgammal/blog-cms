<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostObserver
{
    public function creating(Post $post)
    {
        $post->user_id = Auth::id();
    }

    public function updating(Post $post)
    {
        if (!request()->routeIs('post.show')) {
            $post->user_id = Auth::id();
        }
    }
}
