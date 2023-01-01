<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){

        // $auth_user = Auth::user()->name;

        return view('admin.index');
    }
}
