<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

final class ExpenseController extends Controller
{
    public function index(): View
    {
        return view('expenses.index');
    }
}
