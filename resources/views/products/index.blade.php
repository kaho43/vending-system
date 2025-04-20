<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>商品一覧</title>
        @vite([ 'resources/css/app.css', 'resources/css/style.css'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        @extends('layouts.app')

        @section('content')

            <div class="container index-container">
                <div class="header-search">
                    <h1>商品一覧画面</h1>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                    <!-- 検索フォーム -->
                    <form id="search-form" action="{{ route('products.search') }}" method="POST">
                    @csrf

                        <div class="search-group">
                            <div class="company-search-area"> 
                                <input type="text" name="keyword" placeholder="検索キーワード" value="{{ request('keyword') }}">
                                <select name="company_name" id="company_name">
                                    <option value="">メーカー名</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->company_name }}" {{ request('company_name') == $company->company_name ? 'selected' : '' }}>
                                            {{ $company->company_name }}
                                        </option>
                                    @endforeach                            
                                </select>
                            </div>
            
                            <div class="number-search-area">
                            
                                <!-- 価格範囲 -->
                                <div class="price-range">
                                    <span class="range-label">価格範囲　</span>
                                    <input type="number" name="price_min" id="price_min" placeholder="最小価格" value="{{ request('price_min') }}">
                                    <input type="number" name="price_max" id="price_max" placeholder="最大価格" value="{{ request('price_max') }}">
                                </div>

                            <!-- 在庫数範囲 -->
                            <div class="stock-range">
                                <span class="range-label">在庫数範囲</span>
                                <input type="number" name="stock_min" id="stock_min" placeholder="最小在庫数" value="{{ request('stock_min') }}">
                                <input type="number" name="stock_max" id="stock_max" placeholder="最大在庫数" value="{{ request('stock_max') }}">
                            </div>
                        </div>

                        <button type="submit" class="btn search-submit-btn">検索</button>
                    </div>
                </form>
            </div>
                    
            <!-- 商品リスト表示エリア -->
            <div id="product-list">
                @include('products.partials.product_list', ['products' => $products, 'sort' => $sort, 'direction' => $direction])
            </div>

                        
        <script>    

            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

                // 検索フォームの送信をAJAXで行う
                $('#search-form').on('submit', function(e) {
                    e.preventDefault(); // 通常のフォーム送信を防止

                    let formData = $(this).serialize(); // フォームデータをシリアライズ

                    $.ajax({
                        url: '{{ route('products.search') }}', // 検索のURL

                        method: 'POST',

                        data: formData,
                        success: function(response) {
                            console.log(response); // ここでレスポンスを確認
                            // 商品リストを更新
                            $('#product-list').html(response.html);
            
                        },
                        error: function() {
                            console.error(xhr.responseText);
                            alert('検索に失敗しました');
                        }
                    });
                });

                    $(document).on('click', '.delete-btn', function () {
    let form = $(this).closest('.delete-form');
    let productId = form.data('id');  // data-id属性の取得
    console.log('削除する商品ID: ', productId);  // IDが表示されるか確認

    if (!confirm('本当に削除しますか？')) {
        return;
    }

    // 修正: 正しいURLを指定する
    let url = window.location.origin + '/vending-system/public/products/' + productId;


    $.ajax({
        url: url,
        type: 'POST',  // POSTメソッドを使用
        data: {
            _method: 'DELETE',  // DELETEメソッドに偽装
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            if (response.success) {
                 // 削除した商品をリストから非表示にする
                 $('#product-' + productId).fadeOut(500, function () {
                    $(this).remove();  // 完全に削除する場合
                    //$(this).hide();  // 非表示にする場合
                });
            } else {
                alert('削除に失敗しました。');
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            alert('エラーが発生しました。');
        }
    });
});


            </script>
        
            <!-- JavaScriptを読み込む -->
            @vite(['resources/js/app.js'])

        @endsection
    </body>
</html> 


                        
                