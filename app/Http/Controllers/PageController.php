<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Get page by it's slug
    public function getPageBySlug($slug)
    {
        // I've Pass Slug to Get the Page per it's Slug
        $page = Page::whereSlug($slug)->firstOrFail();

        return view('page', compact('page'));
    }
}
