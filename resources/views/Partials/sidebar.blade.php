<!-- <style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #3f3f3f;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #555;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #d2d5d6;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
</style>

<div class="sidebar">
  <a class="active" href="{{ route('user_homepage') }}">Home</a>
  @auth
  <a href="{{ route('job.index') }}">Job</a>
  <a href="{{ route('profile',auth()->id()) }}">Profile</a>
  <a href="/contact_us">Contact Us</a>
  <a href="/about_us">About Us</a>
  @endauth
</div> -->