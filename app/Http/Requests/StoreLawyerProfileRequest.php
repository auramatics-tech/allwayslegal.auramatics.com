<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreLawyerProfileRequest extends FormRequest
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
            'first_name' => 'required|max:225',
            'last_name' => 'required|max:225',
            'phone' => 'required|min:10|max:15',
            'gender' => 'required',
            'country' => 'required|max:225',
            'address' => 'required|max:225',
            'city' => 'sometimes|max:225', 
            'law_firm_name' => 'required|max:225',
            'law_firm_reg_no' => 'required|max:225',    
            'story' => 'required|min:250'
        ];
    }
}
