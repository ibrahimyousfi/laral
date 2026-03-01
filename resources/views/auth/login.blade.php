@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
    <h1 class="text-xl font-semibold mb-6">{{ __('Login') }}</h1>

    <form action="{{ route('login') }}" method="post" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:ring-2 focus:ring-gray-500 focus:border-transparent">
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Password') }}</label>
            <input type="password" name="password" id="password" required autocomplete="current-password"
                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:ring-2 focus:ring-gray-500 focus:border-transparent">
        </div>
        <div class="flex items-center">
            <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-gray-600 focus:ring-gray-500">
            <label for="remember" class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
        </div>
        <button type="submit" class="w-full rounded-lg bg-gray-900 text-white font-medium py-2 px-4 hover:bg-gray-800 transition-colors">
            {{ __('Login') }}
        </button>
    </form>

    <p class="mt-4 text-sm text-gray-500 text-center">
        {{ __('Don\'t have an account?') }}
        <a href="{{ route('register') }}" class="font-medium text-gray-900 hover:underline">{{ __('Register') }}</a>
    </p>
</div>
@endsection
