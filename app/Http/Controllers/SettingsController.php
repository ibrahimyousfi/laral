<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

final class SettingsController extends Controller
{
    private static function currencies(): array
    {
        return [
            'USD' => 'USD - US Dollar ($)',
            'EUR' => 'EUR - Euro (€)',
            'GBP' => 'GBP - British Pound (£)',
            'SAR' => 'SAR - Saudi Riyal (﷼)',
            'AED' => 'AED - UAE Dirham',
            'EGP' => 'EGP - Egyptian Pound',
            'MAD' => 'MAD - Moroccan Dirham',
            'TND' => 'TND - Tunisian Dinar',
        ];
    }

    public function index(): View
    {
        $settings = Setting::getAll();
        return view('settings.index', [
            'currencies' => self::currencies(),
            'app_name' => $settings['app_name'] ?? config('app.name'),
            'currency' => $settings['currency'] ?? 'USD',
            'currency_symbol' => $settings['currency_symbol'] ?? '$',
            'logo_path' => $settings['logo_path'] ?? null,
            'icon_path' => $settings['icon_path'] ?? null,
            'timezone' => $settings['timezone'] ?? config('app.timezone'),
            'date_format' => $settings['date_format'] ?? 'Y-m-d',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'app_name' => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:10'],
            'currency_symbol' => ['required', 'string', 'max:10'],
            'timezone' => ['required', 'string', 'max:50'],
            'date_format' => ['required', 'string', 'max:20'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'icon' => ['nullable', 'image', 'max:512'],
        ]);

        foreach (['app_name', 'currency', 'currency_symbol', 'timezone', 'date_format'] as $key) {
            Setting::set($key, $validated[$key]);
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('settings', 'public');
            $old = Setting::get('logo_path');
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            Setting::set('logo_path', $path);
        }

        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('settings', 'public');
            $old = Setting::get('icon_path');
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            Setting::set('icon_path', $path);
        }

        return redirect()->route('dashboard.settings.index')->with('success', __('Settings saved.'));
    }
}
