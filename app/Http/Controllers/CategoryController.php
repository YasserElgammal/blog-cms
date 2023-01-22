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
        $category_name = Category::select('name')->whereSlug($slug)->first();
        
        return view('category', compact('posts', 'category_name'));
    }
}
