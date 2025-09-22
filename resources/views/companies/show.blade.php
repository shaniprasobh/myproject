@extends('layouts.app')

@section('title', 'Company Details')

@section('content')
<div class="container-fluid">
    <h1>Company Details</h1>
    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $company->id }}</td></tr>
        <tr><th>Name</th><td>{{ $company->company_name }}</td></tr>
        <tr><th>Email</th><td>{{ $company->email }}</td></tr>
        <tr><th>Mobile</th><td>{{ $company->mobile_number }}</td></tr>
        <tr><th>Address</th><td>{{ $company->address }}</td></tr>
    </table>
    <a href="{{ route('companies.index') }}" class="btn btn-secondary mt-2">Back</a>
</div>
@endsection
