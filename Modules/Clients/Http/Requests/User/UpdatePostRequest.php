<?php

namespace Modules\Clients\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required',
            'thumbnail' => 'nullable|mimes:png,jpeg,jpg',
            'title' => 'required',
            'content' => 'required|string|min:700'
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
            'code.required' => 'Mã xác thực là bắt buộc',
            'thumbnail.mimes' => 'Ảnh chỉ được phép định dạng png, jpg',
            'title.required' => 'Tiêu đề là bắt buộc',
            'content.required' => 'Nội dung là bắt buộc'
        ];
    }
}
