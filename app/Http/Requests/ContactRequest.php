<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        $contactId = $this->route('contact')?->id;

        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('contacts')->ignore($contactId)],
            'phone' => ['required', 'string', 'regex:/^\(\d{2}\) \d{5}-\d{4}$/'],
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'O formato do telefone é inválido. Use (XX) XXXXX-XXXX.',
        ];
    }
}