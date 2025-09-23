<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
                'title'    => 'required|string|max:50',
                'price'    => 'required|numeric|min:0',
                'duration' => 'required|integer|min:1',
            ];
        }

        if ($method === 'PUT' || $method === 'PATCH') {
            return [
                'title'    => 'sometimes|string|max:50',
                'price'    => 'sometimes|numeric|min:0',
                'duration' => 'sometimes|integer|min:1',
            ];
        }
        return [];
    }
}