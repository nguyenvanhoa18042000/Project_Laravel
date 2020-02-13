<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestTopic extends FormRequest
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
            'name' => 'bail|required|min:5|max:100|unique:topics,name,'.$this->id,
        ];
        return $rules;
    }

    public function messages(){
        $messages = [
            'required' => ':attribute không được để trống',
            'min' => ':attribute Không được nhỏ hơn :min kí tự',
            'max' => ':attribute Không được lớn hơn :max kí tự',
            'unique' => 'Tên chủ đề đã tồn tại',
        ];
        return $messages;
    }

    public function attributes(){
        $attributes=[
            'name' => 'Tên danh mục',
        ];
        return $attributes;
    }
}
