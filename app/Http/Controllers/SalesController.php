<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;

class SaleController extends Controller
{
    public function purchase(Request $request)
    {
        // 必要なバリデーションを行う
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($validated['product_id']);
        
        // 在庫チェック
        if ($product->stock < $validated['quantity']) {
            return response()->json(['error' => '在庫が足りません'], 400);
        }

        // 購入処理
        $sale = Sale::create([
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
        ]);

        // 在庫数を減らす
        $product->decrement('stock', $validated['quantity']);

        // レスポンス
        return response()->json(['message' => '購入処理が完了しました', 'sale' => $sale], 200);
    }
}
