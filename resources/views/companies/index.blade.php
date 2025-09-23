@extends('adminlte::page')

@section('title', 'Add Company')

@section('content_header')
<h1>Add Company</h1>
@stop

@section('content')

<h2>Companies List</h2>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->company_name }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->mobile_number }}</td>
                <td>{{ $company->address }}</td>
                <td>
                    <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No companies found.</td></tr>
        @endforelse
    </tbody>
</table>

<hr>

<div class="mb-3">
    <a href="{{ route('companies.create') }}" class="btn btn-success">Add Company</a>
</div>
@stop