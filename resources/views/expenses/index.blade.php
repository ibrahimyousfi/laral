@extends('layouts.app')

@section('title', 'Expenses')

@php
    $pageTitle = 'Expenses';
    $searchPlaceholder = 'Search expenses...';
@endphp

@section('content')
<div class="space-y-3">
    @forelse([] as $expense)
        <x-card-row>
            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-4 gap-1">
                <span class="font-medium text-gray-900">{{ $expense->title ?? '—' }}</span>
                <span class="text-sm text-gray-600">{{ $expense->amount ?? '—' }}</span>
                <span class="text-sm text-gray-500">{{ $expense->date ?? '—' }}</span>
            </div>
            <x-slot:actions>
                <x-card-actions edit-href="#" />
            </x-slot:actions>
        </x-card-row>
    @empty
        <x-card-row>
            <x-card-row-body>
                <p class="text-gray-500">No expenses yet.</p>
            </x-card-row-body>
            <x-slot:actions>
                <x-button href="#" variant="primary" size="sm">
                    <x-slot:icon><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg></x-slot:icon>
                    Add expense
                </x-button>
            </x-slot:actions>
        </x-card-row>
    @endforelse
</div>
@endsection
