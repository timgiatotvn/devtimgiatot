<?php

namespace Modules\Admins\Http\Requests\Advertisement;

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
            'title'    => 'required',
            'thumbnail' => 'required',
            //'thumbnail' => 'required|mimes:jpeg,png,jpg|max:' . env('MAX_UPLOAD') * 1024,
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
