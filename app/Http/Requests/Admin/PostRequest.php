<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'title' => ['required', 'min:3'],
            'content' => ['required', 'min:20'],
            'category_id' => ['required', 'exists:categories,id'],
            'slug' => ['required', Rule::unique('posts')->ignore($this?->post?->id)],
            'status' => ['required', 'boolean'],
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:2048', Rule::requiredIf(!$this?->post?->id)],
            'tags' => ['exists:tags,id']
        ];
    }
}
