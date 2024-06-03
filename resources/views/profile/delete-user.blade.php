@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card mt-5 mb-3">
          <div class="card-header">アカウントを削除します</div>
            <form method="post" action="{{ route('profile.delete') }}" class="p-6">
              @csrf
              @method('delete')
              <div class="card-body">

                @if($errors->userDeletion->any())
                  <div class="alert alert-danger">
                    @foreach($errors->userDeletion->get('password') as $message)
                      <p>{{ $message }}</p>
                    @endforeach
                  </div>
                @endif

                <p class="card-text">完全にアカウントを削除するためには、確認のために再度パスワードを入力してください。</p>
                <div class="form-group">
                  <label for="password">パスワード</label>
                  <input id="password" name="password" type="password" class="form-control"/>
                </div>
                <div class="flex items-center">
                  <div class="text-end">
                    <button type="submit" class="btn btn-danger">アカウントを削除する</button>
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