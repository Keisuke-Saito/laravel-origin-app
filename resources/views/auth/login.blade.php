@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card mt-5 mb-3">
          <div class="card-header">ログイン</div>
          <div class="card-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}"/>
              </div>
              <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password"/>
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