<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public pages (one file per page / section)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
