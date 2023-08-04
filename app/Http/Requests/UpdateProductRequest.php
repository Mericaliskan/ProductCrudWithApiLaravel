<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required||string|max:255',
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
            'no_changes' => 'Hiçbir değişiklik yapılmadı, güncelleme işlemi iptal edildi.',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->isAnyFieldChanged()) {
                $validator->errors()->add('no_changes', __('No changes were made, the update process is canceled.'));
            }
        });
    }

    private function isAnyFieldChanged()
    {
        $product = $this->route('product');

        return $this->name !== $product->name || (float)$this->price !== (float)$product->price;
    }
}
