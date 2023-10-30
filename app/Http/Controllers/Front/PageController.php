<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    // Get page by it's slug
    public function getPageBySlug($slug)
    {
        // I've Pass Slug to Get the Page per it's Slug
        $page = Page::whereSlug($slug)->firstOrFail();

        return view('front.page', compact('page'));
    }
}
