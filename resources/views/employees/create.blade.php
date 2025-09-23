@extends('adminlte::page')

@section('title', 'Add Employee')

@section('content_header')
<h1>Add Employee</h1>
@stop

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
</div>
@endif

<form action="{{ route('employees.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>
    <div class="form-group">
        <label>Designation</label>
        <input type="text" name="designation" class="form-control" value="{{ old('designation') }}">
    </div>
    <div class="form-group">
        <label>Company</label>
        <select name="company_id" class="form-control">
            <option value="">Select Company</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
    </div>
    <div class="form-group">
        <label>Mobile Number</label>
        <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}">
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@stop