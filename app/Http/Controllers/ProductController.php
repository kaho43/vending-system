<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('company');

        // ソート順の取得（デフォルトはid降順）
        $sort = $request->input('sort', 'id');
        $direction =$request->input('direction', 'desc');


        // キーワード検索
        if ($request->filled('keyword')) {
            $query->where('product_name', 'like', '%' . $request->keyword . '%');
        }

        // メーカー名検索
        if ($request->filled('company_name')) {
            $query->whereHas('company', function ($q) use ($request) {
                $q->where('company_name', $request->company_name);
            });
        }

        // 価格範囲検索
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // 在庫数範囲検索
        if ($request->filled('stock_min')) { 
            $query->where('stock', '>=', $request->stock_min);
        }
        if ($request->filled('stock_max')) {
            $query->where('stock', '<=', $request->stock_max);
        }

         // 指定されたカラムがテーブルに存在するか確認
        $validColumns = ['id', 'product_name', 'price', 'stock']; // company_name を含めない
        if (!in_array($sort, $validColumns)) {
            $sort = 'id'; // 不正なカラムが指定された場合はデフォルトに戻す
        }

        // データをソートし、ページネーションを適用
        $products = $query->orderBy($sort, $direction)->paginate(5);


        // 企業情報（company_name）のみ取得
        $companies = Company::all();

        // ビューにデータを渡す
        return view('products.index', compact('products', 'companies', 'sort', 'direction'));

    }



    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }



    public function show($id)
    {
        // 商品情報を企業情報と一緒に取得
        $product = Product::with('company')->findOrFail($id);
        return view('products.show', compact('product'));
    }


    public function store(ProductRequest $request) 
    {

                // バリデーション済みデータを取得
                $validated = $request->validated();
        // 新しい商品を作成
        $product = Product::create($validated);

        // 画像がアップロードされている場合
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $product->image_path = $path;
            $product->save(); // 画像パスを保存
        }

        return redirect()->route('products.index')->with('success', '商品を登録しました。');
    }



    public function edit($id)
    {
        // 商品データと企業情報を取得
        $product = Product::findOrFail($id);
        $companies = Company::all();

        // 編集画面を表示
        return view('products.edit', compact('product', 'companies'));
    }



    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
            $product->image_path = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', '商品情報が更新されました');
    }



    public function search(Request $request)
    {
        // $sort 変数を定義する
    $sort = $request->get('sort', 'default_value'); // 必要に応じて適切な値に調整
    
        $keyword = $request->input('keyword');
        $companyName = $request->input('company_name'); 
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');
        $stockMin = $request->input('stock_min');
        $stockMax = $request->input('stock_max');

        $query = Product::query();

        // キーワード検索
        if (!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        // メーカー名検索
        if (!empty($companyName)) {
            $query->whereHas('company', function($query) use ($companyName){
                $query->where('company_name', 'LIKE', "%{$companyName}%");
            });
        }

        // 価格範囲検索
        if (!empty($priceMin)) {
            $query->where('price', '>=', $request->price_min);
        }

        if (!empty($priceMax)) {
            $query->where('price', '<=', $request->price_max);
        }

        // 在庫数範囲検索
        if (!empty($stockMin)) {
            $query->where('stock', '>=', $request->stock_min);
        }

        if (!empty($stockMax)) {
            $query->where('stock', '<=', $request->stock_max);
        }

        $products = $query->paginate(5);
        $companies = Company::all();

        if ($request->ajax()) {
            // AJAXレスポンスとしてHTMLとページネーションを返す
            $html = view('products.partials.product_list', compact('products', 'sort'))->render();
            return response()->json(['html' => $html]);

        }   

    return view('products.index', compact('products', 'companies'));
    }

    public function destroy($id): JsonResponse
    {
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json(['success' => false, 'message' => '商品が見つかりませんでした。']);
        }
    
        $product->delete();
    
        return response()->json(['success' => true, 'message' => '商品が削除されました。']);
    }
    

}