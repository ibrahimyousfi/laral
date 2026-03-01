@extends('layouts.app')

@section('title', 'Settings')

@php
    $pageTitle = 'Settings';
@endphp

@section('content')
<div class="max-w-3xl space-y-4 sm:space-y-6 min-w-0">
    <form action="{{ route('dashboard.settings.update') }}" method="post" enctype="multipart/form-data" class="space-y-4 sm:space-y-6">
        @csrf
        @method('put')

        <div class="bg-white rounded-xl border border-gray-200 p-4 sm:p-6">
            <h2 class="text-lg font-semibold mb-4">{{ __('Application') }}</h2>
            <div class="space-y-4">
                <div>
                    <label for="app_name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('App name') }}</label>
                    <input type="text" name="app_name" id="app_name" value="{{ old('app_name', $app_name) }}" required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 sm:py-2 text-base sm:text-sm min-h-[44px] touch-manipulation">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Logo') }}</label>
                        @if($logo_path)
                            <p class="text-xs text-gray-500 mb-1">{{ __('Current:') }} {{ $logo_path }}</p>
                        @endif
                        <input type="file" name="logo" id="logo" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-2 file:rounded-lg file:border-0 file:bg-gray-100 file:px-3 file:py-1.5 file:text-sm">
                    </div>
                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">{{ __('App icon') }}</label>
                        @if($icon_path)
                            <p class="text-xs text-gray-500 mb-1">{{ __('Current:') }} {{ $icon_path }}</p>
                        @endif
                        <input type="file" name="icon" id="icon" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-2 file:rounded-lg file:border-0 file:bg-gray-100 file:px-3 file:py-1.5 file:text-sm">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-lg font-semibold mb-4">{{ __('Currency') }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="currency" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Currency') }}</label>
                    <select name="currency" id="currency" class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 sm:py-2 text-base sm:text-sm min-h-[44px] touch-manipulation">
                        @foreach($currencies as $code => $label)
                            <option value="{{ $code }}" {{ old('currency', $currency) === $code ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="currency_symbol" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Currency symbol') }}</label>
                    <input type="text" name="currency_symbol" id="currency_symbol" value="{{ old('currency_symbol', $currency_symbol) }}" maxlength="10"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 sm:py-2 text-base sm:text-sm min-h-[44px] touch-manipulation">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-lg font-semibold mb-4">{{ __('Date & time') }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="timezone" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Timezone') }}</label>
                    <input type="text" name="timezone" id="timezone" value="{{ old('timezone', $timezone) }}"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 sm:py-2 text-base sm:text-sm min-h-[44px] touch-manipulation" placeholder="UTC">
                </div>
                <div>
                    <label for="date_format" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Date format') }}</label>
                    <input type="text" name="date_format" id="date_format" value="{{ old('date_format', $date_format) }}"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 sm:py-2 text-base sm:text-sm min-h-[44px] touch-manipulation" placeholder="Y-m-d">
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <x-button type="submit" variant="primary">
                <x-slot:icon><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></x-slot:icon>
                {{ __('Save settings') }}
            </x-button>
        </div>
    </form>
</div>
@endsection
