@extends('admin-layout')

@section('content')
  <div class="container">
    <div class="row mt-4 bg-primary-subtle">
      <p class="col-md-4 p-3 mb-0 fs-5 fw-bold align-content-center">注文詳細・ステータス管理</p>
      <div class="col-md-8 m-0 p-0 d-flex justify-content-end">
        <a href="{{ route('management.order') }}" class="me-3 my-3 btn btn-primary">注文一覧へ戻る</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 p-0">
        <div class="card mt-5 mb-3">
          <div class="card-header">顧客情報</div>
          <div class="card-body">
          @if($errors->any())
            <div class="alert alert-danger">
            @foreach($errors->get('payment') as $message)
              <p>{{ $message }}</p>
            @endforeach
            @foreach($errors->get('status') as $message)
              <p>{{ $message }}</p>
            @endforeach
            </div>
          @endif
          @if (session('edit-order') === 'updated')
            <div>
              <p class="alert alert-success">ステータスを変更しました</p>
            </div>
          @endif
            <form action="{{ route('management.order-edit', ['order' => $order->id]) }}" method="POST">
            @csrf
              <div class="form-group">
                <label for="name">注文ID</label>
                <input readonly type="text" class="form-control border border-0" id="order_id" name="order_id" value="{{ $order->id }}"/>
              </div>
              <div class="form-group">
                <label for="date">注文日時</label>
                <input readonly type="text" class="form-control border border-0" name="date" value="{{ $order->created_at }}">
              </div>
              <div class="form-group">
                <label for="name">注文者</label>
                <input readonly type="text" class="form-control border border-0" name="name" value="{{ $order->name }}"/>
              </div>
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input readonly type="text" class="form-control border border-0" name="email" value="{{ $user->email }}"/>
              </div>
              <div class="form-group">
                <label for="address">お届け先住所</label>
                <textarea readonly class="form-control border border-0" id="address" name="address">{{ $order->delivery_address }}</textarea>
              </div>
              <div class="form-group">
                <label for="payment">お支払い方法</label>
                <select name="payment" class="form-select form-control">
                  @foreach (\App\Models\Order::PAYMENT as $key => $val)
                    <option value="{{ $key }}" {{ $key == old('payment', $order->payment) ? 'selected' : '' }}>{{ $val['label'] }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="status">対応状況</label>
                <select name="status" id="status" class="form-select form-control">
                  @foreach(\App\Models\Order::STATUS as $key => $val)
                    <option value="{{ $key }}" {{ $key == old('status', $order->status) ? 'selected' : '' }}>{{ $val['label'] }}</option>
                  @endforeach
                </select>
              </div>
              <div class="text-end">
                <input type="submit" value="変更" class="btn btn-danger">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8 ps-5 pe-0">
        <div class="card mt-5 mb-3">
          <div class="card-header">購入商品情報</div>
          <div class="card-body">
          @if($errors->changePurchaseQuantity->any())
            @foreach($errors->changePurchaseQuantity->get('quantity') as $message)
              <p class="alert alert-danger text-center">{{ $message }}</p>
            @endforeach
          @endif
          @if(session('change-purchase-quantity') === 'changed')
              <p class="alert alert-success text-center">数量を変更しました</p>
          @endif
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>
                    購入商品名
                  </th>
                  <th>
                    単価
                  </th>
                  <th>
                    数量
                  </th>
                  <th class="text-end">
                    小計
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($order_details as $order_detail)
                  <form action="{{ route('management.change', ['order' => $order->id, 'order_detail' => $order_detail->pivot->id]) }}" method="POST">
                  @csrf
                  @method('put')
                    <tr>
                      <td class="{{ $order_detail->pivot->quantity == 0 ? 'bg-secondary-subtle text-decoration-line-through' : '' }}">{{ $order_detail->product_name }}</td>
                      <td class="{{ $order_detail->pivot->quantity == 0 ? 'bg-secondary-subtle text-decoration-line-through' : '' }}">￥{{ number_format($order_detail->price) }}</td>
                      <td class="{{ $order_detail->pivot->quantity == 0 ? 'bg-secondary-subtle' : '' }}">
                        <select name="quantity" id="quantity">
                          @foreach (config('const.order_quantity') as $quantity)
                            <option value="{{ $quantity }}" {{ $quantity == old('quantity', $order_detail->pivot->quantity) ? 'selected' : '' }}>{{ $quantity }}</option>
                          @endforeach
                        </select>
                        <input type="submit" value="変更" class="btn btn-danger btn-sm">
                      </td>
                      <td class="text-end {{ $order_detail->pivot->quantity == 0 ? 'bg-secondary-subtle' : '' }}">￥{{ number_format($order_detail->price * $order_detail->pivot->quantity) }}</td>
                    </tr>
                  </form>
                @endforeach
              </tbody>
            </table>
            <p class="p-3 mb-0 text-end fs-5">合計：￥{{ number_format($order->total_amount) }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection