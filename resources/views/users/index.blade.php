@extends('layouts.app')

@section('title', 'Users')

@php
    $pageTitle = 'Users';
    $searchPlaceholder = 'Search users...';
    $addUrl = route('dashboard.users.create');
@endphp

@section('navbar-search')
    <form action="{{ url()->current() }}" method="get" class="w-full flex items-center gap-2">
        <div class="w-full flex items-center gap-2 bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-2">
            <svg class="w-4 h-4 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            <input type="search" name="q" placeholder="Search users..." value="{{ request('q') }}" class="flex-1 bg-transparent border-0 outline-none text-sm placeholder-gray-500">
        </div>
        <button type="button" class="shrink-0 w-9 h-9 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-label="Filter">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
        </button>
    </form>
@endsection

@section('navbar-add-button')
    <x-navbar-add-button :url="$addUrl" label="Add user" />
@endsection

@section('content')
<div class="space-y-3">
    @forelse($users as $user)
        <x-card-row>
            <x-card-row-body :title="$user->name" :subtitle="$user->email" />
            <x-slot:actions>
                <x-card-actions :edit-href="route('dashboard.users.edit', $user)" :delete-href="route('dashboard.users.destroy', $user)" />
            </x-slot:actions>
        </x-card-row>
    @empty
        <x-card-row>
            <x-card-row-body>
                <p class="text-gray-500 dark:text-gray-400">No users yet.</p>
            </x-card-row-body>
            <x-slot:actions>
                <x-button href="{{ route('dashboard.users.create') }}" variant="primary" size="sm">
                    <x-slot:icon><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg></x-slot:icon>
                    Add user
                </x-button>
            </x-slot:actions>
        </x-card-row>
    @endforelse

    @if(isset($users) && $users->hasPages())
        <x-pagination :paginator="$users" />
    @endif
</div>
@endsection
