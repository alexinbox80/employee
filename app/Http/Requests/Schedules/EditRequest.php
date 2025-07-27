<?php

namespace App\Http\Requests\Schedules;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'status_id' => ['required', 'integer', 'exists:statuses,id'],
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'description' => ['nullable', 'string', 'min:3', 'max:255']
        ];
    }

    public function attributes(): array
    {
        return [
            'employee_id' => 'Идентификатор служащего',
            'status_id' => 'Идентификатор статуса',
            'date' => 'Дата ГГГГ-ММ-ДД',
            'description' => 'Описание'
        ];
    }
}
