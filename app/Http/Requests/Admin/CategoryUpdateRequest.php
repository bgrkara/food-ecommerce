<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'unique:categories,name,'.$this->category],
            'slug' => ['nullable', 'max:255', 'unique:categories,slug,'.$this->category],
            'show_at_home' => ['required','boolean'],
            'status' => ['required', 'boolean']
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'name.required' => 'Lütfen Kategori Adı Giriniz',
            'name.unique' => 'Girdiğiniz Kategori Adı Kayıtlı Lüfren Farklı Bir Kategori Adı Giriniz'
        ];
    }
}
