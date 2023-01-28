<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user', 'tags'])->whereStatus(true)->orderByDesc('id')->paginate(15);
        return PostResource::collection($posts);
    }

    public function show($id)
    {
        $post = Post::with(['category', 'user'])->whereId($id)->whereStatus(true)->firstOrFail();
        return PostResource::make($post);

    }
}
