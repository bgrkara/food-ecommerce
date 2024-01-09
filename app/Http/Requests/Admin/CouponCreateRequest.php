<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponCreateRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'code' => ['required', 'max:50'],
            'quantity' => ['required', 'integer'],
            'min_purchase_amount' => ['required', 'integer'],
            'expire_date' => ['required', 'date'],
            'discount_type' => ['required'],
            'discount' => ['required'],
            'status' => ['required', 'boolean'],
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' =>  'Lütfen Kupon Adı Giriniz',
            'code.required' => 'Lütfen Kupon Kodunu Giriniz',
            'code.max' => 'Kupon Kodu Max 50 Karakter Olmalıdır',
            'quantity.required' => 'Lütfen Kupon Miktarını Giriniz',
            'min_purchase_amount.required' => 'Lütfen Minimum Satın Alma Fiyatı Giriniz',
            'expire_date.required' => 'Lürfen Sona Erme Tarihini Giriniz',
            'discount_type.required' => 'Lütfen İndirim Türünü Seçiniz',
            'discount.required' => 'Lütfen İndirim Fiyatı (Oranı) Ekleyiniz',
            'status.required' => 'Lütfen Kupon Durumunu Seçiniz',

        ];
    }
}
