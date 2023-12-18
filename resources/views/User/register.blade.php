<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/user.css') }}">
  <!-- Add other necessary stylesheets and scripts here -->
</head>
<body>

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
  <div class="login">
        <div class="right-regis">
          <!-- <div class="bg-fixed" style="background-image: url(../../assets/png/login.png)"></div> -->
          <img src="../../assets/png/login.svg" alt="page">
        </div>
        <div class="left-regis">
          <div class=title>Create Account</div>
            <label class="text-left" for="exampleInputEmail1">Full Name</label><br>
            <div class="border-solid">
            <input type="text" class="form-control" name="fullName" required>
            </div>
            <br>
            <label class="text-left" for="exampleInputEmail1">Phone Number</label><br>
            <div class="border-solid">
            <input type="text" class="form-control" name="phoneNum" required>
            </div>
            <br>
            <label class="text-left" for="exampleInputEmail1">Email Address</label><br>
            <div class="border-solid">
            <input type="text" class="form-control" name="email" required>
            </div>
            <br>
            <label class="text-left" for="exampleInputPassword1">Password</label><br>
            <div class="border-solid">
            <input type="password" class="form-control" name="password" required>
            <div id="pwRule" class="form-text" style="color: #171717; font-size: 10px;">
              Must be at least 10 characters, 
              Must contain at least one lowercase letter,
              Must contain at least one uppercase letter,
              Must contain at least one digit
              Must contain a special character
            </div>
            </div>
            <br>
            <label class="text-left" for="exampleInputPassword1">Confirm Password</label><br>
            <div class="border-solid">
            <input type="password" class="form-control" name="password_confirm" required>
            </div>
            <br><br>
            
            <div class="button-login">
            <button type="submit">Sign Up</button>
            </div>
          </form>
          <br>
          <div class="button-google">
            <button type="button" @click="signupWithGoogle">Login with Google</button>
          </div>
      
          <p>Already have an account? <a href="/user/login" class="link-text">Sign In</a></p>
      </div>
    </div>
  <!-- <div class="mb-3">
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
    </div> -->
