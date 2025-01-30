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
            'number' => 'required|numeric|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/',
            'cvv' => 'required|numeric|size:3',
            'validity' => 'required|date',
        ];
    }
}
