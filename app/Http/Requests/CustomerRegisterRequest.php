<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest
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
        return [
            'cusemail' => 'required|email',
            'cuspassword' => 'required|min:6|max:255',
            'cusname' => 'required|min:6|max:255',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Phải là định dạng email',
            'password.required' => 'Mật khẩu không được để trống',
            'cusemail.required' => 'Email không được để trống',
            'cusemail.email' => 'Phải là định dạng email',
            'cuspassword.required' => 'Mật khẩu không được để trống',
            'cusname.required' => 'Tên người dùng không được để trống',
            'cusname.max' => 'Tên người dùng chỉ được tối đa 200 ký tự',
            'cusname.min' => 'Tên người dùng chỉ được tối thiểu 6 ký tự',
        ];
    }
}
