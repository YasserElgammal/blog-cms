<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\Auth;

class Authcheck implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $auth_user = Auth::user()->id;
        // security to pervent of inspect and pass another value
        if ($auth_user != $value) {
            $fail('The :attribute must be current Auth User.');
        }
    }
}
