@extends('layouts.app')

@section('title', 'App')

@php
    $pageTitle = 'App';
    $searchPlaceholder = 'Search...';
@endphp

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
    <div class="bg-white rounded-xl border border-gray-200 p-4 min-h-[80px] flex flex-col justify-center">
        <p class="text-sm text-gray-500">Total Users</p>
        <p class="text-2xl font-semibold mt-1">0</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-4 min-h-[80px] flex flex-col justify-center">
        <p class="text-sm text-gray-500">Active</p>
        <p class="text-2xl font-semibold mt-1">0</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-4 min-h-[80px] flex flex-col justify-center">
        <p class="text-sm text-gray-500">Pending</p>
        <p class="text-2xl font-semibold mt-1">0</p>
    </div>
</div>
@endsection
