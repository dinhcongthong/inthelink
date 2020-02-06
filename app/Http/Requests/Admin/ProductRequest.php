<?php

namespace App\Http\Requests\Admin;

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
            'name'                  => 'required|max:100',
            'seller_info'           => 'nullable|max:50',
            'main_image'            => 'nullable|mimes:png,jpeg,jpg,svg|max:6150',
            'images1'               => 'nullable|mimes:png,jpeg,jpg,svg|max:6150',
            'images2'               => 'nullable|mimes:png,jpeg,jpg,svg|max:6150',
            'images3'               => 'nullable|mimes:png,jpeg,jpg,svg|max:6150',
            'inthelink_commission'  => 'required|numeric|min:0|max:10',
            'price'                 => 'required|numeric|min:0|max:9999999999',
            'category_id'           => 'required|numeric',
            'sub_category'          => 'nullable|numeric',
            'child_sub_category'    => 'nullable|numeric',
            'weight'                => 'nullable|numeric|min:0|max:9999999999',
            'width'                 => 'nullable|numeric|min:0|max:9999999999',
            'height'                => 'nullable|numeric|min:0|max:9999999999',
            'length'                => 'nullable|numeric|min:0|max:9999999999',
            'description'           => 'required'
        ];
    }
}
