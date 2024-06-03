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
      <a class="my-navbar-brand" href="{{ route('products.product-list') }}">codelab shopping</a>
      <form action="{{ route('products.product-list') }}" method="GET" class="form-search">
        @csrf
          <input type="search" name="search" placeholder="商品を探す" value="@if(isset($search)) {{ $search }}@endif">
          <input type="submit" value="検索" class="btn btn-warning">
      </form>
    </div>
    @if(Auth::check())
      <div class="my-navbar-control d-flex">
        <p class="my-navbar-item mb-0">ようこそ、{{ Auth::user()->name }}さん</p>
        ｜
        <a class="my-navbar-item" href="{{ route('home') }}">TOP</a>
        ｜
        <a class="my-navbar-item" href="{{ route('products.product-list') }}">商品ページ</a>
        ｜
        <a class="my-navbar-item" href="{{ route('cartitems.cart') }}">ショッピングカート</a>
        ｜
        <a class="my-navbar-item" href="{{ route('profile.edit') }}">マイページ</a>
        ｜
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
          <input type="submit" class="p-0" value="ログアウト">
        </form>
      <div>
    @else
      <div class="my-navbar-control">
        <a class="my-navbar-item" href="{{ route('home') }}">TOP</a>
        ｜
        <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
        ｜
        <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
        <div class="text-end">
          <a href="{{ route('management.order') }}" class="fs-7">管理者ログイン</a>
        </div>
      </div>
    @endif
  </nav>
</header>
<main>
  @yield('content')
</main>
@yield('scripts')
</body>
</html>