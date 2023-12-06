<?php

namespace App\Http\Requests\Admin;

use http\Message;
use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:255'],
            'slug' => ['nullable', 'max:255'],
            'sku' => ['nullable', 'max:255', 'min:8', 'unique:products,sku'],
            'category' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'offer_price' => ['nullable', 'numeric'],
            'short_description' => ['required', 'max:500'],
            'long_description' => ['nullable'],
            'seo_title' => ['nullable', 'max:255'],
            'seo_description' => ['nullable', 'max:255'],
            'show_at_home' => ['boolean'],
            'status' => ['required', 'boolean'],
        ];
    }

    public function messages() : array
    {
        return [
            'image.required' => 'Lütfen Bir Ürün Fotoğrafı Ekleyiniz',
            'name.required' =>  'Lütfen Ürün Adını Giriniz',
            'price.required' => 'Lütfen Fiyat Giriniz',
            'short_description.required' => 'Lütfen Kısa Ürün Açıklaması Giriniz',
            'sku.min' => 'SKU Alanı En Az 8 Karakter Olmalıdır. Boş Bırakırsanız Otomatik Oluşturulacaktır!',
            'sku.unique' => 'Seçilen Stok Kodu Mevcut Farklı Bir SKU No Giriniz',

        ];
    }
}
