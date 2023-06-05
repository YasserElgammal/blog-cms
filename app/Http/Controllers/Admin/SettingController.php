<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('admin.setting.index', compact('setting'));
    }

    public function update(UpdateSettingRequest $request, Setting $setting){

        $validated = $request->validated();
        $setting->update($validated);
        // dd($validated);
        return back()->with('message','Data Updated !');
    }
}
