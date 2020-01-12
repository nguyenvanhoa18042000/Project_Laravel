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
        $rules = [
            'name' => 'bail|required|min:5|max:255|unique:products,name,'.$this->id,
            'category_id' => 'bail|required',
            'description' => 'bail|required',
            'amount' => 'bail|required|numeric|min:0',
            'image' => 'bail|required|mimes:jpeg,png,jpg|max:2048',
            'images.*' => 'bail|mimes:jpeg,png,jpg|max:10485760',
            'origin_price' => 'bail|required|numeric',
            'sale_price' => 'bail|required|numeric',
            'content' => 'bail|required',
        ];
        return $rules;
    }

    public function messages(){
        $messages = [
            'required' => ':attribute không được để trống',
            'unique'=> ':attribute đã tồn tại',
            'numeric' => ':attribute phải là số',
            'image' => ':attribute phải là một ảnh',
            'images.*.mimes' => ':attribute phải có định dạng (JPEG , PNG hoặc JPG )',
            'required' => ':attribute không được để trống', 
            'images.*.max' => ':attribute không được vượt quá 10MB',
            'image.max' => ':attribute không được vượt quá 2MB',
            'amount.min' => ':attribute không được nhỏ hơn :min',
            'mimes' => ":attribute phải có định dạng (JPEG , PNG hoặc JPG )",
            'min' => ':attribute Không được nhỏ hơn :min kí tự',
            'max' => ':attribute Không được lớn hơn :max kí tự'
        ];
        return $messages;
    }

    public function attributes(){
        $attributes=[
            'name' => 'Tên sản phẩm',
            'description' => 'Mô tả sản phẩm',
            'category_id' => 'Loại sản phẩm',
            'image' => 'Ảnh sản phẩm',
            'images.*' => 'Ảnh chi tiết sản phẩm',
            'amount' => 'Số lượng sản phẩm',
            'origin_price' => 'Giá gốc sản phẩm',
            'sale_price' => 'Giá bán sản phẩm',
            'amount' =>'Số lượng trong kho',
            'content' =>'Nội dung sản phẩm'
        ];
        return $attributes;
    }
}
