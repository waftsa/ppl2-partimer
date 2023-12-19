@extends('Layout/layout')

@section('content')
    @auth
        <div class="container">
        <form action="{{ route('company_profile.update',auth()->id()) }}" method="POST" enctype="multipart/form-data">
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

            <h1>{{ $user->companyName }} </h1>
        </div>
        <div class="row">
            <span class="col-sm-2">
                <label class="form-label">Email</label>
                <input type="text" value="{{ auth()->user()->email }}" name="email">
            </span>
            <span class="col-sm-2">
                <label class="form-label">Telephone</label>
                <input type="text" value="{{ auth()->user()->phoneNum }}" name="phoneNum">
            </span>
        </div>
          
        <div class="row">
            <span class="col-sm-2">
                <label class="form-label">Address</label>
                <input type="text" value="{{ auth()->user()->address }}" name="address">
            </span>
        </div>
            <label class="form-label mt-4">Description</label>
            <div class="mt-2">
                <textarea type="text" value="{{ auth()->user()->description }}" name="description">
                {{ auth()->user()->description }}
                </textarea>
            </div>
            <div class="form-group mt-2">
                <label for="formFile" class="form-label mt-3">Upload Profile Picture</label>
                <input class="form-control" name="profile_picture" type="file" id="formFile">    
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save</button>  
        <a href="{{ route('profile_company',auth()->id()) }}" class="btn btn-primary mt-3">Cancel</a> 
        </div>
           
        </form>

    @endauth

@endsection