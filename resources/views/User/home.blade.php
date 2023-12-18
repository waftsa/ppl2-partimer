@extends('Layout/user')

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
    <h1>Hello , {{ auth()->user()->name }}</h1>
    <h2>Pekerjaanmu</h2>
    {{ $accept }}
    <h2>Waiting List</h2>
    <table>
        <tr>
            <td> Job Name </td>
            <td> Company </td>
            <td> Category </td>
            <td> Status </td>
        </tr>
    @foreach ($applicant as $applicants)
        @if ($applicants->user_id == auth()->user()->id)
        <tr>
            <td> {{ $applicants->jobs->jobName }} </td>
            <td> {{ $applicants->jobs->company->companyName }} </td>
            <td> {{ $applicants->jobs->Category }} </td>
            <td> {{ $applicants->status }} </td>
        </tr>
        @else
            <h3> Havent Apply To any Jobs Avail </h3>
        @endif
    @endforeach
    </table>
    
@endsection