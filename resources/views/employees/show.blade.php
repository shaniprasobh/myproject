@extends('adminlte::page')

@section('title', 'View Employee')

@section('content_header')
<h1>View Employee</h1>
@stop

@section('content')
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td>{{ $employee->id }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ $employee->name }}</td>
    </tr>
    <tr>
        <th>Designation</th>
        <td>{{ $employee->designation }}</td>
    </tr>
    <tr>
        <th>Company</th>
        <td>{{ $employee->company ? $employee->company->company_name : '-' }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $employee->email }}</td>
    </tr>
    <tr>
        <th>Mobile</th>
        <td>{{ $employee->mobile_number }}</td>
    </tr>
    <tr>
        <th>Role(s)</th>
        <td>
            @if($employee->user)
                {{ implode(', ', $employee->user->getRoleNames()->toArray()) }}
            @else
                -
            @endif
        </td>
    </tr>
</table>
<a href="{{ route('employees.index') }}" class="btn btn-primary">Back</a>
@stop