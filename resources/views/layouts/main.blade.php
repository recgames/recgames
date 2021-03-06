<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @stack('head')

  <title>@yield('title') · recgam.es</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
</head>
<body class="nojs">
  {{-- UI State --}}
  <input id="s-menu-open" type="checkbox" class="is-hidden" name="{{ uniqid() }}">

  <nav class="navbar is-danger has-shadow" role="navigation">
    <div class="container">
      <div class="navbar-brand">
        <a href="{{ url('/') }}" class="navbar-item">
          recgam.es
        </a>

        <label class="navbar-burger" for="s-menu-open">
          <span></span>
          <span></span>
          <span></span>
        </label>
      </div>

      <div class="navbar-menu">
        <div class="navbar-start">
          <a class="navbar-item" href="{{ action('GamesController@list') }}">Games</a>
          <a class="navbar-item" href="{{ action('SetsController@list') }}">Sets</a>
        </div>
        <div class="navbar-end">
          @if (Auth::check())
            <a class="navbar-item" href="{{ action('ProfileController@showSelf') }}">
              {{ Auth::user()->name }}
            </a>
          @else
            <a class="navbar-item" href="{{ route('login') }}">Log in</a>
            <a class="navbar-item" href="{{ route('register') }}">Create Account</a>
          @endif
          <span class="navbar-item">
            <a class="button is-primary" href="{{ action('GamesController@upload') }}">
              <span>Upload</span>
            </a>
          </span>
        </div>
      </div>
    </div>
  </nav>

  @yield('content')

  <footer class="footer">
    <div class="container">
      <p class="has-text-centered">
        recgam.es · <a href="https://github.com/goto-bus-stop/recgames">github</a>
      </p>
      <p class="has-text-centered">
        Support recgam.es hosting and development by <a href="https://paypal.me/recgames">making a donation</a>!
      </p>
    </div>
  </footer>

  @include('components.api_urls')
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
