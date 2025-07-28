<?php

namespace App\Http\Requests\Divisions;

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
            'level0_full' => ['required', 'string', 'min:10', 'max:255'],
            'level0_short' => ['nullable', 'string', 'min:10', 'max:255'],
            'level1_full' => ['required', 'string', 'min:10', 'max:255'],
            'level1_short' => ['nullable', 'string', 'min:10', 'max:255'],
            'level2_full' => ['nullable', 'string', 'min:10', 'max:255'],
            'level2_short' => ['nullable', 'string', 'min:10', 'max:255'],
            'level3_full' => ['nullable', 'string', 'min:10', 'max:255'],
            'level3_short' => ['nullable', 'string', 'min:10', 'max:255'],
            'level4_full' => ['nullable', 'string', 'min:10', 'max:255'],
            'level4_short' => ['nullable', 'string', 'min:10', 'max:255'],
            'level5_full' => ['nullable', 'string', 'min:10', 'max:255'],
            'level5_short' => ['nullable', 'string', 'min:10', 'max:255'],
            'description' => ['nullable', 'string', 'min:3', 'max:255']
        ];
    }

    public function attributes(): array
    {
        return [
            'level0_full' => 'Организация, полное наименование',
            'level0_short' => 'Организация, краткое наименование',
            'level1_full' => 'Подразделение, полное наименование',
            'level1_short' => 'Подразделение, краткое наименование',
            'level2_full' => 'Отдел, полное наименование',
            'level2_short' => 'Отдел, краткое наименование',
            'level3_full' => 'Отделение, полное наименование',
            'level3_short' => 'Отделение, краткое наименование',
            'level4_full' => '',
            'level4_short' => '',
            'level5_full' => '',
            'level5_short' => '',
            'description' => 'Описание'
        ];
    }
}
