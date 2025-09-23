<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
                'full_name' => 'required|string|max:50',
                'score'     => 'required|integer',
            ];
        } elseif (in_array($method, ['PUT', 'PATCH'])) {
            return [
                'full_name' => 'sometimes|string|max:50',
                'score'     => 'sometimes|integer',
            ];
        }
        return [];
    }
}
