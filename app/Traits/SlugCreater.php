<?php

namespace App\Traits;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait SlugCreater
{
    public function createSlug(Request $request, $model)
    {
        $slug = Str::slug($model == Post::class ? $request->title : $request->name);

        if ($model::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . Str::random(2);
        }

        return $slug;
    }
}
