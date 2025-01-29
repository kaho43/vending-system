<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品情報編集</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1>商品情報編集画面</h1>
        <div>
            <strong>ID</strong>{{ $product->id }}
        </div>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label for="product_name">商品名</label>
                <input type="text" name="product_name" value="{{ $product->product_name }}" required>
            </div>

            <div>
                <label for="company_id">メーカー名</label>
                <select name="company_id" required>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ $company->id == $product->company_id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="price">価格</label>
                <input type="number" name="price" value="{{ $product->price }}" required>
            </div>

            <div>
                <label for="stock">在庫数</label>
                <input type="number" name="stock" value="{{ $product->stock }}" required>
            </div>

            <div>
                <label for="comment">コメント</label>
                <textarea name="comment">{{ $product->comment }}</textarea>
            </div>

            <div>
                <label for="image_path">商品画像</label>
                <input type="file" name="image_path" accept="image/*">
            </div>

            <div>
                <button type="submit">更新</button>
            </div>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
            </div>
        </form>
    </div>
    @endsection
</body>
</html>
