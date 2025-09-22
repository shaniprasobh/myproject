@extends('layouts.app')

@section('title', 'Add Company')

@section('content')
<div class="container-fluid">
    <h1>Add Company</h1>

    <form action="{{ route('companies.store') }}" method="POST">
        @csrf
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" name="company_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile_number" class="form-control">
                </div>
                <div class="form-group">
                    <label>GST Number</label>
                    <input type="text" name="gst_number" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
