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
        $posts = Category::whereSlug($slug)->firstOrFail()->publishedPosts();
        $category_name = Category::select('name')->whereSlug($slug)->firstOrFail();

        return view('category', compact('posts', 'category_name'));
    }
}
