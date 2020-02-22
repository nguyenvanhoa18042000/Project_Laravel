<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCategory extends FormRequest
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
            'name' => 'bail|required|min:5|max:100|unique:categories,name,'.$this->id,
            'slug' =>'bail|unique:categories,slug,'.$this->id,
            'image' => 'bail|image|mimes:png|max:1000',
            'description' => 'bail|required|'
        ];
        return $rules;
    }

    public function messages(){
        $messages = [
            'required' => ':attribute không được để trống',
            'min' => ':attribute Không được nhỏ hơn :min kí tự',
            'max' => ':attribute Không được lớn hơn :max kí tự',
            'unique' => ':attribute đã tồn tại',
            'image' => ':attribute phải là ảnh',
            'image.max' => ':attribute không được vượt quá 1MB',
            'mimes' => 'attribute phải có định dạng png',
        ];
        return $messages;
    }

    public function attributes(){
        $attributes=[
            'name' => 'Tên danh mục',
            'slug' => 'Slug',
            'description' => 'Mô tả danh mục',
            'image' => 'Ảnh nhỏ danh mục',
        ];
        return $attributes;
    }

}
