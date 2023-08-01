<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreClientProfileRequest extends FormRequest
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
            'country' => 'required|max:225',
            'address' => 'sometimes|max:225',
            'city' => 'sometimes|max:225',
            'province' => 'sometimes|max:225',
            'postal' => 'sometimes|max:225',     
            'business' => 'sometimes|max:225',
            'position' => 'sometimes|max:225'       
                
        ];
    }
}
