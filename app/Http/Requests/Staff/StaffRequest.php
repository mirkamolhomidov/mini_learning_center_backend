<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
     */
    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $method = $this->method();

        if ($method === 'POST') {
            return [
                'full_name'    => 'required|string|max:50',
                'username'     => 'required|string|max:30',
                'password'     => 'required|string|min:50',
                'age'          => 'required|integer|min:16|max:100',
                'phone_number' => 'required|string|max:40',
            ];
        } elseif (in_array($method, ['PUT', 'PATCH'])) {
            return [
                'full_name' => 'sometimes|string|max:50',
                'username'  => 'sometimes|string|max:30',
                'password'  => 'sometimes|string|min:50',
                'age'       => 'sometimes|integer|min:16|max:100',
                'phone_number' => 'sometimes|string|max:40',
            ];
        }
        return [];
    }
}
