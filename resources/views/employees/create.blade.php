@extends('adminlte::page')

@section('title', 'Add Employee')

@section('content_header')
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-user-plus"></i> Add Employee</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-phone"></i> Mobile Number</label>
                            <input type="text" name="mobile_number" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-building"></i> Company</label>
                            <select name="company_id" class="form-control">
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($currentRole === 'Super Admin' || $currentRole === 'super admin')
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-user-tag"></i> Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="Manager">Manager</option>
                                    <option value="Employee">Employee</option>
                                </select>
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="role" value="Employee">
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-map-marker-alt"></i> Address</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="fas fa-plus"></i> Create Employee</button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-3 ms-2"><i
                        class="fas fa-arrow-left"></i> Back</a>
            </form>
        </div>
    </div>
@endsection
