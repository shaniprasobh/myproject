@extends('adminlte::page')

@section('title', 'Add Company')

@section('content_header')
<h1>Add Company</h1>
@stop

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
</div>
@endif

<form action="{{ route('companies.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Company Name</label>
        <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
    </div>
    <div class="form-group">
        <label>Mobile Number</label>
        <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}">
    </div>
    <div class="form-group">
        <label>GST Number</label>
        <input type="text" name="gst_number" class="form-control" value="{{ old('gst_number') }}">
    </div>
    <div class="form-group">
        <label>Address</label>
        <textarea name="address" class="form-control">{{ old('address') }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@stop