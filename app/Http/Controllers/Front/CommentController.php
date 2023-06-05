<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function makeComment(CommentRequest $request, Post $post)
    {
        $validated = $request->validated();

        $post->comments()->create([
            'user_id' => Auth::id(),
            'body' => $validated['body']
        ]);

        return back()->with('message', 'Comment Created !');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('message', 'Comment Deleted');
    }

}
