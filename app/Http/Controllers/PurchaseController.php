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
                'quantity' => $quantity,  // 購入数量も保存するように変更
            ]);

            DB::commit();
            return response()->json(['message' => '購入処理が成功しました']);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("購入処理エラー: " . $e->getMessage());
        return response()->json(['error' => '購入処理に失敗しました', 'details' => $e->getMessage()], 500);
    }
    }
}
