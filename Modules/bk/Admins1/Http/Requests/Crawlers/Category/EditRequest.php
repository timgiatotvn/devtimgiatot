<?php

namespace Modules\Admins\Http\Requests\Crawlers\Category;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url'    => 'required',
            'class_parent'    => 'required',
            'class_url_image'    => 'required',
            'class_url_a'    => 'required',
            'type'    => 'required',
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
