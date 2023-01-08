<?php

namespace App\Http\Requests;

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
            'site_name' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'about' => ['required', 'min:3'],
            'copy_rights' => ['required', 'min:3'],
            'url_fb' => ['required', 'url'],
            'url_insta' => ['required', 'url'],
            'url_twitter' => ['required', 'url'],
            'url_linkedin' => ['required', 'url'],
        ];
    }
}
