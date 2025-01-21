<?php

namespace App\Http\Requests\accommodation;

use Illuminate\Foundation\Http\FormRequest;

class AccommodationRequest extends FormRequest
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
            'size' => 'required|integer|min:1|max:6',
            'accommodation_type_id' => 'required',
            'description' => 'nullable|max:255',
        ];
    }

    public function messages()
    {
        return [
            'size.required' => 'The size is required.',
            'size.integer' => 'The size must be an integer.',
            'size.min' => 'The size must be at least 1.',
            'size.max' => 'The size must be less than 6.',

            'accommodation_type_id.required' => 'The accommodation type is required.',

            'description.max' => 'The description may not be greater than 255 characters.',
        ];
    }
}
