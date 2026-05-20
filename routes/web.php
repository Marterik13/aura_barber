<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

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
});