<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route('user');

        return [
            /*Campos comuns entre clientes e admins*/
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email' . ($id ? ',' . $id : ''),
            'nif' => 'nullable|unique:users,nif' . ($id ? ',' . $id : ''),
            'password' => $id ? 'nullable|min:8' : 'required|min:8|confirmed',
            'birthdate' => 'nullable|date|before:18 years ago',
            'nationality' => 'required',
            'language' => 'required',
            'standard_group' => 'nullable|integer',
            'children' => 'nullable|integer',
            'phone' => 'nullable|min:9|unique:users,phone' . ($id ? ',' . $id : ''),
            'role' => 'nullable|exists:roles,id',
            'img' => 'nullable|image|max:2048',
            'balance' => 'nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            // Name validation messages
            'firstname.required' => 'The firstname field is required.',
            'lastname.required' => 'The lastname field is required.',

            // Email validation messages
            'email.required' => 'The email field is required.',
            'email.unique' => 'The email already exists.',

            // Password validation messages
            'password.required' => 'The password field is required.',
            'password.confirmed' => 'The passwords does not match.',
            'password.min' => 'The password must be at least 8 characters.',

            // Image validation messages
            'img.image' => 'The image must be a valid image file.',
            'img.max' => 'The image size may not exceed 2MB.',

            //Birtdate validation messages
            'birthdate.date' => 'The birthdate must be a date.',
            'birthdate.before' => 'The birthdate must be before 18 years ago.',

            // Phone validation messages
            'phone.min' => 'The phone must be at least 9 characters.',
            'phone.unique' => 'The phone already exists.',

            // Balance validation messages
            'balance.numeric' => 'The balance must be a number.',
            'balance.min' => 'The balance must be at least 0.',

            // Nif validation messages
            'nif.unique' => 'The nif already exists.',

            // Nationality validation messages
            'nationality.required' => 'The nationality field is required.',

            // Language validation messages
            'languageSeeder.required' => 'The languageSeeder field is required.',

            // Standard Group validation messages
            'standard_group.integer' => 'The standard group must be an integer.',

            // Children nº validation messages
            'children.integer' => 'The children must be an integer.',
        ];
    }
}
