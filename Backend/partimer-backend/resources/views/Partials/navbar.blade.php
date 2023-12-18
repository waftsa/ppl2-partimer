<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
            @endauth



            
            <!--
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            -->
        </ul>
        <span class="navbar-text">
            @auth
            <a class="nav-link" href="{{ route('profile',['user' => auth()->user()->id]) }} "> {{ auth()->user()->name   }} </a> 
            @endauth
        </span>
        </div>
    </div>
    </nav>