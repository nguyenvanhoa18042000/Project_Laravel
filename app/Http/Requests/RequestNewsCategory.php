<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestNewsCategory extends FormRequest
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
            'name' => 'bail|required|min:5|max:100|unique:news_categories,name,'.$this->id,
            'description' => 'bail|required|'
        ];
        return $rules;
    }

    public function messages(){
        $messages = [
            'required' => ':attribute không được để trống',
            'min' => ':attribute Không được nhỏ hơn :min kí tự',
            'max' => ':attribute Không được lớn hơn :max kí tự'
            // 'unique' => 'Tên danh mục đã tồn tại',
        ];
        return $messages;
    }

    public function attributes(){
        $attributes=[
            'name' => 'Tên danh mục',
            'description' => 'Mô tả danh mục',
        ];
        return $attributes;
    }
}
