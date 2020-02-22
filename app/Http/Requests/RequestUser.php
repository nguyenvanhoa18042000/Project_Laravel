<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUser extends FormRequest
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
            'email'=>'required|email|unique:users,email,'.$this->id,
            'avatar' => 'bail|image|mimes:jpeg,png,jpg|max:2048',
            'password'=>'required|confirmed|min:8',
            'address'=>'required|min:5|max:255',
            'phone'=>'required|numeric|min:10',
        ];
        return $rules;
    }
    public function attributes(){
        $attributes=[
            'name'=>'Tên người dùng',
            'email'=>'Email',
            'avatar' => 'Ảnh đại diện',
            'password'=>'Mật khẩu',
            'address'=>'Địa chỉ',
            'phone'=>'Số điện thoại',
        ];
        return $attributes;
    }
    public function messages(){
        $messages=[
            'required'=>':attribute không được để trống',
            'email' => ':attribute không đúng định dạng',
            'image' => ':attribute phải là một ảnh',
            'image.max' => ':attribute không được vượt quá 2MB',
            'mimes' => ":attribute phải có định dạng (jpeg , png hoặc jpg )",
            'unique' => ':attribute đã tồn tại',
            'min'=>':attribute không được nhỏ hơn :min kí tự',
            'max'=>':attribute không được quá :max kí tự',
            'confirmed'=>':attribute nhập lại không chính xác',
            'numeric'=>':attribute phải là số'
        ];
        return $messages;
    }
}
