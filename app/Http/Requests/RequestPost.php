<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPost extends FormRequest
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
                'title' => 'bail|required|min:5|max:255|unique:posts,title,'.$this->id,
                // 'slug' => 'bail|alpha_dash',
                'news_category_id' => 'bail|required',
                'description' => 'bail|required',
                'image' => 'bail|image|required|mimes:jpeg,png,jpg|max:2048',
                'background_img_title' => 'bail|image|mimes:jpeg,png,jpg|max:2048',
                'content' => 'bail|required',
            ];
            break;
            }
            case 'PUT':
            case 'PATCH':
            {
             $rules = [
                'title' => 'bail|required|min:5|max:255|unique:posts,title,'.$this->id,
                // 'slug' => 'bail|alpha_dash',
                'news_category_id' => 'bail|required',
                'description' => 'bail|required',
                'image' => 'bail|image|mimes:jpeg,png,jpg|max:2048',
                'background_img_title' => 'bail|image|mimes:jpeg,png,jpg|max:2048',
                'content' => 'bail|required',
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
        // 'alpha_dash' => ':attribute không được có space',
        'unique'=> ':attribute đã tồn tại',
        'image' => ':attribute phải là một ảnh',
        'required' => ':attribute không được để trống', 
        'image.max' => ':attribute không được vượt quá 2MB',
        'mimes' => ":attribute phải có định dạng (jpeg , png hoặc jpg )",
        'min' => ':attribute Không được nhỏ hơn :min kí tự',
        'max' => ':attribute Không được lớn hơn :max kí tự'
    ];
    return $messages;
}

public function attributes(){
    $attributes=[
        'title' => 'Tiêu đề bài viết',
        'slug' => 'Slug',
        'description' => 'Mô tả bài viết',
        'news_category_id' => 'Danh mục bài viết',
        'image' => 'Ảnh bài viết',
        'background_img_title' => 'Ảnh nền tiêu đề',
        'content' =>'Nội dung bài viết'
    ];
    return $attributes;
}
}
