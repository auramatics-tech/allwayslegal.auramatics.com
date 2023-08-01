<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'name' => 'required|max:225',
            'title' => 'required|min:3|max:225',
            'price' => 'required|max:11',
            'service_fee' => 'sometimes|max:11',
            'service_fee_tax' => 'sometimes|max:11',
            'legal_fee' => 'sometimes|max:11',
            'legal_fee_tax' => 'sometimes|max:11',
            'legal_fee_tax' => 'sometimes|max:11'
        ];
    }
}
