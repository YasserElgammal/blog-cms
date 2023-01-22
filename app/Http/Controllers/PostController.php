<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Get post by it's slug
    public function getPostBySlug($slug)
    {
        // I've Pass Slug to Get the Category per it's Slug
        $post = Post::with(['category', 'user'])->whereStatus(true)->whereSlug($slug)->firstOrFail();
        $post_title = Post::select('title')->whereSlug($slug)->first();
        
        return view('post', compact('post', 'post_title'));
    }
}
