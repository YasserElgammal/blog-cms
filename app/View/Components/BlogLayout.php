<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\User;
use Illuminate\View\Component;

class BlogLayout extends Component
{
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = Category::select('id', 'name', 'slug')->get();
        $top_users= User::withCount('posts')->orderBy('posts_count','desc')->take(5)->get();
        $setting = Setting::first();
        $pages_nav = Page::select('id', 'name', 'slug')->whereNavbar(true)->orderBy('id','desc')->get();
        $pages_footer = Page::select('id', 'name', 'slug')->whereFooter(true)->orderBy('id','desc')->get();
        $tags = Tag::whereHas('posts', function($q)
        {
            $q->where('status', 'like', '1');
        })->get();
        
        return view('layouts.blog', compact('categories', 'top_users', 'setting', 'pages_nav', 'pages_footer', 'tags'));
    }
}
