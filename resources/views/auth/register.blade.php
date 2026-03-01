@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
    <h1 class="text-xl font-semibold mb-6">{{ __('Register') }}</h1>

    <form action="{{ route('register') }}" method="post" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm focus:ring-2 focus:ring-gray-500 focus:border-transparent">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm focus:ring-2 focus:ring-gray-500 focus:border-transparent">
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Password') }}</label>
            <input type="password" name="password" id="password" required autocomplete="new-password"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm focus:ring-2 focus:ring-gray-500 focus:border-transparent">
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Confirm Password') }}</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm focus:ring-2 focus:ring-gray-500 focus:border-transparent">
        </div>
        <button type="submit" class="w-full rounded-lg bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-medium py-2 px-4 hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
            {{ __('Register') }}
        </button>
    </form>

    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400 text-center">
        {{ __('Already have an account?') }}
        <a href="{{ route('login') }}" class="font-medium text-gray-900 dark:text-white hover:underline">{{ __('Login') }}</a>
    </p>
</div>
@endsection
