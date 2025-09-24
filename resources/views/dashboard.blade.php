@extends('adminlte::page')  <!-- Using AdminLTE layout -->

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Welcome Card -->
        <div class="col-md-12 mb-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Welcome!</h3>
                </div>
                <div class="card-body">
                    <p>Hello <strong>{{ auth()->user()->name }}</strong>, welcome to your project dashboard.</p>
                </div>
            </div>
        </div>

        @canany(['view company', 'create company', 'edit company', 'delete company'])
        <!-- Companies Card -->
        <div class="col-md-6 mb-3">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Companies</h3>
                </div>
                <div class="card-body">
                    <p>Manage all companies in the system.</p>
                    <a href="{{ route('companies.index') }}" class="btn btn-info">Go to Companies</a>
                </div>
            </div>
        </div>
        @endcanany

        @canany(['view employee', 'create employee', 'edit employee', 'delete employee'])
        <!-- Employees Card -->
        <div class="col-md-6 mb-3">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Employees</h3>
                </div>
                <div class="card-body">
                    <p>Manage all employees in the system.</p>
                    <a href="{{ route('employees.index') }}" class="btn btn-success">Go to Employees</a>
                </div>
            </div>
        </div>
        @endcanany
    </div>
</div>
@endsection

@section('css')
    <style>
        .card { min-height: 150px; }
    </style>
@endsection

@section('js')
    <script>
        console.log('Dashboard loaded');
    </script>
@endsection
