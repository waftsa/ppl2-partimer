@extends('Layout/layout')

@section('content')
    <div class="container">
    @if (!Auth::check())
    <h1>Login</h1>
    <form action="{{route('login.post')}}" method="POST">  
        @csrf
    
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="mb-3 form-check">
    <a class="nav-link" href="{{ route('register') }}">Create account</a>
    </div>
    <div class="mb-3">
    <a class="nav-link" href="{{ route('company_login') }}">Company</a>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

    <div>
    <a href="{{ route('login_google') }}" class="btn btn-primary mt-5" style="width: 10rem">Login With Google</a>    
    </div>
</form>
    </div>
    @else
    
    @endif
@endsection