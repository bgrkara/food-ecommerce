<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryAreaCreateRequest extends FormRequest
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
            'area_name' => ['required', 'max:255'],
            'min_delivery_time' => ['required', 'max:255', 'numeric'],
            'max_delivery_time' => ['required', 'max:255', 'numeric'],
            'delivery_fee' => ['required', 'numeric'],
            'status' => ['required', 'boolean'],
        ];
    }

    public function messages() : array
    {
        return [
            'area_name.required' =>  'Lütfen Teslimat Adresi Adı Giriniz',
            'min_delivery_time.required' => 'Lütfen Minimum Teslimat Adresi Dakikası Giriniz',
            'max_delivery_time.required' => 'Lütfen Maksimum Teslimat Adresi Dakikası Giriniz',
            'delivery_fee.required' => 'Lütfen Teslimat Ücreti Giriniz',
            'area_name.max' => 'Teslimat Adresi Adı Max 255 Karakter Olmalıdır',
            'min_delivery_time.max' => 'Minimum Teslimat Adresi Max 255 Karakter Olmalıdır',
            'max_delivery_time.max' => 'Maksimum Teslimat Adresi Max 255 Karakter Olmalıdır',
        ];
    }

}
