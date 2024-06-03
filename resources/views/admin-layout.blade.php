<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>codelab shopping</title>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
  <nav class="my-navbar">
    <div class="my-navbar-group">
      <a class="admin-navbar-brand mb-0" href="{{ route('management.order') }}">codelab shopping</a>
      <p class="mb-0">管理画面</p>
    </div>
    <div class="my-navbar-control d-flex">
      @if(Auth::guard('admin')->check())
        <p class="my-navbar-item mb-0">{{ Auth::guard('admin')->user()->name }}</p>
        ｜
        <a class="my-navbar-item text-center" href="{{ route('home') }}">TOP</a>
        ｜
        <a class="my-navbar-item align-middle" href="{{ route('management.order') }}">注文管理トップ</a>
        ｜
        <form id="logout-form" class="my-navbar-item" action="{{ route('admin.logout') }}" method="POST">
        @csrf
          <input type="submit" class="p-0" value="ログアウト">
        </form>
      @else
        <a class="my-navbar-item" href="{{ route('home') }}">TOP</a>
        ｜
        <a class="my-navbar-item" href="{{ route('admin.login') }}">管理者ログイン</a>
        ｜
        <a class="my-navbar-item" href="{{ route('admin.register') }}">管理者登録</a>
      @endif
    </div>
  </nav>
</header>
<main>
  @yield('content')
</main>
@yield('scripts')
</body>
</html>