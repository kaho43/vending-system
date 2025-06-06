<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>商品一覧</title>
        @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/css/style.css'])
    </head>
    <body>
        @extends('layouts.app')

        @section('content')

            <div class="container show-container">
                <h1>商品情報詳細画面</h1>
                
                <div class="table">
                    <table>
                        <tr class="show-label">
                            <th >ID</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr class="show-label">
                            <th>商品画像</th>
                            <td>
                                @if ($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="商品画像" width="200">
                                @else
                                    画像なし
                                @endif
                            </td>
                        </tr>
                        <tr class="show-label">
                            <th>商品名</th>
                            <td>{{ $product->product_name }}</td>
                        </tr>
                        <tr class="show-label">
                            <th>メーカー</th>
                            <td>{{ $product->company->company_name }}</td>
                        </tr>
                        <tr class="show-label">
                            <th>価格</th>
                            <td>{{ $product->price }}円</td>
                        </tr>
                        <tr class="show-label">
                            <th>在庫数</th>
                            <td>{{ $product->stock }}</td>
                        </tr>
                        <tr class="show-label">
                            <th>コメント</th>
                            <td>{{ $product->comment ? $product->comment :'コメントなし' }}</td>
                        </tr>
                    </table>
                    <!-- 編集ボタン -->
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">編集</a>

                    <!-- 商品一覧に戻るボタン -->
                    <a href="{{ route('products.index') }}" class="btn btn-primary">戻る</a>
                </div>
            </div>
        @endsection
    </body>
</html>
