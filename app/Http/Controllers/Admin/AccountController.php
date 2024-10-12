<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAccountRequest;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('admin.account.index', compact('user'));
    }


    /**
     * Update the authenticated user's account
     *
     * @param  \App\Http\Requests\Admin\UpdateAccountRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAccountRequest $request)
    {
        $user = auth()->user();
        $data = $request->safe()->except('avatar');

        if ($request->hasfile('avatar')) {
            $get_file = $request->file('avatar')->store('images/profiles');
            $data['avatar'] = $get_file;
        }

        $user->update($data);

        return to_route('admin.account.index')->with('message', 'Account Updated');
    }
}
