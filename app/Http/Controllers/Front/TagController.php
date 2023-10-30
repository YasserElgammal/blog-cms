<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{
    public function getPostsPerTags($tag)
    {
        $tags = Tag::whereName($tag)->firstOrFail()->publishedPosts();

        return view('front.tag', compact('tags', 'tag'));
    }
}
