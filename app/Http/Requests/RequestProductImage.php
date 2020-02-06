<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProductImage extends FormRequest
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
        $rules = [
            'paths' => 'required',
            'paths.*' => 'image|mimes:jpeg,png,jpg|max:4098',
        ];
        return $rules;
    }

    public function messages(){
        $messages = [
            'required' => ':attribute không được để trống',
            'paths.*.image' => ':attribute phải là một ảnh',
            'paths.*.mimes' => ':attribute phải có định dạng (jpeg , png hoặc jpg )',
            'paths.*.max' => ':attribute không được vượt quá 4MB',
        ];
        return $messages;
    }

    public function attributes(){
        $attributes=[
            'paths' => 'abc',
            'paths.*' => 'Ảnh mô tả',
        ];
        return $attributes;
    }
}
