@extends('layouts.app')

@section('title', 'Employee Details')

@section('content')
<div class="container-fluid">
    <h1>Employee Details</h1>
    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $employee->id }}</td></tr>
        <tr><th>Name</th><td>{{ $employee->name }}</td></tr>
        <tr><th>Email</th><td>{{ $employee->email }}</td></tr>
        <tr><th>Mobile</th><td>{{ $employee->mobile_number }}</td></tr>
        <tr><th>Company</th><td>{{ $employee->company ? $employee->company->company_name : '-' }}</td></tr>
        <tr><th>Address</th><td>{{ $employee->address }}</td></tr>
        <tr><th>Status</th><td>{{ $employee->status ? 'Active':'Inactive' }}</td></tr>
    </table>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-2">Back</a>
</div>
@endsection
