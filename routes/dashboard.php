<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard routes – one file per section
|--------------------------------------------------------------------------
*/

Route::prefix('app')->name('dashboard.')->middleware('auth')->group(function (): void {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    require __DIR__.'/dashboard/users.php';
    require __DIR__.'/dashboard/expenses.php';
    require __DIR__.'/dashboard/settings.php';
});
