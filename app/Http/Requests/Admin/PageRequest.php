<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
        //    protected $fillable = ['name', 'content', 'navbar', 'footer', 'user_id'];

        return [
            'name' => ['required', 'min:3'],
            'slug' => ['required', Rule::unique('pages')->ignore($this?->page?->id)],
            'content' => ['required', 'min:10'],
            'navbar' => ['required', 'boolean'],
            'footer' => ['required', 'boolean'],
            'user_id' => ['required', 'exists:users,id']
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id()
        ]);
    }
}
