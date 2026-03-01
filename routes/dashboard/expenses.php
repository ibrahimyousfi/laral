<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard > Expenses – one file per page
|--------------------------------------------------------------------------
*/

Route::prefix('expenses')->name('expenses.')->group(function (): void {
    Route::get('/', [ExpenseController::class, 'index'])->name('index');
});
