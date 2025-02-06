<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
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
            'identifier' => 'nullable|string|max:18',
            'name' => 'required|string|max:40',
            'number' => 'required|numeric|digits:16',
            'validity' => 'required|string|size:5',
        ];
    }

    public function messages(): array
    {
        return [
            'identifier.max' => 'The identifier is too long.',
            'name.required' => 'The name is required.',
            'name.max' => 'The name is too long.',
            'number.required' => 'The number is required.',
            'number.numeric' => 'The number must be a number.',
            'number.digits' => 'The number have to be 16 digits.',
            'validity.required' => 'The validity is required.',
        ];
    }
   
}
