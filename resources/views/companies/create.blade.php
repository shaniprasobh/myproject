@extends('adminlte::page')

@section('title', 'Add Company')

@section('content_header')
@stop

@section('content')
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-building"></i> Add Company</h4>
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
            <form action="{{ route('companies.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-building"></i> Company Name</label>
                            <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-phone"></i> Mobile Number</label>
                            <input type="text" name="mobile_number" class="form-control"
                                value="{{ old('mobile_number') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-receipt"></i> GST Number</label>
                            <input type="text" name="gst_number" class="form-control" value="{{ old('gst_number') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><i class="fas fa-map-marker-alt"></i> Address</label>
                            <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="fas fa-plus"></i> Save Company</button>
                <a href="{{ route('companies.index') }}" class="btn btn-secondary mt-3 ms-2"><i
                        class="fas fa-arrow-left"></i> Back</a>
            </form>
        </div>
    </div>
@stop
