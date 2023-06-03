<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\GeneralResource;
use App\Models\Category;

class ApiCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return GeneralResource::collection($categories);
    }

    public function show($id)
    {
        $category = Category::with('posts')->whereId($id)->firstOrFail();
        return CategoryResource::make($category);
    }
}
