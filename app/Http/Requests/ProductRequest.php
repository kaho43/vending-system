<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 認証が必要なら変更
    }

    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'price.min' => '価格は0以上である必要があります。',
            'stock.min' => '在庫数は0以上である必要があります。',
            'comment.string' => 'コメントは文字列で入力してください。',
            'comment.max' => 'コメントは255文字以内で入力してください。',
            'image.image' => 'アップロードするファイルは画像である必要があります。',
            'image.max' => '画像サイズは2MB以内にしてください。',
        ];
    }
}
