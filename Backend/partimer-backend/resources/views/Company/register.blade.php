@extends('Layout/layout')

@section('content')
<div class="container">
    <form action="{{route('company_register.post')}}" method="POST">
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
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" aria-describedby="fnHelp">
    <div id="fnHelp" class="form-text">You can change this later</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Company Name</label>
    <input type="text" class="form-control" name="companyName" aria-describedby="fnHelp">
    <div id="fnHelp" class="form-text">You can change this later</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Address</label>
    <input type="text" class="form-control" name="address">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name="password_confirm">
  </div>
  <div class="mb-3 form-check">
    <a class="nav-link" href="/company/login">Already Have Account? Login</a>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
@endsection