<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    // Home Page
    public function index()
    {
        // Get the active posts with (Category and User) details
        $posts = Post::whereStatus(true)->with(['category', 'user'])->orderBy('id','desc')->paginate(10);

        return view('index', compact('posts'));
    }

}
