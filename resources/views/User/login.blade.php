<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/user.css') }}">
  <!-- Add other necessary stylesheets and scripts here -->
</head>
<body>

    @if (!Auth::check())
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
        <div class="login">
        <div class="right-login">
          <img src="../../assets/png/login.png" alt="page">
        </div>
        <div class="left-login">
          <div class=title>Login Account</div>
          <!-- <form @submit.prevent="submitForm"> -->
            <label class="text-left" for="exampleInputEmail1">Email</label><br>
            <div class="border-solid">
            <input type="email" v-model="email" class="form-control" name="email" aria-describedby="emailHelp" required>
            </div>
            <br>
            <label class="text-left" for="exampleInputPassword1">Password</label><br>
            <div class="border-solid">
            <input type="password" class="form-control" name="password" required>
            </div>
            <div class="align-right">
            <p class="link-text">Forgot Password?</p>
            </div>
            <br>
            
            <div class="button-login">
            <button type="submit">Login</button>
            </div>
          </form>
          <br>
          <div class="button-google">
            <button type="button" @click="loginWithGoogle">Login with Google</button>
          </div>
      
          <p>Don't have an account? <a href="/user/register" class="link-text">Sign Up</a></p>
      </div>
    </div>
    <!-- <div class="mb-3">
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
</form> -->
  
    @else
    
    @endif

</body>