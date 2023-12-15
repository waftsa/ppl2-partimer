@extends('Layout/layout')

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
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
    </tr>
    @foreach($company as $company)
        @if($company->verified == 0)
    <tr>    
        <td>{{ $company->companyName }}</td>
        <td>{{ $company->email }}</td>
        <td>{{ $company->phoneNum }}</td>
    </tr>
        @else
        <p> No Request </p>
        @endif
    @endforeach
</table>
    <h1 class="mt-5">Job Waiting List</h1>
@endsection