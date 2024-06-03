@extends('layout')

@section('content')
  <div class="container">
    <div class="row mt-4 z-3 bg-warning-subtle sticky-top">
      <p class="col-md-4 p-3 mb-0 fs-5 fw-bold align-content-center">ショッピングカート</p>
      @if ($total == 0)
        <p class="col-md-8 p-3 mb-0 fs-5 align-content-center">カートに商品がありません。</p>
      @else
        <p class="col-md-4 p-3 mb-0 fs-5 align-content-center">合計金額は￥{{ number_format($total) }}です</p>
        <div class="col-md-4 m-0 p-0 d-flex justify-content-end">
          <a href="{{ route('cartitems.delivery') }}" class="m-3 btn btn-primary">購入手続きへ進む</a>
          <a href="{{ route('products.product-list') }}" class="my-3 btn btn-link text-decoration-none">他の商品を探す</a>
        </div>
      @endif
    </div>
    @if($errors->any())
    <div class="d-flex justify-content-center">
      @foreach($errors->all() as $message)
        <p class="alert alert-danger mb-0 align-content-center text-center w-50">{{ $message }}</p>
      @endforeach
    </div>
    @endif
    @foreach($carts as $cart)
    <div class="card my-5">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="{{ asset('storage/'.$cart->image) }}" class="img-fluid rounded-start" alt="">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h4 class="card-title"> {{ $cart->product_name }} </h4>
            <h5 class="card-text text-danger">￥{{ number_format($cart->price) }} </h5>
              <div class="mb-3">
                <form action = "{{ route('cartitems.change', ['cart_item' => $cart->pivot->id]) }}" method="POST">
                @csrf
                @method('put')
                <span>数量</span>
                <select name="quantity" id="quantity">
                  @foreach (config('const.quantity') as $quantity)
                    <option value="{{ $quantity }}" {{ $quantity == old('quantity', $cart->pivot->quantity) ? 'selected' : '' }}>{{ $quantity }}</option>
                  @endforeach
                </select>
                <div class="mt-3">
                  <input type="submit" value="数量変更" class="btn btn-danger btn-sm">
                </div>
                </form>
              </div>
            <div class="text-end">
              <form action="{{ route('cartitems.destroy', ['cart_item' => $cart->pivot->id]) }}" method="POST">
              @csrf
              @method('delete')
                <input type="submit" value="削除" class="btn btn-link text-decoration-none">
              </form>
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
@endsection('content')