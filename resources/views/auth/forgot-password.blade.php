@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card card-m">
          <div class="card-header">パスワード再発行</div>
            <form method="post" action="{{ route('password.email') }}" class="p-6">
              @csrf
              <div class="card-body">

                @if($errors->any())
                  <div class="alert alert-danger">
                    @foreach($errors->get('email') as $message)
                      <p>{{ $message }}</p>
                    @endforeach
                  </div>
                @endif

                <p class="card-text">登録時のメールアドレスを入力してください</p>
                <div class="form-group">
                  <label for="email">メールアドレス</label>
                  <input id="email" name="email" type="email" class="form-control"/>
                </div>
                <div class="flex items-center">
                  <div class="text-end">
                    <button type="submit" class="btn btn-danger">パスワード再設定メールを送信</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection