<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        // バリデーション
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // 商品の取得
        $product = Product::findOrFail($request->product_id);
    
        // 在庫数を減らす
        if ($product->stock < $request->quantity) {
            return response()->json(['message' => '在庫不足です。'], 400);
        }
    
        // 在庫を減らす処理
        $product->stock -= $request->quantity;
        $product->save();
    
        return response()->json(['message' => '購入処理が成功しました。'], 200);
    }
    

}