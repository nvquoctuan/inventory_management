<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "email" => "required|max:255|email",
            "name" => "required|max:255|min:5",
            "password" => "required|min:5|max:255",
            "password_confirmation" => "required|min:5|max:255|same:password",
        ];
    }
}
