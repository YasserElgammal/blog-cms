<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    // Home Page
    public function index()
    {
        // Get the active posts with (Category and User) details
        $posts = Post::whereStatus(true)->with(['category', 'user'])->orderBy('id','desc')->paginate(10);

        return view('index', compact('posts'));
    }

    // Get post by it's slug
    public function getPostBySlug($slug)
    {
        // I've Pass Slug to Get the Category per it's Slug
        $post = Post::with('category')->whereStatus(true)->whereSlug($slug)->firstOrFail();

        return view('post', compact('post'));
    }

    // Get Catrgory by it's slug
    public function getCategoryBySlug($slug)
    {
        //Get active posts only in current Category
        $posts = Category::whereSlug($slug)->firstOrFail()->publishedPosts();

        // dd($category);
        return view('category', compact('posts'));
    }
}
