@extends('Layout/layout')

@section('content')
<div class="container">
    <form action="{{route('register.post')}}" method="POST">
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
    <label for="exampleInputEmail1" class="form-label">Full Name</label>
    <input type="text" class="form-control" name="fullName" aria-describedby="fnHelp">
    <div id="fnHelp" class="form-text">You can change this later</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
    <input type="text" class="form-control" name="phoneNum" aria-describedby="fnHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
    <div id="pwRule" class="form-text">
      Must be at least 10 characters, 
      Must contain at least one lowercase letter,
      Must contain at least one uppercase letter,
      Must contain at least one digit
      Must contain a special character
    </div>

  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name="password_confirm">
  </div>
  <div class="mb-3 form-check">
    <a class="nav-link" href="{{ route('login') }}">Already Have Account? Login</a>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
@endsection