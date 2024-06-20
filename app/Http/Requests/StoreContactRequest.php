<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'group' => ['required',Rule::exists('groups','id')->where('user_id',Auth::id())],
            'first_name' => ['required','max:355'],
            'last_name' => ['required','max:255'],
            'phone' => ['required','max:255'],
        ];
    }
}
