<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareAppSettings
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (Schema::hasTable('settings')) {
                View::share('appSettings', Setting::getAll());
            }
        } catch (\Throwable $e) {
            View::share('appSettings', []);
        }

        return $next($request);
    }
}
