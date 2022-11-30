<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:200|min:6',
            'price' => 'required|alpha_num',
            'price_dc' => 'nullable|alpha_num',
            'qty' => 'required|alpha_num',
            'des' => 'required|max:5000|min:10',
            'sort_des' => 'required|max:255|min:10',
            'sku' => 'required|unique:products|regex:/^[a-z0-9A-Z ]+$/i|min:10|max:20',
            'brand_id' => 'required',
            'category' => 'required',
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
            'name.required' => 'Tên sản phẩm không được phép để trống',
            'name.max' => 'Tên danh mục chỉ được tối đa 200 ký tự',
            'name.min' => 'Tên danh mục chỉ được tối thiểu 6 ký tự',
            'price.required' => 'Giá sản phẩm không được phép để trống',
            'price.alpha_num' => 'Giá sản phẩm phải là số',
            'price_dc.alpha_num' => 'Giá đã giảm phải là số',
            'image.required' => 'Ảnh không được phép bỏ trống',
            'image.max' => 'Ảnh không quá 3MB',
            'image.mimes' => 'Ảnh phải có định dạng jpeg,jpg,png,gif',
            'qty.required' => 'Số lượng sản phẩm không được để trống',
            'qty.alpha_num' => 'Số lượng sản phẩm phải là số',
            'des.required' => 'Mô tả sản phẩm không được để trống',
            'des.max' => 'Mô tả sản phẩm tối đa 5000 ký tự',
            'des.min' => 'Mô tả sản phẩm tối thiểu 10 ký tự',
            'sort_des.required' => 'Mô tả ngắn sản phẩm không được để trống',
            'sort_des.max' => 'Mô tả ngắn sản phẩm tối đa 255 ký tự',
            'sort_des.min' => 'Mô tả ngắn sản phẩm tối thiểu 10 ký tự',
            'sku.required' => 'Mã vạch không được để trống',
            'sku.unique' => 'Mã vạch đã tồn tại',
            'sku.regex' => 'Mã vạch chỉ được là 0-9 hoặc a-z hoặc A-Z',
            'sku.min' => 'Mã vạch phải từ 10 kí tự',
            'sku.max' => 'Mã vạch không được quá 20 kí tự',
            'brand_id.required' => 'Vui lòng chọn thương hiệu',
            'category.required' => 'Vui lòng chọn danh mục',
        ];
    }
}
