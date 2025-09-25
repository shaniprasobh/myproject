@extends('adminlte::page')

@section('title', 'Add Employee')

@section('content_header')
    <h1>Add Employee</h1>
@endsection

@section('content')
    <a href="{{ route('employees.index') }}" class="btn btn-secondary mb-2">Back</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Company</label>
            <select name="company_id" class="form-control">
                <option value="">Select Company</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
        </div>
        @if($currentRole === 'Super Admin' || $currentRole === 'super admin')
            <div class="form-group">
                <label>Roles</label>
                <select name="role" class="form-control" required>
                    <option value="Manager">Manager</option>
                    <option value="Employee">Employee</option>
                </select>
            </div>
        @else
            <input type="hidden" name="role" value="Employee">
        @endif
        <div class="form-group">
            <label>Mobile Number</label>
            <input type="text" name="mobile_number" class="form-control">
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-2">Create</button>
    </form>
@endsection
