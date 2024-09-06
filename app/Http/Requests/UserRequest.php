<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $uniqueEmail = 'unique:users';
        if(session('id')){
            $id = session('id');
            $uniqueEmail = 'unique:users,email,'.$id;
        }
        return [
            'name' => 'required|min:3',
            'password' => 'required|min:3',
            'email' => 'required|email|'.$uniqueEmail,
            'group' => ['required', function($atributes,$value,$fail) {
                if($value == 0){
                    $fail('Bắt buộc phải chọn nhóm');
                }
            }],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được bỏ trống trường tên',
            'password.required' => 'Không được bỏ trống trường mật khẩu',
            'name.min' => 'Nhập lớn hơn 3 ký tự nha',
            'password.min' => 'Nhập lớn hơn 3 ký tự nha',
            'email.required' => 'Không được bỏ trống trường mail',
            'email.email' => 'Không đúng định dạng',
            'email.unique' => 'Email đã tồn tại ',
            'group.required' => 'Không được bỏ trống nhóm',
        ];
    }
}
