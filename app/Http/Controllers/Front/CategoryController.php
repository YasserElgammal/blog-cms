<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    // Get Catrgory by it's slug
    public function getCategoryBySlug($slug)
    {
        //Get active posts only in current Category
        $category = Category::whereSlug($slug)->firstOrFail();
        $posts = $category->publishedPosts();
        $category_name = $category->name;

        return view('front.category', compact('posts', 'category_name'));
    }
}
