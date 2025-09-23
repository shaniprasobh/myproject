@extends('adminlte::page')

@section('title', 'Edit Employee')

@section('content_header')
<h1>Edit Employee</h1>
@stop

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
</div>
@endif

@if($companies->isEmpty())
    <div class="alert alert-warning">No companies found. Please add a company before editing an employee.</div>
@else
<form action="{{ route('employees.update', $employee->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
    </div>
    <div class="form-group">
        <label>Company</label>
        <select name="company_id" class="form-control">
            <option value="">Select Company</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ old('company_id', $employee->company_id) == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}">
    </div>
    <div class="form-group">
        <label>Mobile Number</label>
        <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $employee->mobile_number) }}">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endif
@stop