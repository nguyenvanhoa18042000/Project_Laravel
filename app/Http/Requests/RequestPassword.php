<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPassword extends FormRequest
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
            'password_old'=>'required|min:8|max:32',
            'password'=>'required|min:8|max:32',
            'password_confirmation' => 'required|same:password',
        ];
        return $rules;
    }
    public function attributes(){
        $attributes=[
            'password_old' => 'Mật khẩu cũ',
            'password'=>'Mật khẩu mới',
            'password_confirmation' => 'Mật khẩu xác nhận',
        ];
        return $attributes;
    }
    public function messages(){
        $messages=[
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn :min kí tự',
            'max' => ':attribute không được quá :max kí tự',
            'password_confirmation.same' => ':attribute không chính xác',
        ];
        return $messages;
    }
}
