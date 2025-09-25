@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>Companies</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="mb-3 text-end">
        <a href="{{ route('companies.create') }}" class="btn btn-primary">Add Company</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>GST Number</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $company->company_name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->mobile_number }}</td>
                    <td>{{ $company->gst_number ?? '-' }}</td>
                    <td>{{ $company->address }}</td>
                    <td>
                        <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info btn-sm" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No companies found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop
