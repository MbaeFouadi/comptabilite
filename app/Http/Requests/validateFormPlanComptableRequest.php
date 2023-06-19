<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateFormPlanComptableRequest extends FormRequest
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
            'designation' => 'required',
            'numero' => 'required',
        ];
    }

    public function messages() : array
    {
        return [
            'designation.required' => 'Le champ designation est obligatoire.',
            'numero.required' => 'Le champ numéro doit est obligatoire.',
        ];
    }
}
