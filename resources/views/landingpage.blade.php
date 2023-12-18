@extends('Layout/layout')

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
</head>
<body>

<div class="sec1">
  <div class="right">
    <img src="{{ asset('../assets/png/landing1.png') }}" alt="gambar" />
  </div>
  <div class="left">
    <p class="headline">Want to <span class="purple-text">get a job</span>?</p>
    <p>We are committed to connect job seekers with employers. 
      <br>Join us and find your next <span class="purple-text">Part Time</span> job.</p>
    <div class="button-getstarted">
      <button type="button" onclick="signup()">Get Started</button>
    </div>
  </div>
</div>

<div class="sec2">
  <p class="headline"><span class="purple-text">Partimer </span>Already Help Connect</p>
  <div class="container">
    <table>
      <thead>
        <tr>
          <th>
            <p>Pencari Kerja</p><br>
            <div class="number">450</div>
          </th>
          <th>
            <p>Lowongan Pekerjaan</p><br>
            <div class="number">500</div>
          </th>
          <th>
            <p>Perusahaan</p><br>
            <div class="number">300</div>
          </th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<div class="sec3">
  <img src="../assets/png/sec3.png" alt="bg">
</div>

<div class="sec4">
  <div class="headline">Popular Job <span class="purple-text">Categories</span></div>
  <table>
    <tr> <!-- categori TI -->
      <td>
        <div class="category-landing">
          <img src="../assets/png/sec4.1.png" alt="TI" style="height: 125px; width: 125px;">
          <p>IT</p>
        </div>
      </td>
      <td>
        <br>
        <div class="category-landing">
          <img src="../assets/png/sec4.2.png" alt="Sales" style="height: 125px; width: 125px;">
          <p>Sales</p>
        </div>
      </td>
    </tr>
    <tr> 
    </tr>
    <tr>
      <td>
        <div class="category-landing">
          <img src="../assets/png/sec4.3.png" alt="Business" style="height: 125px; width: 125px;">
          <p>Business</p>
        </div>
      </td>
      <td>
        <div class="category-landing">
          <img src='../assets/png/sec4.4.png' alt="Design" style="height: 125px; width: 125px;">
          <p>Design</p>
        </div>
      </td>
    </tr>
  </table>
</div>
</div>
@include('footer')
</body>

<script>
  function signup() {
    // Add code for signup functionality
    // Redirect or perform other actions as needed
    window.location.href = '/user/register';
  }
</script>

</html>