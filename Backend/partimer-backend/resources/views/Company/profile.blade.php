@extends('Layout/layout')

@section('content')
    @auth
        <div class="container" display="inline">
        
        <div class="row">
            <span class="col-sm-2">
                <div class="div">
                @if (Auth::user()->icon_url != NULL)
                    <img width="100" height="100" src="{{asset('storage/image_user/'.Auth::user()->icon_url)}}" />
                @else
                    <h3>You Havent Set your Profile Picture </h3>
                @endif
                </div>               
            </span>
            <span class="col-sm-2">
            <h1>{{ auth()->user()->companyName }} </h1>
            </span>
        </div>
        <div class="row">
            <span class="col-sm-2">
                <label class="form-label">Alamat</label>
                <input type="text" value="{{ auth()->user()->address }} " name="phoneNum" disabled>
            </span>
            <span class="col-sm-2">
                <label class="form-label">Telephone</label>
                <input type="text" value="{{ auth()->user()->phoneNum }}" name="age" disabled>
            </span>
        </div>
          
        <div class="mt-5">
            <h2>About {{ auth()->user()->companyName }}
        </div>
        <div class="mt-2">
            <textarea value="{{ auth()->user()->description }}"> {{ auth()->user()->description }} </textarea>
        </div>

            <a href="{{ route('company_profile.edit', auth()->id())}}" class="btn btn-primary mt-3" style="width: 10rem">Edit</a>
            <a href="{{ route('company_homepage') }}" class="btn btn-primary mt-3">Cancel</a> 

        </div>
    @endauth

@endsection