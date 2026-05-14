<?php

use Illuminate\Support\Facades\Route;

// Este archivo es cargado con el prefijo 'admin' y el nombre 'admin.'
// por bootstrap/app.php

Route::get('/', function () {
    return redirect()->route('dashboard');
});