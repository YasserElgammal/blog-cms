<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(15);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post_data = $request->safe()->except('image');

        if ($request->hasfile('image')) {
            $get_file = $request->file('image')->store('images/posts');
            $post_data['image'] = $get_file;
        }

        $post_data['user_id'] = Auth()->user()->id;

        // dd($request->tags);
        $post = Post::create($post_data);

        if ($request->has('tags')) {
            // $validate_tags = $request->validate(['tags'=> ['exists:tags,id']]);
            $post->tags()->attach($request->tags);
            // dd($post);
        }

        return to_route('admin.post.index')->with('message', 'Post Created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post_data = $request->safe()->except('image');

        if ($request->hasfile('image')) {
            Storage::delete($post->image);
            $get_file = $request->file('image')->store('images/posts');
            $post_data['image'] = $get_file;
        }

        $post_data['user_id'] = Auth()->user()->id;
        $post->update($post_data);
        $post->tags()->sync($request->tags);

        return to_route('admin.post.index')->with('message', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image != null) {
            Storage::delete($post->image);
        }
        $post->delete();
        return back()->with('message', 'Post Deleted');
    }

    public function getSlug(Request $request)
    {
        $slug = str($request->title)->slug();
        if (Post::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . Str::random(2);
            return response()->json(['slug' => $slug]);
        } else {
            return response()->json(['slug' => $slug]);
        }
    }

    public function search(Request $request)
    {
        $searched_text = $request->input('search');

        $posts = Post::query()
        ->where('title', 'LIKE', "%{$searched_text}%")
        ->orWhere('content', 'LIKE', "%{$searched_text}%")
        ->paginate(10);

    // Return the search view with the resluts
    return view('admin.post.search', compact('posts'));

    }
}
