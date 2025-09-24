@extends('adminlte::page')

@section('title', 'Edit Employee')

@section('content_header')
    <h1>Edit Employee</h1>
@endsection

@section('content')
    <a href="{{ route('employees.index') }}" class="btn btn-secondary mb-2">Back</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
        </div>
        <div class="form-group">
            <label>Company</label>
            <select name="company_id" class="form-control">
                <option value="">Select Company</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" @if($employee->company_id == $company->id) selected @endif>{{ $company->company_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Mobile Number</label>
            <input type="text" name="mobile_number" class="form-control" value="{{ $employee->mobile_number }}">
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control">{{ $employee->address }}</textarea>
        </div>
        <hr>
        <h4>Change Password (optional)</h4>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password" class="form-control" autocomplete="new-password">
        </div>
        <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-success mt-2">Update</button>
    </form>
@endsection
