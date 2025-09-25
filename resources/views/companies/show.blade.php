@extends('adminlte::page')

@section('title', 'View Company')

@section('content_header')
@stop

@section('content')
    <div class="card shadow-lg border-0" style="background: #f8fafc;">
        <div class="card-header bg-gradient-primary text-white rounded-top">
            <h3 class="mb-0"><i class="fas fa-building fa-lg me-2"></i>Company Details</h3>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <div style="max-width: 500px; width: 100%;">
                    <ul class="list-group list-group-flush mb-4 text-start">
                        <li class="list-group-item bg-transparent border-0"><strong><i
                                    class="fas fa-building fa-fw me-2 text-primary"></i>Company Name:</strong> <span
                                class="ms-2">{{ $company->company_name }}</span></li>
                        <li class="list-group-item bg-transparent border-0"><strong><i
                                    class="fas fa-receipt fa-fw me-2 text-primary"></i>GST Number:</strong> <span
                                class="ms-2">{{ $company->gst_number }}</span></li>
                        <li class="list-group-item bg-transparent border-0"><strong><i
                                    class="fas fa-envelope fa-fw me-2 text-primary"></i>Email:</strong> <span
                                class="ms-2">{{ $company->email }}</span></li>
                        <li class="list-group-item bg-transparent border-0"><strong><i
                                    class="fas fa-phone fa-fw me-2 text-primary"></i>Mobile Number:</strong> <span
                                class="ms-2">{{ $company->mobile_number }}</span></li>
                        <li class="list-group-item bg-transparent border-0"><strong><i
                                    class="fas fa-map-marker-alt fa-fw me-2 text-primary"></i>Address:</strong> <span
                                class="ms-2">{{ $company->address }}</span></li>
                    </ul>
                    <div class="text-end">
                        <a href="{{ route('companies.index') }}" class="btn btn-outline-primary mt-2"><i
                                class="fas fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
