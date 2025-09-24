@extends('adminlte::page')

@section('title', 'Edit Profile')

@section('content_header')
    <h1>Edit Profile</h1>
@stop

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                @if($employee)
                    <div class="form-group mb-3">
                        <label for="designation">Designation</label>
                        <input type="text" name="designation" class="form-control" value="{{ old('designation', $employee->designation) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="mobile_number">Mobile</label>
                        <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $employee->mobile_number) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <textarea name="address" class="form-control">{{ old('address', $employee->address) }}</textarea>
                    </div>
                @endif

                <div class="form-group mb-3">
                    <label for="password">New Password <small>(leave blank to keep current)</small></label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-success">Update Profile</button>
                <a href="{{ route('profile.show') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@stop
