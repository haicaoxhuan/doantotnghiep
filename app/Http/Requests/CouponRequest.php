<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'name' => 'required|max:255|min:6',
            'code' => 'required|max:255|min:6',
            'value' => 'required|alpha_num|between:0,100',
            'start' => 'required|date_format:d/m/Y H:i',
            'end' => 'required|date_format:d/m/Y H:i',
            'qty' => 'required|alpha_num',
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
            'name.required' => 'Tên mã giảm giá không được để trống',
            'name.max' => 'Tên mã giảm giá tối đa 200 ký tự',
            'name.min' => 'Tên mã giảm giá tối thiểu 6 ký tự',
            'code.required' => 'Mã giảm giá không được để trống',
            'code.max' => 'Mã giảm giá tối đa 200 ký tự',
            'code.min' => 'Mã giảm giá tối thiểu 6 ký tự',
            'value.required' => 'Giá trị không được để trống',
            'value.alpha_num' => 'Giá trị phải là số',
            'value.betwen' => 'Giá trị từ 0 đến 100',
            'qty.required' => 'Giá trị không được để trống',
            'qty.alpha_num' => 'Giá trị phải là số',
            'start.required' => 'Ngày bắt đầu không được để trống',
            'end.required' => 'Ngày kết thúc không được để trống',
        ];
    }
}
