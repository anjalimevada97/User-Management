<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                Rule::unique('users'),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'status' => [
                'required',
                'in:Active,Disabled',
            ],
        ];

        if ($this->getMethod() == 'PUT') {
            $rules['email'] = [
                'nullable',
                'email',
                Rule::unique('users')->ignore($this->route('user')?->id),
            ];

            $rules['password'] = [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ];
        }

        return $rules;
    }
}
