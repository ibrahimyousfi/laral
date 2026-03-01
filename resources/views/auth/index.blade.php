@extends('layouts.guest')

@section('title', 'Auth')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6 text-center">
    <h1 class="text-xl font-semibold mb-4">{{ __('Authentication') }}</h1>
    <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">{{ __('Choose an option below.') }}</p>
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('login') }}" class="inline-flex justify-center rounded-lg bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-medium py-2 px-4 hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
            {{ __('Login') }}
        </a>
        <a href="{{ route('register') }}" class="inline-flex justify-center rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium py-2 px-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
            {{ __('Register') }}
        </a>
    </div>
</div>
@endsection
