<?php

namespace App\Http\Requests\Panel\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'profile' => ['nullable','max:2048'], 
            'name' => ['required','string'], 
            'email' => ['required','string','email',Rule::unique('users')->ignore(auth()->user()->id)],
            'mobile' => ['required','string',Rule::unique('users')->ignore(auth()->user()->id)],
            'password' => ['nullable','min:6'], 
        ];
    }
}
