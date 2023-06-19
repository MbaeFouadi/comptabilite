<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class affecteTypeDepenseRequest extends FormRequest
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
            'type_depense_id' => 'required',
            'composante_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'composante_id.required' => 'Veuillez selectionner composantes.',
            'type_depense_id.required' => 'Veuillez  selectionner type des recettes.',
        ];
    }
}
