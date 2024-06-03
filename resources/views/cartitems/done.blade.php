@extends('layout')

@section('content')
  <div class="container">
    <div class="row mt-4 bg-warning-subtle">
      <p class="col-md-2 p-3 mb-0 fs-5 fw-bold align-content-center">購入完了</p>
      <p class="col-md-8 p-3 mb-0 fs-6 align-content-center text-center">注文が完了しました。ご購入ありがとうございました。</p>
    </div>
    <div class="d-flex justify-content-center">
      <a href="{{ route('products.product-list') }}" class="btn btn-link text-decoration-none my-3">商品ページへ戻る</a>
    </div>
  </div>
@endsection('content')