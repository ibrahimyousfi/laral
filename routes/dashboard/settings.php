<?php

use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard > Settings – one file per page
|--------------------------------------------------------------------------
*/

Route::prefix('settings')->name('settings.')->group(function (): void {
    Route::get('/', [SettingsController::class, 'index'])->name('index');
    Route::put('/', [SettingsController::class, 'update'])->name('update');
});
