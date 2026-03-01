<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            if (Schema::hasTable('settings')) {
                View::share('appSettings', Setting::getAll());
            } else {
                View::share('appSettings', []);
            }
        } catch (\Throwable $e) {
            View::share('appSettings', []);
        }
    }
}
