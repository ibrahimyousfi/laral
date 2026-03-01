@extends('layouts.app')

@section('title', 'Edit User')

@php
    $pageTitle = 'Edit User';
@endphp

@section('content')
<div class="max-w-xl bg-white rounded-xl border border-gray-200 p-6">
    <form action="{{ route('dashboard.users.update', $user) }}" method="post" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm @error('name') border-red-500 @enderror">
            @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm @error('email') border-red-500 @enderror">
            @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password (leave blank to keep)</label>
            <input type="password" name="password" id="password" class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm @error('password') border-red-500 @enderror" minlength="8">
            @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm" minlength="8">
        </div>
        <div class="flex gap-2 pt-2">
            <x-button type="submit" variant="primary">
                <x-slot:icon><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></x-slot:icon>
                Save
            </x-button>
            <x-button href="{{ route('dashboard.users.index') }}" variant="secondary">
                <x-slot:icon><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></x-slot:icon>
                Cancel
            </x-button>
        </div>
    </form>
</div>
@endsection
