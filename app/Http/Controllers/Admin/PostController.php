<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
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
        return view('admin.post.create', compact('categories'));
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

        // dd($post_data);
        Post::create($post_data);

        return to_route('admin.post.index')->with('message', 'Post Created');
        // dd($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('admin.post.edit', compact('post', 'categories'));
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
}
