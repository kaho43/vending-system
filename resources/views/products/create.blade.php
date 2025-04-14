<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>商品登録</title>
        @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/css/style.css']) <!-- script.jpは削除 -->
    </head>
    <body>
    @extends('layouts.app')

    @section('content')
        <div class="container create-container">
            <h1>商品新規登録画面</h1>

            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="form">
            @csrf
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <div class="form-group">
                    <label for="product_name" class="form-label">商品名<span class="required">＊</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name') }}" required>
                </div>
                <div class="form-group form-company">
                    <label for="company_id" class="form-label">メーカー名<span class="required">＊</label>
                    <select class="form-control" id="company_id" name="company_id" required>
                        <option value=""></option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price" class="form-label">価格<span class="required">＊</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                </div>
                <div class="form-group">
                    <label for="stock" class="form-label">在庫数<span class="required">＊</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" required>
                </div>
                <div class="form-group">
                    <label for="comment" class="form-label">コメント</label>
                    <input type="text" class="form-control" id="comment" name="comment">
                </div>
                <div class="form-group">
                    <label for="image" class="form-label">商品画像</label>
                    <input type="file" class="file" id="image" name="image">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-product-create">新規登録</button>
                    <a href="{{ route('products.index') }}" class="btn btn-index">戻る</a>
                </div>
            </form>
        </div>
    @endsection
    </body>
</html>
