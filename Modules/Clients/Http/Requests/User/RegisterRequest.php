<?php

namespace Modules\Clients\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:32',
            'username' => 'required|min:5|max:32|unique:users',
            'password' => 'required|min:5|max:32',
            'password_confirmation' => 'required|min:5|max:32|same:password',
            'phone' => 'required|regex:/^[0-9]+$/|max:10|min:10',
            'email' => 'required|email|unique:users',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
