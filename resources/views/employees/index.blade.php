@extends('layouts.app')

@section('title', 'Employees')

@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
<h1>Employees</h1>
@stop

@section('content')

<h2>Employees List</h2>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Company</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->company?->company_name ?? '-' }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->mobile_number }}</td>
                <td>
                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No employees found.</td></tr>
        @endforelse
    </tbody>
</table>

<hr>

<div class="mb-3">
    <a href="{{ route('employees.create') }}" class="btn btn-success">Add Employee</a>
</div>
@stop