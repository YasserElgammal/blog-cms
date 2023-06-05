<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(){

        $pages = Page::with('user')->orderBy('id', 'desc')->paginate(15);
        return view('admin.page.index', compact('pages'));
    }

    public function create(){

        return view('admin.page.create');
    }

    public function store(PageRequest $request){

        $page_data = $request->validated();
        $page_data['user_id'] = auth()->user()->id;

        // dd($page_data);
        Page::create($page_data);

        return to_route('admin.page.index')->with('message', 'Page Created');
    }

    public function update(PageRequest $request, Page $page){

        $page_data = $request->validated();
        $page_data['user_id'] = auth()->user()->id;

        $page->update($page_data);

        return to_route('admin.page.index')->with('message', 'Page Updated');
    }

    public function edit(Page $page){

        return view('admin.page.edit', compact('page'));
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return back()->with('message', 'Page Deleted');
    }

    public function getSlug(Request $request)
    {
        $slug = str($request->name)->slug();
        if (Page::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . Str::random(2);
            return response()->json(['slug' => $slug]);
        } else {
            return response()->json(['slug' => $slug]);
        }
    }


}
