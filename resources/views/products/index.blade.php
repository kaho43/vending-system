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

            <div class="container index-container">
                <h1>商品一覧画面</h1>

                <!-- 検索フォーム -->
                <form method="GET" action="{{ route('products.index') }}">
                    <div class="search-group">
                        <input type="text" name="keyword" placeholder="検索キーワード" value="{{ request('name') }}">
                        <select name="manufacturer" id="manufacturer">                           
                            <option value="">メーカー名</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}"> {{ $company->company_name }}></option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn submit-btn">検索</button>
                    </div>
                </form>

                <br>
                <!-- 商品一覧テーブル -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>商品画像</th>
                            <th>商品名</th>
                            <th>価格</th>
                            <th>在庫数</th>
                            <th>メーカー名</th>
                            <th>
                                <a href="{{ route('products.create') }}" class="btn btn-add-product">新規登録</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $index => $product)
                            <tr class="product @if($index % 2 == 0) odd-row @endif">
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="商品画像" width="50">
                                        @else
                                            <span>画像なし</span>
                                    @endif
                                </td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->company->company_name ?? 'メーカー不明' }}</td>
                                <td class="btn table-btn">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn info-btn">詳細</a>
                                    <!-- 削除ボタン -->
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn danger-btn" onclick="return confirm('本当に削除しますか?')">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @for ($i = $products->count(); $i < 10; $i++)
                            <tr>
                                <td colspan="7" style="height: 50px" class="text-center"></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <!-- ページネーションリンク -->
                <div class="pagination-container">
                @if ($products->hasPages())
                    <nav role="navigation" aria-label="Pagination Navigation" class="pagination-nav">
                        <ul class="pagination">
                            <!-- ページ番号 -->
                            {!! $products->links() !!}
                        </ul>
                    </nav>
                @endif
            </div>

        @endsection
    </body>
</html>
