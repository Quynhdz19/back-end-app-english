<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Xác nhận người dùng có được phép thực hiện yêu cầu này hay không.
     */
    public function authorize(): bool
    {
        return true; // Cho phép mọi người dùng thực hiện yêu cầu
    }

    /**
     * Quy tắc xác thực cho form đăng ký.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email', // Ensure email is valid and unique
            'password' => 'required|string|min:6', // Set a minimum length for the password
        ];
    }

    /**
     * Thông báo lỗi tùy chỉnh.
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute là bắt buộc.',
            'email' => 'Định dạng email không hợp lệ.',
            'unique' => ':attribute này đã được sử dụng.',
            'max' => ':attribute không được vượt quá :max ký tự.',
            'min' => ':attribute phải có ít nhất :min ký tự.',
            'confirmed' => 'Xác nhận :attribute không khớp.',
        ];
    }


}
