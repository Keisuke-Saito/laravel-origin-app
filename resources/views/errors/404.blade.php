@extends('errors-layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="text-center">
          <p>お探しのページは見つかりませんでした。</p>
          <a href="{{ route('home') }}" class="btn">
            ホームへ戻る
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection