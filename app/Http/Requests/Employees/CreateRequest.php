<?php

namespace App\Http\Requests\Employees;

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
            'division_id' => ['required', 'integer', 'exists:divisions,id'],
            'first_name'  => ['required', 'string', 'min:10', 'max:255'],
            'last_name'  => ['required', 'string', 'min:10', 'max:255'],
            'middle_name'  => ['required', 'string', 'min:10', 'max:255'],
            'email' => ['nullable', 'email', 'min:5', 'max:128'],
            'phone'  => ['nullable', 'numeric', 'digits:10'],
            'address'  => ['required', 'string', 'min:11', 'max:256'],
        ];
    }

    public function attributes(): array
    {
        return [
            'division_id' => 'Идентификатор подразделения',
            'first_name'  => 'Имя',
            'last_name'  => 'Фамилия',
            'middle_name'  => 'Отчество',
            'email' => 'Электронная почта',
            'phone'  => 'Телефон',
            'address'  => 'Адрес кабинета'
        ];
    }
}
