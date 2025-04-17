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
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        DB::beginTransaction();

        try {
            // 商品の在庫を取得
            $product = Product::findOrFail($productId);

            // 在庫数の確認
            if ($product->stock < $quantity) {
                return response()->json(['error' => '在庫が足りません'], 400);
            }

            // 在庫数の減算
            $product->stock -= $quantity;
            $product->save();

            // salesテーブルに購入記録を追加
            Sale::create([
                'product_id' => $productId,
            ]);

            DB::commit();
            return response()->json(['message' => '購入処理が成功しました']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => '購入処理に失敗しました'], 500);
        }
    }
}
