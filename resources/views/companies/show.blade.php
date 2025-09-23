@extends('adminlte::page')

@section('title', 'Edit Company')

@section('content_header')
<h1>Edit Company</h1>
@stop

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
</div>
@endif

<form action="{{ route('companies.update', $company->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Company Name</label>
        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $company->company_name) }}" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}">
    </div>
    <div class="form-group">
        <label>Mobile Number</label>
        <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $company->mobile_number) }}">
    </div>
    <div class="form-group">
        <label>Address</label>
        <textarea name="address" class="form-control">{{ old('address', $company->address) }}</textarea>
    </div>
    <a href="{{ route('companies.index') }}" class="btn btn-primary">Back</a>
</form>
@stop