<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingRequest extends FormRequest
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
            'personal-info' => [
                'name' => ['required', 'string', 'max:40'],
                'nif' => ['required', 'size:9'],
                'email' => ['required', 'email:rfc,dns', 'max:255'],
                'phone' => ['required', 'min:9'],
            ],
            'address-info' => [
                'country' => ['required', 'string'],
                'city' => ['required', 'string'],
                'street' => ['required', 'string'],
                'zipcode' => ['required', 'string'],
            ]
        ];
    }

    public function messages(): array
    {
        return [
            // Messages for personal-info
            'personal-info.name.required' => 'The name is required.',
            'personal-info.name.string' => 'The name must be a valid name.',
            'personal-info.name.max' => 'The name cannot exceed 40 characters.',

            'personal-info.nif.required' => 'The NIF is required.',
            'personal-info.nif.size' => 'The NIF must be 9 digits.',

            'personal-info.email.required' => 'The email is required.',
            'personal-info.email.email' => 'Please provide a valid email address.',
            'personal-info.email.max' => 'The email cannot exceed 255 characters.',

            'personal-info.phone.required' => 'The phone number is required.',
            'personal-info.phone.min' => 'The phone number must be at least 9 characters long.',

            // Messages for address-info
            'address-info.country.required' => 'The country is required.',
            'address-info.country.string' => 'The country must be a valid country.',

            'address-info.city.required' => 'The city is required.',
            'address-info.city.string' => 'The city must be a valid city.',

            'address-info.street.required' => 'The street is required.',
            'address-info.street.string' => 'The street must be a valid street.',

            'address-info.zipcode.required' => 'The zip code is required.',
            'address-info.zipcode.string' => 'The zip code must be a valid zipcode.',
        ];
    }

    public function rulesFor($section)
    {
        $rules = $this->rules();
        return $rules[$section] ?? [];
    }
}
