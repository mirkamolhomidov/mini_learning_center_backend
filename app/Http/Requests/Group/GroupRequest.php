<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
        /** @var \Illuminate\Http\Request $this */
        $method = $this->method();

        if($method == 'POST')
        {
            return [
                'title' => 'required|string|max:50',
                'subject_id' => 'required|integer',
                'students' => 'required|integer|min:10',
                'status' => 'required|string|max:8',
                'start_date' => 'required|date',
            ];
        }elseif(in_array($method, ['PUT', 'PATCH']))
        {
            return [
                'title' => 'sometimes|string|max:50',
                'subject_id' => 'sometimes|integer',
                'students' => 'sometimes|integer|min:10',
                'status' => 'sometimes|string|max:8',
                'start_date' => 'sometimes|date',
            ];
        };
        return [];
    }
}
