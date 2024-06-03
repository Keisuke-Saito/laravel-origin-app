@extends('layout')

@section('content')
  <div class="container">
    <div class="card my-5">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded-start" alt="">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <form action="{{ route('products.product-detail', ['product' => $product->id]) }}" method="POST">
            @csrf
              <h3 class="card-title"> {{ $product->product_name }} </h3>
              <h4 class="card-text text-danger">￥{{ number_format($product->price) }} </h4>
              <p class="card-text"> {{ $product->content }} </p>
              <div class="mb-3 text-end">
                <span>数量</span>
                <select name="quantity" id="quantity">
                  @foreach (config('const.quantity') as $quantity)
                    <option value="{{ $quantity }}">{{ $quantity }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3 text-end">
                <input type="submit" value="カートに入れる" class="btn btn-danger">
              </div>
              @if(session('message'))
                @foreach (session('message') as $key => $item)
                  <div class="d-flex justify-content-end">
                    <p class="alert alert-{{ $key }} w-30"> {{ session('message.' .$key ) }}</p>
                  </div>
                @endforeach
              @endif
              @if($errors->any())
              <div class="d-flex justify-content-end">
                @foreach($errors->all() as $message)
                  <p class="alert alert-danger text-center w-50 ">{{ $message }}</p>
                @endforeach
              </div>
            @endif
            </from>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection('content')