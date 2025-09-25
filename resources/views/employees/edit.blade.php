@extends('adminlte::page')

@section('title', 'Edit Employee')

@section('content_header')
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-user-edit"></i> Edit Employee</h4>
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
            <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"><i class="fas fa-user"></i> Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $employee->user->name) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $employee->user->email) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="designation"><i class="fas fa-briefcase"></i> Designation</label>
                            <input type="text" name="designation" class="form-control"
                                value="{{ old('designation', $employee->designation) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile_number"><i class="fas fa-phone"></i> Mobile</label>
                            <input type="text" name="mobile_number" class="form-control"
                                value="{{ old('mobile_number', $employee->mobile_number) }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                            <textarea name="address" class="form-control">{{ old('address', $employee->address) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_id"><i class="fas fa-building"></i> Company</label>
                            <select name="company_id" class="form-control" required>
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ old('company_id', $employee->company_id) == $company->id ? 'selected' : '' }}>
                                        {{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role"><i class="fas fa-user-tag"></i> Role</label>
                            <select name="role" class="form-control" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}"
                                        {{ old('role', $employee->user->getRoleNames()->first()) == $role ? 'selected' : '' }}>
                                        {{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password"><i class="fas fa-key"></i> New Password <small>(leave blank to keep
                                    current)</small></label>
                            <input type="password" name="password" class="form-control" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation"><i class="fas fa-key"></i> Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                autocomplete="new-password">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="fas fa-save"></i> Update Employee</button>
            </form>
        </div>
    </div>
@stop
