<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\SimplePostResource;
use App\Models\Post;

class ApiPostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user:id,name', 'category:id,name', 'tags:id,name'])->whereStatus(true)->orderByDesc('id')->paginate(15);
        return PostResource::collection($posts);
    }

    public function show($id)
    {
        $post = Post::with(['user:id,name', 'category:id,name', 'tags:id,name', 'comments.user'])->whereId($id)->whereStatus(true)->firstOrFail();
        return PostResource::make($post);
    }
}
