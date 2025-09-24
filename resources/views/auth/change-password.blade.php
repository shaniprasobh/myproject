@extends('adminlte::page')

@section('title', 'Change Password')

@section('content_header')
    <h1>Change Password</h1>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <div class="form-group">
        <label>Current Password</label>
        <input type="password" name="current_password" class="form-control" required>
        @error('current_password')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="new_password" class="form-control" required>
        @error('new_password')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
        <label>Confirm New Password</label>
        <input type="password" name="new_password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Password</button>
</form>
@stop
