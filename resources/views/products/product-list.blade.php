@extends('layout')

@section('content')
  <div class="container">
    <h1 class="py-3 text-center">SPECIAL SALE!!<br>最大20％OFF!!</h1>
    @if($products->isEmpty())
      <p class="p-3 mb-0 fs-5 text-center">検索結果がありません</p>
    @else
      <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
      @foreach($products as $product)
        <div class="col">
          <div class="card h-100">
            <div class="img-cover h-100">
              <a href=" {{ route('products.product-detail', ['product' => $product->id]) }}" class="img-hover">
                <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="">
              </a>
            </div>
            <div class="card-body">
              <h4 class="card-title"> {{ $product->product_name }} </h4>
              <h5 class="card-text text-danger">￥{{ number_format($product->price) }} </h5>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    @endif
    {{ $products->links() }}
  </div>
@endsection