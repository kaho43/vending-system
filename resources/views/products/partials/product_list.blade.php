<!-- 商品一覧テーブル -->
<table class="table">
    <thead>
        <tr>
            <th>
                <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                    ID
                    @if(request('sort') === 'id')
                        {!! request('direction') === 'asc' ? '🔼' : '🔽' !!}
                    @endif
                </a>
            </th>
            <th>商品画像</th>
            <th>
                <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'product_name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                    商品名
                    @if(request('sort') === 'product_name')
                        {!! request('direction') === 'asc' ? '🔼' : '🔽' !!}
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                    価格
                    @if(request('sort') === 'price')
                        {!! request('direction') === 'asc' ? '🔼' : '🔽' !!}
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'stock', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                    在庫数
                    @if(request('sort') === 'stock')
                        {!! request('direction') === 'asc' ? '🔼' : '🔽' !!}
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('products.index', ['sort' => 'company_name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                    メーカー名
                    @if(request('sort') === 'company_name')
                        {!! request('direction') === 'asc' ? '🔼' : '🔽' !!}
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('products.create') }}" class="btn btn-add-product">新規登録</a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $index => $product)
            <tr class="product @if($index % 2 == 0) odd-row @endif" id="product-{{ $product->id }}">
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
                    <form class="delete-form" data-id="{{ $product->id }}" style="display:inline;">
                        @csrf
                        <button type="button" class="btn danger-btn delete-btn">削除</button>
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
    <nav role="navigation" aria-label="Pagination Navigation" class="pagination-nav">
        <ul class="pagination">
            <!-- ページ番号 -->
                {{ $products->links('vendor.pagination.custom') }}
        </ul>
    </nav>
</div>