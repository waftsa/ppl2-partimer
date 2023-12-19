@extends('Layout/layout')

@section('content')
    @if (!Auth::check())
      <h1>Tak deu</h1>
    @else
    <h1>Welcome, {{ Auth::guard('company')->user()->companyName }} </h1>
    
    <div class="card mb-3" style="width: 80rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
    <h5 class="card-title">Profil Perusahaan</h5>
    <p class="card-text">Edit Profile</p>
    <a href="{{ route('profile_company',['user' => auth()->user()->id]) }} " class="btn btn-primary" > Select </a> 
  </div>
    </div>
    <div class="card mb-3" style="width: 80rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Lowongan Pekerjaan</h5>
    <p class="card-text">Create Job </p>
    <a href="{{ route('job.create',['company' => Auth::guard('company')->user()->id]) }}" class="btn btn-primary">Select</a>
  </div>
    </div>
    <div class="card mb-3" style="width: 80rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Data Pendaftaran</h5>
    <p class="card-text">List Job</p>
    <a href="{{ route('job.index.company') }}" class="btn btn-primary">Select</a>
  </div>
    </div>
    @endif
@endsection