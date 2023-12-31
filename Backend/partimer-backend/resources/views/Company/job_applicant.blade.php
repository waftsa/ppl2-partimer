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
    <h1> Applicant </h1>
    <table>
    <tr>
        <td>Name</td>
        <td>Email</td>
        <td>Phone Number</td>
        <td>CV</td>
        <td>Acceptance</td>
    </tr>
    @foreach( $applicant as $applicants )
       @if ($applicants->job_id == $job->id)
    <tr>    
        <td>{{ $applicants->user->name }}</td>
        <td>{{ $applicants->user->email }}</td>
        <td>{{ $applicants->user->phoneNum }}</td>
        <td>
            {{ $applicants->user->CV }}
        </td>
        <td>
        @if ($applicants->status == 'Waiting')
        <form action="{{ route('accepted', ['apply' => $applicants]) }}" method="POST">
            @csrf
            @method('put')
                <button type="submit" class="btn btn-primary mt-2" style="height: 2.3rem; background-color: blue">Accept</button>
        </form>
        <form action="{{ route('declined', ['apply' => $applicants]) }}" method="POST">
            @csrf
            @method('put')
                <button type="submit" class="btn btn-primary mt-2" style="height: 2.3rem; background-color: red">Declined</button>
        </form>
        @else
            {{ $applicants->status}}
        @endif
        </td>   
    </tr>
        @endif
    @endforeach    
</table>
    <a href="{{ route('company_homepage') }}" class="btn btn-primary mt-4">Back</a>

@endsection