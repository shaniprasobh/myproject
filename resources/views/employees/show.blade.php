@extends('adminlte::page')

@section('title', 'Employee Details')

@section('content_header')
@endsection

@section('content')
    <div class="card shadow-lg border-0" style="background: #f8fafc;">
        <div class="card-header bg-gradient-primary text-white rounded-top">
            <h3 class="mb-0"><i class="fas fa-user fa-lg me-2"></i>Employee Details</h3>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <div style="max-width: 500px; width: 100%;">
                    <ul class="list-group list-group-flush mb-4 text-start">
                        <li class="list-group-item bg-transparent border-0"><strong><i
                                    class="fas fa-user fa-fw me-2 text-primary"></i>Name:</strong> <span
                                class="ms-2">{{ $employee->name }}</span></li>
                        <li class="list-group-item bg-transparent border-0"><strong><i
                                    class="fas fa-envelope fa-fw me-2 text-primary"></i>Email:</strong> <span
                                class="ms-2">{{ $employee->email }}</span></li>
                        <li class="list-group-item bg-transparent border-0"><strong><i
                                    class="fas fa-building fa-fw me-2 text-primary"></i>Company:</strong> <span
                                class="ms-2">{{ $employee->company->company_name ?? '-' }}</span></li>
                        <li class="list-group-item bg-transparent border-0"><strong><i
                                    class="fas fa-phone fa-fw me-2 text-primary"></i>Mobile Number:</strong> <span
                                class="ms-2">{{ $employee->mobile_number }}</span></li>
                        <li class="list-group-item bg-transparent border-0"><strong><i
                                    class="fas fa-map-marker-alt fa-fw me-2 text-primary"></i>Address:</strong> <span
                                class="ms-2">{{ $employee->address }}</span></li>
                    </ul>
                    <div class="text-end">
                        <a href="{{ route('employees.index') }}" class="btn btn-outline-primary mt-2"><i
                                class="fas fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
