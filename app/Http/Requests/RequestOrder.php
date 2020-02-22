<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestOrder extends FormRequest
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
            'address'=>'required|min:10|max:100',
            'email'=>'required|email',
            'phone_number'=>'required|numeric|min:10',
        ];
        return $rules;
    }
    public function attributes(){
        $attributes=[
            'email'=>'Email liên hệ',
            'phone_number'=>'Số điện thoại',
            'address' => 'Địa chỉ',
        ];
        return $attributes;
    }
    public function messages(){
        $messages=[
            'required'=>':attribute không được để trống',
            'email' => ':attribute không đúng định dạng',
            'min'=>':attribute không được nhỏ hơn :min kí tự',
            'max'=>':attribute không được quá :max kí tự',
            'numeric'=>':attribute phải là số',
        ];
        return $messages;
    }
}
