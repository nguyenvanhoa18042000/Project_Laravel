<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Trademark;

class RequestTrademark extends FormRequest
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
                'name' => 'bail|required|min:5|max:100|unique:trademarks,name,'.$this->id,
                'image' => 'bail|required|image|mimes:jpeg,png,jpg|max:2048',
            ];
            break;
            }
            case 'PUT':
            case 'PATCH':
            {
             $rules = [
                'name' => 'bail|required|min:5|max:100|unique:trademarks,name,'.$this->id,
                'image' => 'bail|image|mimes:jpeg,png,jpg|max:2048',
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
            'min' => ':attribute Không được nhỏ hơn :min kí tự',
            'max' => ':attribute Không được lớn hơn :max kí tự',
            'unique' => ':attribute đã tồn tại',
            'image' => ':attribute phải là một ảnh',
            'mimes' => ":attribute phải có định dạng (jpeg , png hoặc jpg )",
            'image.max' => ':attribute không được vượt quá 2MB',
        ];
        return $messages;
    }

    public function attributes(){
        $attributes = [
            'name' => 'Tên thương hiệu',
            'image' => 'Ảnh thương hiệu',
        ];
        return $attributes;
    }
}
