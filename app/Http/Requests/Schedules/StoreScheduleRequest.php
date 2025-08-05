<?php

namespace App\Http\Requests\Schedules;

use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleRequest extends FormRequest
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
            'schedules' => ['required', 'array', 'min:1'],
            'schedules.*.employee_id' => ['required', 'integer', 'gt:0'],
            'schedules.*.status_id' => ['required', 'integer', 'gte:0'],
            'schedules.*.date' => ['required', 'string', 'date_format:Y-n-j'],
        ];
    }
}
