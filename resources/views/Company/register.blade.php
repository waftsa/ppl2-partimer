<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/user.css') }}">
  <!-- Add other necessary stylesheets and scripts here -->
</head>
<body>

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
  <div class="login">
        <div class="right-regis">
          <!-- <div class="bg-fixed" style="background-image: url(../../assets/png/login.png)"></div> -->
          <img src="../../assets/png/login.svg" alt="page">
        </div>
        <div class="left-regis">
          <div class=title>Create Company Account</div>
            <label class="text-left" for="exampleInputEmail1">Email Address</label><br>
            <div class="border-solid">
            <input type="text" class="form-control" name="email" required>
            </div>
            <br>
            <label class="text-left" for="exampleInputEmail1">Company Name</label><br>
            <div class="border-solid">
            <input type="text" class="form-control" name="companyName" required>
            </div>
            <br>
            <label class="text-left" for="exampleInputEmail1">Address</label><br>
            <div class="border-solid">
            <input type="text" class="form-control" name="address" required>
            </div>
            <br>
            <label class="text-left" for="exampleInputPassword1">Password</label><br>
            <div class="border-solid">
            <input type="password" class="form-control" name="password" required>
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
      
          <p>Already have an account? <a href="/company/login" class="link-text">Sign In</a></p>
      </div>
    </div>
</body>
  <!-- <div class="mb-3">
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
    </div> -->
