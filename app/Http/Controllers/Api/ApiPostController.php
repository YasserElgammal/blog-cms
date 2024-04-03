<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\ApiResponse;

class ApiPostController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $posts = Post::with(['user:id,name', 'category:id,name', 'tags:id,name'])->whereStatus(true)->orderByDesc('id')->paginate(15);

        return $this->retrieveResponse(data: PostResource::collection($posts));
    }

    public function show($id)
    {
        $post = Post::with(['user:id,name', 'category:id,name', 'tags:id,name', 'comments.user'])->whereId($id)->whereStatus(true)->firstOrFail();

        return $this->retrieveResponse(data: PostResource::make($post));
    }
}
