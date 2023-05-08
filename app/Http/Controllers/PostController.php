<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PostController extends Controller
{
    // Get post by it's slug
    public function getPostBySlug($slug)
    {
        // I've Pass Slug to Get the Category per it's Slug
        $post = Post::with(['category', 'user'])->whereStatus(true)->whereSlug($slug)->firstOrFail();
        $post_title = $post->title;

        if ( !Cookie::get('post_viewed_'.$post->id) ) {
            // Update view counter of post
            $post->views = (int) $post->views + 1;
            $post->save();
            // Create a cookie and set it for 1 day
            Cookie::queue('post_viewed_' . $post->id, true, 60 * 24);
        }

        return view('post', compact('post', 'post_title'));
    }
}
