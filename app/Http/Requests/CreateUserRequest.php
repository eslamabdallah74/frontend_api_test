<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name'        => 'required|string|min:4|max:20',
            'last_name'         => 'required|string|min:4|max:20',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|min:4|max:20'
        ];
    }
}
