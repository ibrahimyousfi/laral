@extends('layouts.app')

@section('title', 'App')

@php
    $pageTitle = 'App';
    $searchPlaceholder = 'Search...';
@endphp

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total Users</p>
        <p class="text-2xl font-semibold mt-1">0</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4">
        <p class="text-sm text-gray-500 dark:text-gray-400">Active</p>
        <p class="text-2xl font-semibold mt-1">0</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4">
        <p class="text-sm text-gray-500 dark:text-gray-400">Pending</p>
        <p class="text-2xl font-semibold mt-1">0</p>
    </div>
</div>
@endsection
