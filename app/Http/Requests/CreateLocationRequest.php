<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createLocationRequest extends FormRequest
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
            'restaurant_name' => 'required',
            'address1' => 'required',
            'address2' => '',
            'town' => 'required',
            'postcode' => 'required|regex:/^[A-Z]{1,2}[0-9][0-9A-Z]?\s?[0-9][A-Z]{1,2}$/i',
        ];
    }
}
