<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'register_address_name' => ['required', 'string', 'max:150'],
            'register_address_first_name' => ['required', 'string', 'max:255'],
            'register_address_last_name' => ['required', 'string', 'max:255'],
            'register_address_number' => ['required', 'integer'],
            'register_address_street' => ['required', 'string', 'max:255'],
            'register_address_floor' => ['nullable', 'string', 'max:255'],
            'register_address_city' => ['required', 'string', 'max:150'],
            'register_address_zip' => ['required', 'string', 'max:10'],
            'register_address_phone' => ['required', 'string', 'max:30'],
            'register_address_country' => ['required', 'string', 'max:50'],
            'register_address_other' => ['nullable', 'string', 'max:255'],
        ];
    }
}
