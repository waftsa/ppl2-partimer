@extends('Layout/layout')

@section('content')
    <h1>Job List</h1>
    <div class="container">
        @foreach($jobs as $job)   
        <div class="card-body " style="width: 40rem; height: 10rem"> 
            <div class="card mb-3" >   
                <img src="company_icon/Kaltsit_first.jpg" width="100" height="100" alt="Kaltsit"/>
                <h1 class="card-title">{{ $job->jobName }}</h1>
                <h1 class="card-title">{{ $job->company->companyName }}</h1>
                <h2 class="card-text">{{ $job->Category }}</h2>
                <p class="card-text">{{ $job->Salary }}</p>
                <p class="card-text">{{ $job->jobDesc }}</p>
                <p class="card-text">{{ $job->requirement }}</p>
                
                <div>
                <a href="#" class="btn btn-primary" style="width: 10rem">Apply</a>
            </div>
        @endforeach      
        </div>
    </div>
@endsection