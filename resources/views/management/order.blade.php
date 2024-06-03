@extends('admin-layout')

@section('content')
  <div class="container">
    <div class="row mt-4 z-3 bg-primary-subtle">
      <p class="col-md-4 p-3 mb-0 fs-5 fw-bold align-content-center">注文履歴・ステータス一覧</p>
    </div>
    <div class="card my-5">
      <div class="card-header">注文検索</div>
      <div class="card-body">
        <form action="{{ route('management.order') }}" method="GET" class="form-search">
        @csrf
          <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="form-group">
              <label for="order_id">注文ID</label>
              <input type="number" name="order_id" class="form-control spin-erase" value="{{ request('order_id') }}">
            </div>
            <div class="form-group">
              <label for="date">注文日</label>
              <div class="d-flex justify-content-between">
                <input type="date" name="order_from" class="form-control form-control-half" value="{{ request('order_from') }}">
                <span class="pt-2">～</span>
                <input type="date" name="order_until" class="form-control form-control-half" value="{{ request('order_until') }}">
              </div>
            </div>
            <div class="form-group">
              <label for="min_price">最小金額</label>
              <input type="number" name="min_price" class="form-control spin-erase" value="{{ request('min_price') }}">
            </div>
            <div class="form-group">
              <label for="max_price">最大金額</label>
              <input type="number" name="max_price" class="form-control spin-erase" value="{{ request('max_price') }}">
            </div>
            <div class="form-group">
              <label for="name">注文者</label>
              <input type="search" name="name" class="form-control" value="{{ request('name') }}">
            </div>
            <div class="form-group">
              <label for="payment">お支払い方法</label>
              <select name="payment" id="payment" class="form-select form-control">
                <option value=""></option>
                @foreach (App\Models\Order::PAYMENT as $key => $val)
                  <option value="{{ $key }}" @if(old('payment', request()->payment ?? '') == $key) selected @endif>{{ $val['label'] }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="status">対応状況</label>
              <select name="status" id="status" class="form-select form-control">
                <option value=""></option>
              @foreach(\App\Models\Order::STATUS as $key => $val)
                <option value="{{ $key }}" @if(old('status', request()->status ?? '') == $key) selected @endif>{{ $val['label'] }}</option>
              @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="search"></label>
              <div class="d-flex align-items-end justify-content-between">
                <button type="submit" class="mx-2 mt-1 btn btn-primary">条件を絞って検索</button>
                <a href="{{ route('management.order') }}" class="btn btn-danger">リセット</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="card my-5">
      <div class="card-header">注文履歴一覧</div>
      <div class="card-body">
        @if($orders->isEmpty())
          <p class="p-3 mb-0 fs-5 text-center">検索結果がありません</p>
        @else
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="text-center">注文ID
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => 'asc']) }}" class="text-dark">↑</a>
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => 'desc']) }}" class="text-dark">↓</a>
                </th>
                <th>注文日時
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => 'asc']) }}" class="text-dark">↑</a>
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => 'desc']) }}" class="text-dark">↓</a>
                </th>
                <th>注文者</th>
                <th>購入金額
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_amount', 'direction' => 'asc']) }}" class="text-dark">↑</a>
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_amount', 'direction' => 'desc']) }}" class="text-dark">↓</a>
                </th>
                <th>お支払い方法</th>
                <th>対応状況
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status', 'direction' => 'asc']) }}" class="text-dark">↑</a>
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'status', 'direction' => 'desc']) }}" class="text-dark">↓</a>
                </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td class="text-center">{{ $order->id }}</td>
                  <td>{{ $order->created_at->format('Y/m/d h:i') }}</td>
                  <td>{{ $order->name }}</td>
                  <td>￥{{ number_format($order->total_amount) }}</td>
                  <td>{{ $order->payment_label }}</td>
                  <td>
                    <span class="label {{ $order->status_class }}">{{ $order->status_label }}</span>
                  </td>
                  <td><a href="{{ route('management.order-edit', ['order' => $order->id]) }}">編集</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $orders->links() }}
        @endif
      </div>
    </div>
  </div>
@endsection