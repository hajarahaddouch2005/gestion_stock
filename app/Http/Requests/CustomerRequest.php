<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
    public function rules(): array{
        $customerId = $this->route('id');
        return [
            'first_name' => 'required|min:3|max:255',
            'last_name' => 'required|min:3|max:255',
            'address' => 'required|min:10|max:255',
            'email' => ['required','max:255','regex:/^([a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/',Rule::unique('customers')->ignore($customerId)],
            'phone' => ['required'], //'min:10','max:10','regex:/^(06|07)[0-9]{8}$/'
        ];
    }


    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required',
            'first_name.min' => 'First name is too short (min 3 characters)',
            'first_name.max' => 'First name is too long',

            'last_name.required' => 'Last name is required',
            'last_name.min' => 'Last name is too short (min 3 characters)',
            'last_name.max' => 'Last name is too long',

            'email.required'=>'Email is required',
            'email.unique' => 'Email is already exist',
            'email.max' => 'Email is too long',
            'email.regex'=>'Email is invalid',

            'address.required' => 'Address is required',
            'address.min' => 'Address is too short (min 10 characters)',
            'address.max' => 'Address is too long',

            'phone.required'=>'Phone is required',
            // 'phone.min' => 'Phone is too short',
            // 'phone.max' => 'Phone is too long',
            // 'phone.regex'=>'Phone is invalid'
        ];
    }
}
