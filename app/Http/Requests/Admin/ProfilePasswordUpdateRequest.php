<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePasswordUpdateRequest extends FormRequest
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
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed']
        ];
    }

    public function messages(): array
    {
        return [
           'current_password.current_password' => 'Mevcut şifre geçersiz',
           'password.confirmed' => 'Şifre alanı onayı eşleşmiyor',
           'password.min' => 'Şifre alanı en az 8 karakter olmalıdır.',
        ];
    }
}
