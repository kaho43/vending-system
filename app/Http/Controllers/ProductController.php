<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('company');

        // 商品名でのフィルタリング
        if ($request->filled('name')) {
            $query->where('product_name', 'like', '%' . $request->name . '%');
        }

        // 企業名でのフィルタリング
        if ($request->filled('company_name')) {
            $query->whereHas('company', function ($q) use ($request) {
                $q->where('company_name', $request->company_name);
            });
        }

        // データをソートし、ページネーションを適用
        $products = $query->orderBy('product_name', 'asc')->paginate(10);

        // 企業情報を取得
        $companies = Company::all();

        dd($companies->toArray());
        // ビューにデータを渡す
        return view('products.index', ['products' => $products, 'companies' => $companies]);

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


    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', '商品を削除しました。');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

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

        // バリデーション
        $request->validate([
            'product_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'comment' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // 更新処理
        $product->product_name = $request->product_name;
        $product->company_id = $request->company_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
            $product->image_path = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', '商品情報が更新されました');
    }

}
