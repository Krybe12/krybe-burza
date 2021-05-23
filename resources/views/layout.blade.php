<!DOCTYPE html>
<html lang="en" style="overflow-y: auto">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
  <script src="js/navbar.js"></script>
  <title>Burza | @yield('title')</title>
</head>
<body class="has-background-grey" style="min-height: 100vh;">
  <nav class="navbar is-light" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="">
        <img src="img/burza-icon.png" width="112" height="28">
      </a>
      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
    </a>
    </div>
    
    <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">

      <a class="navbar-item is-tab {{ request()->is('/') ? 'is-active' : ''}}" href="/">Home</a>

      <a class="navbar-item is-tab {{ request()->is('trade') ? 'is-active' : ''}}" href="/trade">Trade</a>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">More</a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="/about">About</a>
          <a class="navbar-item" href="/contact">Contact</a>
          <hr class="navbar-divider">
          <a class="navbar-item" href="/issue">Report an issue</a>
        </div>
      </div>
    </div>

    <div class="navbar-end">
    @guest
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary" href="/register">
            <strong>Sign up</strong>
          </a>
          <a class="button is-light" href="/login">
            Log in
          </a>
        </div>
      </div>
    @else
      <div class="navbar-item">
        <h2>Logged in as {{ Auth::user()->name }}</h2>
      </div>
      <div class="navbar-item">
        <h2>money: {{ Auth::user()->money }}</h2>
      </div>

      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary" href="/profile">
            <strong>Profile</strong>
          </a>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input class="button is-light" type="submit" value="logout">
          </form>
        </div>
      </div>
    @endguest
    </div>

  </nav>
  @yield('content')
</body>
</html>