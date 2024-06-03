@extends('layout')

@section('content')
  <div class="container">
    <form action = "{{ route('cartitems.confirm') }}" method="POST">
    @csrf
      <div class="row mt-4 bg-warning-subtle sticky-top">
        <p class="col-md-4 p-3 mb-0 fs-5 fw-bold align-content-center">お届け先入力</p>
        <p class="col-md-4 p-3 mb-0 fs-6 align-content-center">別の場所へ配送する場合は入力してください。</p>
        <div class="col-md-4 m-0 p-0 d-flex justify-content-end">
          <input type="submit" value="注文内容の確認" class="m-3 btn btn-primary"></input>
          <a href="{{ route('cartitems.cart') }}" class="my-3 btn btn-link text-decoration-none">カートに戻る</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="card mt-5 mb-3">
            <div class="card-header">お届け先情報</div>
              <div class="card-body">
                @if($errors->any())
                  <div class="alert alert-danger">
                    @foreach($errors->all() as $message)
                      <p>{{ $message }}</p>
                    @endforeach
                  </div>
                @endif
                <div class="form-group">
                  <label for="name">お名前</label>
                  <input readonly type="text" class="form-control border border-0" id="name" name="name" value="{{ old('name') ?? $user->name }}"/>
                </div>
                <div class="form-group">
                  <label for="address">お届け先住所</label>
                  <textarea class="form-control" id="address" name="address">{{ old('address') ?? $user->address }}</textarea>
                </div>
                <div class="form-group">
                  <label for="payment">お支払い方法</label>
                  <select name="payment" id="payment" class="form-select form-control">
                    <option value="1">クレジットカード</option>
                    <option value="2">コンビニ・ATM払い</option>
                    <option value="3">あと払い</option>
                  </select>
                </div>
              </div>
            </div>
        </div>
      </div>
    </form>
  </div>
@endsection('content')