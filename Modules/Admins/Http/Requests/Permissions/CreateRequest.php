<?php

namespace Modules\Admins\Http\Requests\Permissions;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required|unique:permissions,name|regex:/^[ a-zA-Z0-9]+$/',
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

    public function messages()
    {
        return [
            'name.regex' => 'Tên quyền truy cập không được chưa ký tự đặc biệt'
        ];
    }
}
