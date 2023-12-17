<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        
        
        return [
            'prenomutilisateur' => ['required', 'string', 'max:255'],
            'nomutilisateur' => ['required', 'string', 'max:255'],
            //'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'numtelephone' => ['required', 'numeric','digits:10'],
            'rue' => ['required', 'string', 'max:100'],
            'codepostaladresse' => ['required', 'numeric', 'digits:5'],
            'idcivilite' => ['required'],
            'datenaissance' => ['required']
        ];
    }
}
