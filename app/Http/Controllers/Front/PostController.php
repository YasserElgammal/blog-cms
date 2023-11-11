<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Support\Facades\Cookie;

class PostController extends Controller
{
    // Get post by it's slug
    public function getPostBySlug($slug)
    {
        // I've Pass Slug to Get the Category per it's Slug
        $post = Post::with(['category', 'user', 'comments.user'])
        ->whereStatus(true)->whereSlug($slug)->firstOrFail();

        $comments = $post->comments;
        $post_title = $post->title;

        if (!Cookie::get('post_viewed_' . $post->id)) {
            // Update view counter of post
            $post->increment('views');
            // Create a cookie and set it for 1 day
            Cookie::queue('post_viewed_' . $post->id, true, 60 * 24);
        }

        $pages_nav = Page::select('id', 'name', 'slug')->whereNavbar(true)->orderBy('id','desc')->get();
        $pages_footer = Page::select('id', 'name', 'slug')->whereFooter(true)->orderBy('id','desc')->get();
        $setting = Setting::first();
        $categories = Category::select('id', 'name')->orderBy('id','desc')->get();
        return view('front.post_detail', compact('post', 'post_title', 'comments','setting','pages_nav','pages_footer','categories'));
    }

}
