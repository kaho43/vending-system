<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function store(Request $request)
    {
        // リクエストのバリデーション あとでバリテーション専用に移動
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        DB::beginTransaction();
        try {
            // 商品を取得
            $product = Product::findOrFail($request->product_id);

            // 在庫が足りない場合、エラーレスポンスを返す
            if ($product->stock < $request->quantity) {
                return response()->json(['error' => '在庫が足りません'], 400);
            }

            // salesテーブルにレコードを追加
            $sale = Sale::create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'total_price' => $product->price * $request->quantity,
            ]);

            // productsテーブルの在庫数を減算
            $product->stock -= $request->quantity;
            $product->save();

            // トランザクションをコミット
            DB::commit();

            return response()->json(['message' => '購入処理が成功しました', 'sale' => $sale], 201);

        } catch (\Exception $e) {
            // トランザクションのロールバック
            DB::rollBack();
            return response()->json(['error' => '購入処理に失敗しました'], 500);
        }
    }
}
