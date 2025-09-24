@extends('adminlte::page')

@section('title', 'My Profile')

@section('content_header')
    <h1>My Profile</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            Profile Details
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>

            @if($employee)
                <p><strong>Designation:</strong> {{ $employee->designation }}</p>
                <p><strong>Mobile:</strong> {{ $employee->mobile_number }}</p>
                <p><strong>Address:</strong> {{ $employee->address }}</p>
            @endif

            <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit Profile</a>
        </div>
    </div>
@stop
