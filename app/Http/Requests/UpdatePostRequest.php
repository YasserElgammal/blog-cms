<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'title' => ['required','min:3'],
            'content' => ['required','min:20'],
            'cat_id' => ['required','exists:categories,id'],
            'slug' => ['required',Rule::unique('posts')->ignore($this->post->id)],
            'status' => ['required','boolean'],
            'image' => ['required','image','mimes:jpeg,png,jpg','max:2048']
        ];
    }
}
