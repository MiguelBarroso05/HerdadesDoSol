<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstateRequest extends FormRequest
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
        $id = null;
        if ($this->routeIs('estates.update')) {

            $id = $this->route('estate')->id;
        }

        return [
            'name' => 'required|unique:estates,name'. ($id ? ',' . $id : ''),
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'country' => 'required|string',
            'city' => 'required|string',
            'street' => 'required|string',
            'zipcode' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name is required.',
            'name.unique' => 'The name has already been taken.',
            'img.image' => 'The image must be an image.',
            'img.mimes' => 'The image must be of type: jpeg, jpg, png.',
            'country.required' => 'The country is required.',
            'city.required' => 'The city is required.',
            'street.required' => 'The street is required.',
            'zipcode.required' => 'The zipcode is required.',
        ];
    }
}
