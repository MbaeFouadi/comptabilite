<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateFormCategorytRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'design' => 'required|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'design.required' => 'Le champ design est obligatoire.',
            'design.min' => 'Le champ design doit contenir au moins 3 caratères.',
        ];
    }
}
