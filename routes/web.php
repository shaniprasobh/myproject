

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
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

    // Employee profile for logged-in user

    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', [PasswordController::class, 'showChangeForm'])->name('password.change');
    Route::post('/change-password', [PasswordController::class, 'updatePassword'])->name('password.update');
});
