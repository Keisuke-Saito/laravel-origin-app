@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card mt-5 mb-3">
          <div class="card-header">アカウント情報更新</div>
          <form id="send-verification" method="post" action="{{ route('verification.send') }}">
          @csrf
          </form>
          <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
          @csrf
          @method('patch')
            <div class="card-body">

              @if($errors->any())
                <div class="alert alert-danger">
                  @foreach($errors->get('name') as $message)
                    <p>{{ $message }}</p>
                  @endforeach
                  @foreach($errors->get('email') as $message)
                    <p>{{ $message }}</p>
                  @endforeach
                  @foreach($errors->get('address') as $message)
                    <p>{{ $message }}</p>
                  @endforeach
                </div>
              @endif

              <div class="form-group">
                <label for="name">ユーザー名</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $user->name }}"/>
              </div>

              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ?? $user->email }}"/>
              </div>

              <div class="form-group">
                <label for="address">住所</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') ?? $user->address }}"/>
              </div>

              <div class="text-end">
                <button type="submit" class="btn btn-primary">更新</button>
              </div>
            </div>
          </form>
        </div>

        <div class="card mt-5 mb-3">
          <div class="card-header">パスワードの更新</div>
          <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
          @csrf
          @method('put')
            <div class="card-body">

              @if($errors->updatePassword->any())
                <div class="alert alert-danger">
                  @foreach($errors->updatePassword->get('current_password') as $message)
                    <p>{{ $message }}</p>
                  @endforeach
                  @foreach($errors->updatePassword->get('new_password') as $message)
                    <p>{{ $message }}</p>
                  @endforeach
                  @foreach($errors->updatePassword->get('password_confirmation') as $message)
                    <p>{{ $message }}</p>
                  @endforeach
                </div>
              @endif

              <div class="form-group">
                <label for="current_password">現在のパスワード</label>
                <input id="current_password" name="current_password" type="password" class="form-control"/>
              </div>

              <div class="form-group">
                <div>
                  <label for="password">新しいパスワード</label>
                  <input id="new_password" name="new_password" type="password" class="form-control"/>
                </div>
              </div>

              <div class="form-group">
                <div>
                  <label for="password_confirmation">パスワードを再入力</label>
                  <input id="new_password_confirmation" name="new_password_confirmation" type="password" class="form-control"/>
                </div>
              </div>

              <div class="flex items-center">
                <div class="text-end">
                  <button type="submit" class="btn btn-primary">保存</button>
                </div>

                @if (session('status') === 'password-updated')
                  <div class="d-flex justify-content-end">
                    <p class="alert alert-success">保存されました</p>
                  </div>
                @endif
              </div>
            </div>
          </form>
        </div>

        <div class="card mt-5 mb-3">
          <div class="card-header">アカウントの削除</div>
          <form method="post" action="{{ route('profile.delete') }}" class="p-6">
            @csrf
            @method('delete')
            <div class="card-body">
              <p class="card-text">アカウントを削除すると、全てのデータとファイルも完全に削除されます</p>
              <div class="flex items-center">
                <div class="text-end">
                  <a class="btn btn-danger" href=" {{ route('profile.delete') }} ">アカウントを削除</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection