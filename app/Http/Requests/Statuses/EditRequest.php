<?php

namespace App\Http\Requests\Statuses;

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
            'letter'  => ['required', 'string', 'size:1', 'unique:statuses,letter'],
            'description' => ['nullable', 'string', 'min:3', 'max:255']
        ];
    }

    public function attributes(): array
    {
        return [
            'letter' => 'Буква сокращения',
            'description' => 'Описание обозначения'
        ];
    }
}
