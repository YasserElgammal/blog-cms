<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Facades\Auth;

class PageObserver
{
    public function creating(Page $page)
    {
        $page->user_id = Auth::id();
    }

    public function updating(Page $page)
    {
        $page->user_id = Auth::id();
    }
}
