@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>My Profile</h1>
@stop

@section('content')
    @if(session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            @if($employee)
                <p><strong>Designation:</strong> {{ $employee->designation }}</p>
                <p><strong>Mobile:</strong> {{ $employee->mobile_number }}</p>
                <p><strong>Address:</strong> {{ $employee->address }}</p>
            @endif
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
@stop

@section('js')
<script>
    // Auto-hide success alert after 5 seconds
    setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
        }
    }, 5000);
</script>
@stop
