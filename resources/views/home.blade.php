@extends('layout')

@section('content')
  <div class="card text-light">
    <img src="../../storage/summerbeach.jpg" class="card-img img-fluid" alt="">
    <div class="card-img-overlay">
      <h3 class="card-title">codelab shoppingへようこそ</h3>
      <p class="card-text">みなさまの生活に役立つ商品を数々取り揃えております</p>
      <div class="top-button">
        <a href="{{ route('products.product-list') }}" class="px-5 btn btn-danger btn-lg">商品一覧へ</a>
      </div>
    </div>
  </div>
@endsection