<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getPostsPerTags($tag)
    {
        // $posts = $tag->posts();
        $tags = Tag::whereName($tag)->firstOrFail()->publishedPosts();
        // $tag = Tag::whereName($tag)->firstOrFail();

        //  dd($tags);

        return view('tag', compact('tags'));
    }
}
