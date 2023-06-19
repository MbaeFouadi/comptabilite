<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateFormHologra extends FormRequest
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
            'composent_id' => 'required',
            'nombre' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'composent_id.required' => 'Veuillez sélectionner un composante',
            'nombre.required' => 'Le champ nombre est vide.',
        ];
    }
}
