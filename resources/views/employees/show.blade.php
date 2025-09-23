@extends('adminlte::page')

@section('title', 'Employee Details')

@section('content_header')
    <h1>Employee Details</h1>
@endsection

@section('content')
    <a href="{{ route('employees.index') }}" class="btn btn-secondary mb-2">Back</a>

    <table class="table table-bordered">
        <tr><th>Name</th><td>{{ $employee->name }}</td></tr>
        <tr><th>Email</th><td>{{ $employee->email }}</td></tr>
        <tr><th>Company</th><td>{{ $employee->company->company_name ?? '-' }}</td></tr>
        <tr><th>Mobile Number</th><td>{{ $employee->mobile_number }}</td></tr>
        <tr><th>Address</th><td>{{ $employee->address }}</td></tr>
    </table>
@endsection
