<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
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
    DB::beginTransaction();
    try {
        // salesテーブルにレコードを追加（quantityは保存せず、total_priceだけを保存）
        $sale = Sale::create([
            'product_id' => $product->id,
            'total_price' => $product->price * $validated['quantity'], // 数量を計算に使うが保存しない
        ]);

        // 在庫数を減らす
        $product->decrement('stock', $validated['quantity']);

        // トランザクションをコミット
        DB::commit();

        // レスポンス
        return response()->json(['message' => '購入処理が完了しました', 'sale' => $sale], 200);

    } catch (\Exception $e) {
        // トランザクションのロールバック
        DB::rollBack();
        return response()->json(['error' => '購入処理に失敗しました', 'details' => $e->getMessage()], 500);
    }
}

}
