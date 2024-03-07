<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.101.0">
  <link rel="shortcut icon" href="/img/cn.png" type="image/x-icon">
  <title>Login</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

  <form class="form-signin" method="POST" action="{{ route('login') }}">
    @csrf
    <img class="mb-4" src="/img/cn.png" alt="" width="150" height="130">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    @if ($errors->has('LoginFailed'))
    <div class="alert alert-danger alert-dismissible fade show mx-auto" role="alert" style="max-width: 400px;">
      {{ $errors->first('LoginFailed') }}
    </div>
    @endif
    <label for="username" class="sr-only">Username</label>
    <input type="text" id="username" class="form-control mb-1" placeholder="Username" name="username" required
      autofocus>
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" class="form-control" placeholder="Password" required name="password">
    <div class="checkbox mb-3">
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-4">Belum punya akun? <a href="https://wa.me/6281212677075" target="_blank">Hubungi Administrator</a>
    </p>
    <p class="mt-5 mb-3 text-muted">&copy;<a href="https://instagram.com/syah_zaky">ZakySyahrul</a>{{ date('Y') }}</p>
  </form>

</body>

</html>