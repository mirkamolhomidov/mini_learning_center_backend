<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'full_name'     => 'required|string|max:50',
            'username'      => 'required|string|unique:staffs,username',
            'password'      => 'required|string|min:6',
            'age'           => 'required|integer|min:18',
            'phone_number'  => 'required|string|max:50',
        ];
    }
}
