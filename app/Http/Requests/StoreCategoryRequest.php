<?php

namespace App\Http\Requests;

use App\Rules\Authcheck;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => ['required', 'unique:categories', 'min:3', 'max:25'],
            'slug' => ['required', 'unique:categories'],
            'user_id' => ['required', 'exists:users,id', new Authcheck]
        ];
    }
}
