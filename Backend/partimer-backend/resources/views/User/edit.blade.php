@extends('Layout/layout')

@section('content')
    @auth
        <div class="container">
        <form action="{{ route('profile.update',auth()->id()) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

            <h1>{{ $user->fullName }} </h1>
        </div>
        <div class="row">
            <span class="col-sm-2">
                <label class="form-label">Phone Number</label>
                <input type="text" value="{{ auth()->user()->phoneNum }}" name="phoneNum">
            </span>
            <span class="col-sm-2">
                <label class="form-label">Age</label>
                <input type="number" min="18" step="1" value="{{ auth()->user()->age }}" name="age">
            </span>
        </div>
          
        <div class="row">
            <span class="col-sm-2">
                <label class="form-label">Email</label>
                <input type="text" value="{{ auth()->user()->email }}" name="email">
            </span>
            <span class="col-sm-2">
                <label class="form-label">Education</label>
                <input type="text" value="{{ auth()->user()->education }}" name="edu">
            </span>
        </div>
        <div class="row">
            <span class="col-sm-2">
                <label class="form-label">SocialMedia</label>
                <input type="text" value="{{ auth()->user()->socialMedia }}" name="socMed">
            </span>
            <span class="col-sm-2">
                <label class="form-label">Address</label>
                <input type="text" value="{{ auth()->user()->address }}" name="address">
            </span>

            <div class="form-group mt-2">
                <label for="formFile" class="form-label mt-3">Upload Profile Picture</label>
                <input class="form-control" name="profile_picture" type="file" id="formFile">    
            </div>

            @if(auth()->user()->cv_url == NULL)

            <div class="form-group mt-2">
                <label for="formFile" class="form-label mt-3">Upload CV</label>
                <input class="form-control" name="cv" type="file" id="formFile">    
            </div>

            @endif

        </div>      
        <button type="submit" class="btn btn-primary mt-3">Save</button>  
        <a href="{{ route('profile',auth()->id()) }}" class="btn btn-primary mt-3">Cancel</a>    
        </form>

    @endauth

@endsection