@extends('admin-layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card mt-5 mb-3">
          <div class="card-header">管理者登録</div>
          <div class="card-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('admin.register') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="admin-name">管理者名</label>
                <input type="text" class="form-control" id="admin-name" name="admin-name" value="{{ old('admin-name') }}" />
              </div>
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
              </div>
              <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="form-group">
                <label for="password-confirm">パスワード（確認）</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
              </div>
              <div class="text-end">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection