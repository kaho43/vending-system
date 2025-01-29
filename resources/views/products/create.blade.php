<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>商品登録</title>
        @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/css/style.css' , 'resources/css/script.jp'])
    </head>
    <body>
    @extends('layouts.app')

    @section('content')
        <div class="container create-container">
            <h1>新規商品登録画面</h1>

            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="form">
            @csrf
                <div class="form-group">
                    <label for="product_name" class="form-label">商品名<span class="required">＊</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="company_id">メーカー名<span class="required">＊</label>
                    <select id="company_id" name="company_id" required>
                        <option value=""></option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">価格<span class="required">＊</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                </div>
                <div class="form-group">
                    <label for="stock">在庫数<span class="required">＊</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required>
                </div>
                <div class="form-group">
                    <label for="comment">コメント</label>
                    <input type="text" id="comment" name="comment">
                </div>
                <div class="form-group">
                    <label for="image">商品画像</label>
                    <input type="file" class="file" id="image" name="image">
                </div>
                <div class="button-group">
                    <button type="submit" class="btn btn-product-create">新規登録</button>
                    <a href="{{ route('products.index') }}" class="btn btn-index">戻る</a>
                </div>
            </form>
        </div>
    @endsection
    </body>
</html>
