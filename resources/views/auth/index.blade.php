@extends('layouts.guest')

@section('title', 'Auth')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 text-center">
    <h1 class="text-xl font-semibold mb-4">{{ __('Authentication') }}</h1>
    <p class="text-gray-500 text-sm mb-6">{{ __('Choose an option below.') }}</p>
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('login') }}" class="inline-flex justify-center rounded-lg bg-gray-900 text-white font-medium py-2 px-4 hover:bg-gray-800 transition-colors">
            {{ __('Login') }}
        </a>
        <a href="{{ route('register') }}" class="inline-flex justify-center rounded-lg border border-gray-300 text-gray-700 font-medium py-2 px-4 hover:bg-gray-50 transition-colors">
            {{ __('Register') }}
        </a>
    </div>
</div>
@endsection
