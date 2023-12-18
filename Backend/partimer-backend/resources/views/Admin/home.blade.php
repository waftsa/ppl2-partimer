@extends('Layout/layout')

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 2px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

@section('content')
    <h1>Unverified Company</h1>
<table>
    <tr>
        <td>Name</td>
        <td>Email</td>
        <td>Phone Number</td>
        <td>Status</td>
    </tr>
    @foreach($company as $company)
        @if($company->verified == 0)
    <tr>    
        <td>{{ $company->companyName }}</td>
        <td>{{ $company->email }}</td>
        <td>{{ $company->phoneNum }}</td>
        <td>
            <form action="{{ route('admin.verif',['company' => $company]) }}" method="POST">
            @csrf
            @method('put')
                <button type="submit" class="btn btn-primary mt-3" style="height: 2.3rem; background-color: blue">Verified</button>
            </form>
        </td>
        <td>
            <a href="" class="btn btn-primary" style="height: 2.3rem; background-color: red">Decline</a>   
        </td>
    </tr>
        @else
        @endif
    @endforeach
</table>

    <h1 class="mt-5">Job Waiting List</h1>
<table>
    <tr>
        <td>Company</td>
        <td>Job Name</td>
        <td>Category</td>
        <td>Approval</td>
    </tr>
    @foreach($jobs as $job)
        @if($job->approved == 0)
    <tr>    
        <td>{{ $job->company->companyName }}</td>
        <td>{{ $job->jobName }}</td>
        <td>{{ $job->Category }}</td>
        <td>
            <form action="{{ route('admin.allow',['job' => $job]) }}" method="POST">
            @csrf
            @method('put')
                <button type="submit" class="btn btn-primary mt-3" style="height: 2.3rem; background-color: blue">Allow</button>
            </form>
        </td>
        <td>
            <a href="" class="btn btn-primary" style="height: 2.3rem; background-color: red">Denied</a>   
        </td>
    </tr>
        @else
        <!--<p> No Request </p> -->
        @endif
    @endforeach
</table>
@endsection