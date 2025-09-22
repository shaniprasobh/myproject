<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', function () {
    return view('welcome'); // Simple landing page
})->name('welcome');

// Authentication routes (disable registration)
//Auth::routes();
Auth::routes(['register' => false]);

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Company CRUD
    Route::resource('companies', CompanyController::class);
    // Employee CRUD
    Route::resource('employees', EmployeeController::class);
});
