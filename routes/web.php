<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // --- AURA AESTHETICS ROUTES ---
    Route::resource('/admin/users', UserController::class)->names('admin.users');
    Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::post(
    '/admin/appointments/{appointment}/send-email',
    [AppointmentController::class, 'sendEmail']
)->name('admin.appointments.send-email');
    
    Route::resource('/admin/services', \App\Http\Controllers\Admin\ServiceController::class)->names('admin.services');
    Route::resource('/admin/specialists', \App\Http\Controllers\Admin\SpecialistController::class)->names('admin.specialists');
    Route::resource('/admin/appointments', \App\Http\Controllers\Admin\AppointmentController::class)->names('admin.appointments');
});