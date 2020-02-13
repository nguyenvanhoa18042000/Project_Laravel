<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestContact extends FormRequest
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
            'name' => 'required|min:5|max:100',
            'title'=>'required|min:10|max:100',
            'content'=>'required|min:10',
            'email'=>'required|email',
            'phone'=>'required|numeric|min:10',
            'topic_id' => 'required',
        ];
        return $rules;
    }
    public function attributes(){
        $attributes=[
            'name'=>'Tên người dùng',
            'email'=>'Email',
            'title' => 'tiêu đề',
            'content'=>'Nội dung',
            'phone'=>'Số điện thoại',
            'topic_id' => 'Chủ đề',
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
