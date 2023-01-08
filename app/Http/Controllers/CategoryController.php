<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Get Catrgory by it's slug
    public function getCategoryBySlug($slug)
    {
        //Get active posts only in current Category
        $posts = Category::whereSlug($slug)->firstOrFail()->publishedPosts();

        // dd($category);
        return view('category', compact('posts'));
    }
}
