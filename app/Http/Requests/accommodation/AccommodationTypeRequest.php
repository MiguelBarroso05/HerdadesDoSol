<?php

namespace App\Http\Requests\accommodation;

use Illuminate\Foundation\Http\FormRequest;

class AccommodationTypeRequest extends FormRequest
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
            'name' => 'required',
            'img' => 'nullable|image|max:2048'
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'The room type name is required.',
            'img.image' => 'The image must be an image.',
        ];
    }
}
