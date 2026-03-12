<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ye route 'index.blade.php' file ko load karega
Route::get('/', function () {
    return view('index');
});