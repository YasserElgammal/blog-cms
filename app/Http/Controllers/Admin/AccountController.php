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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request)
    {
        $user = auth()->user();
        $data = $request->safe()->except('avatar');

        if ($request->hasfile('avatar')) {
            if ($user->avatar != null) {
                Storage::delete($user->avatar);
            }
            $get_file = $request->file('avatar')->store('images/profiles');
            $user->avatar = $get_file;
        }

        $user->update($data);

        return to_route('admin.account.index')->with('message', 'Account Updated');
    }
}
