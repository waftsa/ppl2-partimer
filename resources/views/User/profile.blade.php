@extends('Layout/user')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/user.css') }}">
  <!-- Add other necessary stylesheets and scripts here -->
</head>
<body>



    @auth
        <div class="container" display="inline">
        
        <div class="row">
            <span class="col-sm-2">
                <div class="div">
                @if (Auth::user()->image != NULL)
                    <img width="100" height="100" src="{{asset('storage/image_user/'.Auth::user()->image)}}" />
                @else
                    <h3>You Havent Set your Profile Picture </h3>
                @endif
                </div>               
            </span>
            <span class="col-sm-2">
            <h1>{{ auth()->user()->name }} </h1>
            </span>
        </div>
        <div class="row">
            <span class="col-sm-2">
                <label class="form-label">Phone Number</label>
                <input type="text" value="{{ auth()->user()->phoneNum }}" name="phoneNum" disabled>
            </span>
            <span class="col-sm-2">
                <label class="form-label">Age</label>
                <input type="text" value="{{ auth()->user()->age }} years old" name="age" disabled>
            </span>
        </div>
          
        <div class="row">
            <span class="col-sm-2">
                <label class="form-label">Email</label>
                <input type="text" value="{{ auth()->user()->email }}" name="email" disabled>
            </span>
            <span class="col-sm-2">
                <label class="form-label">Education</label>
                <input type="text" value="{{ auth()->user()->education }}" name="edu" disabled>
            </span>
        </div>
        <div class="row">
            <span class="col-sm-2">
                <label class="form-label">SocialMedia</label>
                <input type="text" value="{{ auth()->user()->socialMedia }}" name="socMed" disabled>
            </span>
            <span class="col-sm-2">
                <label class="form-label">Address</label>
                <input type="text" value="{{ auth()->user()->address }}" name="address" disabled>
            </span>
        </div>

        @if (auth()->user()->cv_url != NULL)
        <div class="mt-3">
            <a href="{{ asset('storage/cv_user/'.Auth::user()->cv_url) }}"> Download CV </a>
        </div>
        @else
        <p class="mt-3">Upload Your CV on Edit</p>
        @endif

            <a href="{{ route('profile.edit', auth()->id())}}" class="btn btn-primary mt-3" style="width: 10rem">Edit</a>
        </div>
    @endauth

