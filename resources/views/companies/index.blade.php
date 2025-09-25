@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>Companies</h1>
@stop

@section('content')
    <!-- DataTables CSS CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="mb-3 text-end">
        @if (PermissionHelper::isUserPermittedTo($user, 'create company'))
            <a href="{{ route('companies.create') }}" class="btn btn-primary">Add Company</a>
        @endif
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
                        @if (PermissionHelper::isUserPermittedTo($user, 'edit company'))
                        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endif
                        @if (PermissionHelper::isUserPermittedTo($user, 'delete company'))
                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No companies found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @push('js')
        <!-- jQuery and DataTables JS CDN for fallback -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.table').DataTable();
            });
        </script>
    @endpush
@stop
