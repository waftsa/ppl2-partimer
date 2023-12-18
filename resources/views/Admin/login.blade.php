@extends('Layout/layout')

@section('content')
    <div class="container">
    @if (!Auth::check())
    <h1>Login</h1>
    <form action="{{ route('admin_login.post') }}" method="POST">  
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
        <label for="exampleInputEmail1" class="form-label">name</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
    @else
    
    @endif
@endsection