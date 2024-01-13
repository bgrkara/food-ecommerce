<?php

namespace App\Http\Requests\Frontend;

use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;

class AddressUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $addressId = $this->route('id');
        $address = Address::find($addressId);
        return  $address && $address->user_id === auth()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'area' => ['required', 'integer'],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required'],
            'type' => ['required', 'in:home,office']
        ];
    }

    public function messages() : array
    {
        return [
            'area.required' =>  'Lütfen Bölge Seçiniz',
            'first_name.required' => 'Lütfen Adınızı Giriniz',
            'last_name.required' => 'Lütfen Soyadınızı Giriniz',
            'phone.required' => 'Lütfen Telefon Numaranızı Giriniz',
            'email.required' => 'Lütfen E-Posta Adresinizi Giriniz',
            'email.email' => 'Lütfen Geçerli Bir E-Posta Adresi Giriniz',
            'address.required' => 'Lütfen Adresinizi Giriniz',
            'type.required' => 'Lütfen Adres Türünüzü Seçiniz',
            'email.max' => 'E-Posta Adresiniz Max 255 Karakter Olmalıdır',
        ];
    }
}
