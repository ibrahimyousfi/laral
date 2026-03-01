<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'app_name' => config('app.name'),
            'currency' => 'USD',
            'currency_symbol' => '$',
            'logo_path' => null,
            'icon_path' => null,
            'timezone' => config('app.timezone'),
            'date_format' => 'Y-m-d',
        ];

        foreach ($defaults as $key => $value) {
            Setting::query()->firstOrCreate(
                ['key' => $key],
                ['value' => (string) $value]
            );
        }
        \Illuminate\Support\Facades\Cache::forget('app_settings');
    }
}
