<?php

namespace App\Http\Requests\activity;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:30',
            'description' => 'nullable|max:255',
            'img' => 'nullable|image|max:2048',
            'activity_type_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.min' => 'The name must be at least 3 characters.',
            'name.max' => 'The name may not be greater than 30 characters.',

            'description.max' => 'The description may not be greater than 255 characters.',

            'img.image' => 'The image must be an image.',
        ];
    }
}
