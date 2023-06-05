<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'site_name' => ['required', 'min:3', 'max:20'],
            'contact_email' => ['required', 'email', 'max:255'],
            'description' => ['required', 'min:3', 'max:255'],
            'about' => ['required', 'min:3', 'max:255'],
            'copy_rights' => ['required', 'min:3'],
            'url_fb' => ['required', 'url'],
            'url_insta' => ['required', 'url'],
            'url_twitter' => ['required', 'url'],
            'url_linkedin' => ['required', 'url'],
        ];
    }
}
