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
  <nav class="my-navbar mb-5">
    <div class="my-navbar-group">
      <p class="admin-navbar-brand mb-0">codelab shopping</p>
    </div>
  </nav>
</header>
<main>
  @yield('content')
</main>
@yield('scripts')
</body>
</html>