<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

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
    public function rules(){
        $rules = [];
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
            break;
            }
            case 'POST':
            {
            $rules = [
                'name' => 'bail|required|min:5|max:255|unique:products,name,'.$this->id,
                'slug' => 'bail|unique:products,slug,'.$this->id,
                'category_id' => 'bail|required',
                'trademark_id' => 'bail|required',
                'description' => 'bail|required',
                'amount' => 'bail|required|numeric|min:0',
                'image' => 'bail|image|required|mimes:jpeg,png,jpg|max:2048',
                'images.*' => 'bail|image|mimes:jpeg,png,jpg|max:10485760',
                'origin_price' => 'bail|required|numeric',
                'sale_price' => 'bail|required|numeric',
                'content' => 'bail|required|min:100',
            ];
            break;
            }
            case 'PUT':
            case 'PATCH':
            {
             $rules = [
                'name' => 'bail|required|min:5|max:255|unique:products,name,'.$this->id,
                'category_id' => 'bail|required',
                'slug' => 'bail|unique:products,slug,'.$this->id,
                'description' => 'bail|required',
                'amount' => 'bail|required|numeric|min:0',
                'image' => 'bail|image|mimes:jpeg,png,jpg|max:2048',
                'images.*' => 'bail|image|mimes:jpeg,png,jpg|max:10485760',
                'origin_price' => 'bail|required|numeric',
                'sale_price' => 'bail|required|numeric',
                'content' => 'bail|required|min:100',
            ];
            break;
        }
        default:break;
        }
        return $rules;
    }

public function messages(){
    $messages = [
        'required' => ':attribute không được để trống',
        'alpha_dash' => ':attribute không được có ',
        'unique'=> ':attribute đã tồn tại',
        'numeric' => ':attribute phải là số',
        'image' => ':attribute phải là một ảnh',
        'images.*.mimes' => ':attribute phải có định dạng (jpeg , png hoặc jpg )',
        'required' => ':attribute không được để trống', 
        'images.*.max' => ':attribute không được vượt quá 10MB',
        'image.max' => ':attribute không được vượt quá 2MB',
        'amount.min' => ':attribute không được nhỏ hơn :min',
        'mimes' => ":attribute phải có định dạng (jpeg , png hoặc jpg )",
        'min' => ':attribute Không được nhỏ hơn :min kí tự',
        'max' => ':attribute Không được lớn hơn :max kí tự'
    ];
    return $messages;
}

public function attributes(){
    $attributes=[
        'name' => 'Tên sản phẩm',
        'slug' => 'Slug',
        'description' => 'Mô tả sản phẩm',
        'category_id' => 'Loại sản phẩm',
        'trademark_id' => 'Thương hiệu sản phẩm',
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
