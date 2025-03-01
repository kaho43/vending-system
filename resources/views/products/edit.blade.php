<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>商品情報編集</title>
                @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/css/style.css']) <!-- script.jpは削除 -->
        </head>
        <body>
        @extends('layouts.app')

        @section('content')    
            <div class="container edit-container">
                <h1>商品情報編集画面</h1>

                <div class="form">
                    <div class="form-group">
                        <span class="form-label">ID</span>{{ $product->id }}
                    </div>
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')    
                        <div class="form-group">
                            <label for="product_name"  class="form-label">商品名<span class="required">＊</label>
                            <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="company_id" class="form-label">メーカー名<span class="required">＊</label>
                            <select class="form-control" name="company_id" required>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ $company->id == $product->company_id ? 'selected' : '' }}>
                                    {{ $company->company_name }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">価格<span class="required">＊</label>
                            <input type="number" class="form-control" name="price" value="{{ $product->price }}" required>                            </div>
                        <div class="form-group">
                            <label for="stock" class="form-label">在庫数<span class="required">＊</label>
                            <input type="number" class="form-control" name="stock" value="{{ $product->stock }}" required>
                        </div>
                        <div class="form-group">
                            <label for="comment" class="form-label">コメント</label>
                            <textarea name="comment" class="form-control">{{ $product->comment }}</textarea>                            
                        </div>
                        <div class="form-group">
                            <label for="image_path" class="form-label">商品画像</label>
                            <input type="file" name="image_path" accept="image/*">                            
                        </div>                            
                        <div class="form-group">
                            <button type="submit" class="btn btn-update">更新</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
                        </div>
                    </form>
                </div>
            </div>
        @endsection
    </body>
</html>
