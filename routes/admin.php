<?php
use App\Http\Controllers\Admin\RoleController;

use Illuminate\Support\Facades\Route;

// Este archivo es cargado con el prefijo 'admin' y el nombre 'admin.'
// por bootstrap/app.php

Route::get('/', function(){
  return view('admin.dashboard');
})->name('dashboard');

Route::resource('roles', RoleController::class);
