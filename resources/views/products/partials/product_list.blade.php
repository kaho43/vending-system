<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                <a href="{{ route('products.index', ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                    ID
                    @if ($sort == 'id')
                        @if ($direction == 'desc')
                            <i class="fa fa-sort-desc"></i>
                        @else
                            <i class="fa fa-sort-asc"></i>
                        @endif
                    @endif
                </a>
            </th>
            <th>商品画像</th>
            <th>
                <a href="{{ route('products.index', ['sort' => 'product_name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                    商品名
                    @if ($sort == 'product_name')
                        @if ($direction == 'desc')
                            <i class="fa fa-sort-desc"></i>
                        @else
                            <i class="fa fa-sort-asc"></i>
                        @endif
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('products.index', ['sort' => 'price', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                    価格
                    @if ($sort == 'price')
                        @if ($direction == 'desc')
                            <i class="fa fa-sort-desc"></i>
                        @else
                            <i class="fa fa-sort-asc"></i>
                        @endif
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('products.index', ['sort' => 'stock', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                    在庫数
                    @if ($sort == 'stock')
                        @if ($direction == 'desc')
                            <i class="fa fa-sort-desc"></i>
                        @else
                            <i class="fa fa-sort-asc"></i>
                        @endif
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('products.index', ['sort' => 'company_name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                    メーカー名
                    @if ($sort == 'company_name')
                        @if ($direction == 'desc')
                            <i class="fa fa-sort-desc"></i>
                        @else
                            <i class="fa fa-sort-asc"></i>
                        @endif
                    @endif
                </a>
            </th>
            <th>                
                <a href="{{ route('products.create') }}" class="btn btn-add-product">新規登録</a>
            </th>        
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="商品画像" width="50">
                    @else
                        <span>画像なし</span>
                    @endif
                </td>
                <td>{{ $product->product_name }}</td>
                <td>{{ number_format($product->price) }}円</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->company->company_name ?? 'メーカー不明' }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">詳細</a>
                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか?')">削除</button>
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

<div class="pagination-container">
    <nav role="navigation" aria-label="Pagination Navigation" class="pagination-nav">
        <ul class="pagination">
            {{ $products->links() }}
        </ul>
    </nav>
</div>
