<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'avatar' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'url_fb' => ['required', 'url'],
            'url_insta' => ['required', 'url'],
            'url_twitter' => ['required', 'url'],
            'url_linkedin' => ['required', 'url'],
            'bio' => ['required', 'min:4']
        ];
    }
}
