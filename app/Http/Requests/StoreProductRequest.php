<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required||string|max:255|unique:products',
            'price' => 'required|numeric|min:0',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Ürün Adı alanı boş bırakılamaz.',
            'name.max' => 'Ürün Adı en fazla :max karakter olmalıdır.',
            'price.required' => 'Fiyat alanı boş bırakılamaz.',
            'price.numeric' => 'Fiyat alanı sayı olmalıdır.',
        ];
    }
}
