<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSettingUser extends FormRequest
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
        $rules=[
            'name'=>'required|min:3|max:100',
            'avatar' => 'bail|image|mimes:jpeg,png,jpg|max:2048',
            'address'=>'required|min:5|max:255',
            'phone'=>'required|numeric|min:10',
        ];
        return $rules;
    }
    public function attributes(){
        $attributes=[
            'name'=>'Tên người dùng',
            'avatar' => 'Ảnh đại diện',
            'address'=>'Địa chỉ',
            'phone'=>'Số điện thoại',
        ];
        return $attributes;
    }
    public function messages(){
        $messages=[
            'required'=>':attribute không được để trống',
            'image' => ':attribute phải là một ảnh',
            'image.max' => ':attribute không được vượt quá 2MB',
            'mimes' => ":attribute phải có định dạng (jpeg , png hoặc jpg )",
            'min'=>':attribute không được nhỏ hơn :min kí tự',
            'max'=>':attribute không được quá :max kí tự',
            'numeric'=>':attribute phải là số'
        ];
        return $messages;
    }
}
