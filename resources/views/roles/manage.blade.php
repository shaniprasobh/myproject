@extends('adminlte::page')

@section('title', 'Manage Roles & Permissions')

@section('content_header')
    <h1>Manage Roles & Permissions</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('roles.manage') }}" method="GET" class="row g-3 align-items-end mb-3">
                <div class="col-md-6">
                    <label for="role_id" class="form-label">Select Role</label>
                    <select name="role_id" id="role_id" class="form-control" required onchange="this.form.submit()">
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ isset($selectedRole) && $selectedRole && $selectedRole->id == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            @if (isset($selectedRole) && $selectedRole)
                <form action="{{ route('roles.manage.update') }}" method="POST" class="row g-3 align-items-end">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="role_id" value="{{ $selectedRole->id }}">
                    <div class="col-md-8">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $permission->name }}" id="perm_{{ $permission->id }}"
                                            {{ in_array($permission->name, $selectedPermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perm_{{ $permission->id }}">
                                            {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
