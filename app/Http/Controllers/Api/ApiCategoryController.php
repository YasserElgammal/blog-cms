<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponse;

class ApiCategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $categories = Category::paginate(15);

        return $this->retrieveResponse(data: CategoryResource::collection($categories));
    }

    public function show($id)
    {
        $category = Category::with('posts')->whereId($id)->firstOrFail();

        return $this->retrieveResponse(data: CategoryResource::make($category));
    }
}
