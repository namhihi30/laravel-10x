<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRequest extends FormRequest
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
        $id = $this->route()->id;

        $rules = [
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|max:255|unique:staff',
            'tel' => [
                'required',
                'regex:/^\d{1,4}-\d{1,4}-\d{1,4}$/',
                'max:14'
            ],

        ];

        if ($id) {
            $rules['email'] = 'required|email|unique:staff,email,' . $id;
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'min' => ':attribute phải có ít nhất :min ký tự.',
            'max' => ':attribute không được vượt quá :max ký tự.',
            'email' => ':attribute không đúng định dạng email.',
            'unique' => ':attribute đã tồn tại trong hệ thống.',
            'integer' => ':attribute phải là số nguyên.',
            'regex' => ':attribute chưa đúng format xxxx-xxxx-xxxx',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => "Tên nhân viên",
            'email' => "Email nhân viên",
            'tel' => "Số điện thoại",
        ];
    }
}
