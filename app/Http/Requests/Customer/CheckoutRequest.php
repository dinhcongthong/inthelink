<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'person_incharge' => 'required|max:90',
            'phone_incharge' => 'required|max:19',
            'delivery_addr' => 'required|max:300',
            'payment_method' => 'required',
            'total' => 'required|numeric|max:9999999999',
            'influencer_id' => 'required|numeric',
            'delivery_unit_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric|max:999999999',
        ];
    }
}
