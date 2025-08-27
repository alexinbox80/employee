<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            //'division_id' => ['required', 'integer', 'exists:divisions,id'],
            //'department_id' => ['required', 'integer', 'exists:divisions,id'],
            //'is_shown' => ['required', 'boolean', Rule::in(['0', '1', 0, 1 , 'true', 'false', true, false])],
            'first_name'  => ['required', 'string', 'min:4', 'max:255'],
            'last_name'  => ['required', 'string', 'min:4', 'max:255'],
            'middle_name'  => ['required', 'string', 'min:4', 'max:255'],
            'birth_date' => ['required', 'string', 'min:10', 'max:10'],
            'sex' => ['required', 'string', Rule::in(['МУЖСКОЙ', 'ЖЕНСКИЙ'])],
            'position'  => ['required', 'string', 'min:9', 'max:255'],
            'email' => ['nullable', 'email', 'min:5', 'max:128'],
            'home_phone'  => ['nullable', 'numeric', 'digits:6'],
            'work_phone'  => ['nullable', 'numeric', 'digits:6'],
            'mobile_phone'  => ['nullable', 'numeric', 'digits:10'],
            'address'  => ['required', 'string', 'min:11', 'max:256'],
            'room' => ['required', 'integer', 'min:1']
        ];
    }

    public function attributes(): array
    {
        return [
            'division_id' => 'Идентификатор подразделения',
            'first_name'  => 'Имя',
            'last_name'  => 'Фамилия',
            'middle_name'  => 'Отчество',
            'position'  => 'Должность',
            'email' => 'Электронная почта',
            'phone'  => 'Телефон',
            'address'  => 'Адрес кабинета'
        ];
    }
}
