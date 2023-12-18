<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{{ asset('assets/css/company.css') }}">
  <!-- Add other necessary stylesheets and scripts here -->
</head>
<body>

@extends('Layout/company')


    <!-- @if (!Auth::check())
      <h1>Tak deu</h1>
    @else
    <h1>Welcome, {{ Auth::guard('company')->user()->companyName }} </h1> -->
    
    <div class="layout">
    <div class="card-layout">
    <div class="card">
        <img src="../assets/png/comp.1.png" class="card-img-top" alt="..." style="width: 150px; height: 150px;">
        <div class="card-body">
    <p class="headline">Profil <br>Perusahaan</p>
    <p class="headline-2">Edit Profile</p>
    <button>
    <a href="#">Details</a>
    </button>
      </div>
    </div>

    <div class="card">
        <img src="../assets/png/comp.2.png" class="card-img-top" alt="..." style="width: 150px; height: 150px;">
        <div class="card-body">
    <p class="headline">Lowongan <br>Pekerjaan</p>
    <p class="headline-2">Create Job</p>
    <button>
    <a href="{{ route('job.create',['company' => Auth::guard('company')->user()->id]) }}">Details</a>
    </button>
      </div>
    </div>

    <div class="card">
        <img src="../assets/png/comp.3.png" class="card-img-top" alt="..." style="width: 150px; height: 150px;">
        <div class="card-body">
    <p class="headline">Data Pendaftar Pekerjaan</p>
    <p class="headline-2">List Job</p>
    <button>
    <a href="{{ route('job.index.company') }}" >Details</a>
    </button>
      </div>
    </div>

    </div>
  </div>


    <!-- <div class="card mb-3" style="width: 80rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
    <h5 class="card-title">Profil Perusahaan</h5>
    <p class="card-text">Edit Profile</p>
    <a href="#" class="btn btn-primary">Select</a>
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
    </div> -->
    @endif
