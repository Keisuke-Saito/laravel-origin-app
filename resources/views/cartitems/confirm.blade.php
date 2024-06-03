@extends('layout')

@section('content')
  <div class="container">
    <form action = "{{ route('cartitems.done') }}" method="POST">
    @csrf
      <div class="row mt-4 bg-warning-subtle">
        <p class="col-md-2 p-3 mb-0 fs-5 fw-bold align-content-center">注文確認</p>
        <p class="col-md-8 p-3 mb-0 fs-6 align-content-center text-center">以下の商品を購入します。よろしければ「注文する」ボタンを押して下さい。</p>
      </div>
      <div class="row">
        <div class="col-md-8 p-0">
          <div class="card mt-5 mb-3">
            <div class="card-header">お届け先情報</div>
            <div class="card-body">
              <div class="form-group">
                <label for="name">お名前</label>
                <input readonly type="text" class="form-control border border-0 fs-5" name="name" value="{{ $user->name }}"/>
              </div>
              <div class="form-group">
                <label for="address">お届け先住所</label>
                <textarea readonly class="form-control border border-0 fs-5" name="address">{{ $address }}</textarea>
              </div>
              <div class="form-group">
                <label for="payment">お支払い方法</label>
                <input readonly type="text" class="form-control border border-0 fs-5" value="{{ App\Models\Order::PAYMENT[$payment]['label'] }}"/>
                <input type="hidden" name="payment" value="{{ $payment }}">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 ps-5 pe-0">
          <div class="card mt-5 mb-3 bg-warning-subtle">
            <div class="card-body mx-auto my-3 p-0 text-center">
              <p class="fs-4">合計：￥{{ number_format($total) }}</p>
              <input type="hidden" id="total" name="total" value="{{ $total }}">
              <input type="submit" value="注文する" class="px-5 py-2 fs-5 btn btn-danger"></input>
            </div>
            <a href="{{ route('cartitems.delivery') }}" class="btn btn-link text-decoration-none">お届け先入力に戻る</a>
          </div>
        </div>
      </div>
      <div class="row mt-5">
        @foreach($carts as $cart)
        <div class="card col-md-8 mt-5 mb-3 my-2 p-0">
          <div class="row">
            <div class="col-md-4">
              <img src="{{ asset('storage/'.$cart->image) }}" class="img-fluid rounded-start" alt="">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h4 class="card-title"> {{ $cart->product_name }} </h4>
                <h5 class="card-text text-danger">￥{{ number_format($cart->price) }} </h5>
                <div class="mb-3">
                  <span>数量：{{ $cart->pivot->quantity }}</span>
                </div>
                <div class="text-end">
                  <p class="border-top fs-5 fw-medium pt-3 mb-0">小計：￥{{ number_format($cart->price * $cart->pivot->quantity) }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </form>
  </div>
@endsection('content')