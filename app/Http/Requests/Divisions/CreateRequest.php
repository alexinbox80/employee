<?php

namespace App\Http\Requests\Divisions;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'level0'  => ['required', 'string', 'min:10', 'max:255'],
            'level1'  => ['required', 'string', 'min:10', 'max:255'],
            'level2'  => ['nullable', 'string', 'min:10', 'max:255'],
            'level3'  => ['nullable', 'string', 'min:10', 'max:255'],
            'level4'  => ['nullable', 'string', 'min:10', 'max:255'],
            'level5'  => ['nullable', 'string', 'min:10', 'max:255'],
            'position'  => ['required', 'string', 'min:10', 'max:255'],
            'description' => ['nullable', 'string', 'min:3', 'max:255']
        ];
    }

    public function attributes(): array
    {
        return [
            'level0'  => 'Организация',
            'level1'  => 'Подразделение',
            'level2'  => 'Отдел',
            'level3'  => 'Отделение',
            'level4'  => '',
            'level5'  => '',
            'position'  => 'Должность',
            'description' => 'Описание'
        ];
    }
}
