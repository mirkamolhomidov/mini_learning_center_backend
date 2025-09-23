<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
        /** @var Illuminate\Http\Request $this */
        $method = $this->method();
        if($method == 'POST')
        {
            return [ 
                'group_id' => 'required|integer',
                'weekday' => 'required|string|in:Mon,Tue,Wed,Thur,Fri,Sat,Sun',
                'start_time' => 'required|date_format:H:i:s',
                'end_time' => 'required|date_format:H:i:s',
            ];
        }elseif(in_array($method, ['PUT', 'PATCH']))
        {
            return [
                'group_id' => 'integer',
                'start_time' => 'date_format:H:i:s',
                'end_time' => 'date_format:H:i:s',
            ];
        };
        return [];
    }
}
