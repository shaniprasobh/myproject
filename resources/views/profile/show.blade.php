@extends('adminlte::page')

@section('title', 'My Profile')

@section('content_header')
    <h1>My Profile</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-lg mx-auto" style="max-width: 500px;">
        <div class="card-body text-center">
            <div class="mb-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=128"
                    class="rounded-circle shadow" alt="Avatar">
            </div>
            <h3 class="mb-1">{{ $user->name }}</h3>
            <p class="text-muted mb-2">{{ $user->email }}</p>
            @if ($employee)
                <div class="row justify-content-center mb-2">
                    <div class="col-5 text-end"><strong>Designation:</strong></div>
                    <div class="col-7 text-start">{{ $employee->designation ?? '-' }}</div>
                </div>
                <div class="row justify-content-center mb-2">
                    <div class="col-5 text-end"><strong>Mobile:</strong></div>
                    <div class="col-7 text-start">{{ $employee->mobile_number ?? '-' }}</div>
                </div>
                <div class="row justify-content-center mb-2">
                    <div class="col-5 text-end"><strong>Address:</strong></div>
                    <div class="col-7 text-start">{{ $employee->address ?? '-' }}</div>
                </div>
            @endif
            <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit Profile</a>
        </div>
    </div>
@stop
