<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

</head>
<body>

<nav class="navbar">
  <div class="logo">
    <a href="/">
      <img src="../assets/logo/LogoNavbar.png" alt="Logo" />
    </a>
  </div>
  <div class="nav-links">
    <a href="/user/login">Find Job</a>
    <a href="/user/login">Category</a>
    <a href="/user/login">Contact Us</a>
    <a href="/company/register">As Company</a>
  </div>
  <div class="login-button">
    <a href="/user/login">
      <button>Login</button>
    </a>
  </div>
</nav>
</body>

<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">PARTIMER</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link {{ ($title === "Landing Page") ? 'active' : ' ' }}" href="/">Landing Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($title === "Home") ? 'active' : ' ' }}" href="{{ route('user_homepage') }}">Home</a>
            </li>
            @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link {{ ($title === "Login") ? 'active' : ' ' }}" href="/user/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($title === "Register") ? 'active' : ' ' }}" href="/user/register">Register</a>
            </li>
            @endauth -->

        <!-- </ul>
        <span class="navbar-text">
            @auth
            <a class="nav-link" href="{{ route('profile',['user' => auth()->user()->id]) }} "> {{ auth()->user()->name   }} </a> 
            @endauth
        </span>
        </div>
    </div>
    </nav> -->