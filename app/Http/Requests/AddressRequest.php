<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'address.country' => 'required|string',
            'address.city' => 'required|string',
            'address.street' => 'required|string',
            'address.zipcode' => 'required|string|',
            'addressPhone' => 'nullable|string',
            'addressIdentifier' => 'required|string'
        ];
    }

    public function messages(){
        return [
            'address.country.required' => 'The country is required.',
            'address.city.required' => 'The city is required.',
            'address.street.required' => 'The street is required.',
            'address.zipcode.required' => 'The zipcode is required.',
        ];
    }
}
