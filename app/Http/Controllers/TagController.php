<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getPostsPerTags($tag)
    {
        $tags = Tag::whereName($tag)->firstOrFail()->publishedPosts();

        return view('tag', compact('tags', 'tag'));
    }
}
