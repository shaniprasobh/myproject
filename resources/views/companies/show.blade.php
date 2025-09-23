@extends('adminlte::page')

@section('title', 'View Company')

@section('content_header')
<h1>View Company</h1>
@stop

@section('content')
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td>{{ $company->id }}</td>
    </tr>
    <tr>
        <th>Company Name</th>
        <td>{{ $company->company_name }}</td>
    </tr>
    <tr>
        <th>GST Number</th>
        <td>{{ $company->gst_number }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $company->email }}</td>
    </tr>
    <tr>
        <th>Mobile Number</th>
        <td>{{ $company->mobile_number }}</td>
    </tr>
    <tr>
        <th>Address</th>
        <td>{{ $company->address }}</td>
    </tr>
</table>
<a href="{{ route('companies.index') }}" class="btn btn-primary">Back</a>
@stop