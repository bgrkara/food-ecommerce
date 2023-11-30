<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'unique:categories,name'],
            'slug' => ['nullable', 'max:255', 'unique:categories,slug'],
            'show_at_home' => ['required','boolean'],
            'status' => ['required', 'boolean']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Lütfen Kategori Adı Giriniz',
            'name.unique' => 'Girdiğiniz Kategori Adı Kayıtlı Lüfren Farklı Bir Kategori Adı Giriniz'
        ];
    }
}
