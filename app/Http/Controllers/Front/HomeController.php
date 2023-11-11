<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Setting;
use App\Models\Page;
use App\Models\Category;
class HomeController extends Controller
{
    // Home Page
    public function index()
    {   
        $setting = Setting::first();
        $tags = Tag::whereHas('posts', function($q)
        {
            $q->where('status', 'like', '1');
        })->get();
        // Get the active posts with (Category and User) details
        $posts = Post::published()->with(['category', 'user'])->latest('created_at')->paginate(10);
        $top_users= User::withCount('posts')->orderBy('posts_count','desc')->take(5)->get();
        $pages_nav = Page::select('id', 'name', 'slug')->whereNavbar(true)->orderBy('id','desc')->get();
        $pages_footer = Page::select('id', 'name', 'slug')->whereFooter(true)->orderBy('id','desc')->get();
        $categories = Category::select('id', 'name')->orderBy('id','desc')->get();

        return view('front.blog', compact('posts','setting','tags','top_users','pages_nav','pages_footer', 'categories'));
    }

}
