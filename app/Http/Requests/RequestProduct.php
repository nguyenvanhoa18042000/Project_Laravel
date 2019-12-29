<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProduct extends FormRequest
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
            'name' => 'required|unique:products,name,'.$this->id,
            'category_id' => 'required',
            'description' => 'required',
            'origin_price' => 'required',
            'sale_price' => 'required',
            'content' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Trường này không được để trống',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'description.required' => 'Trường này không được để trống',
            'category_id.required' => 'Trường này không được để trống',
            'content.required' => 'Trường này không được để trống',
            'origin_price.required' => 'Trường này không được để trống',
            'sale_price.required' => 'Trường này không được để trống',
        ];
    }
}
