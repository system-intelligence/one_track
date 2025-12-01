@extends('layouts.app')

@section('title', 'Maintenance for ' . $year . '-' . $month . '-' . $day . ' - One Track')

@section('content')
<div class="bg-white shadow-xl rounded-3xl p-6 sm:p-8 border border-gray-200 max-w-4xl mx-auto">
    <div class="bg-gray-100 px-4 sm:px-6 border-b border-gray-200 mb-6 p-6 sm:pb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-1">Maintenance for {{ \Carbon\Carbon::create($year, $month, $day)->format('F j, Y') }}</h2>
        <p class="text-gray-600">Scheduled maintenance activities for this day.</p>
    </div>

    @if($maintenances->count() > 0)
        <div class="space-y-4">
            @foreach($maintenances as $maintenance)
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <p class="font-semibold">{{ $maintenance->user_name }}</p>
                    <p class="text-sm text-gray-600">{{ $maintenance->description }}</p>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-500">
            <p class="text-lg">No maintenance scheduled for this day.</p>
            <p class="text-sm mt-2">Schedule maintenance for this date below.</p>
        </div>
    @endif

    <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-2xl border border-blue-200 shadow-sm">
        <div class="flex items-center gap-3 mb-6">
            <div class="p-2 bg-blue-100 rounded-lg">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800">Create Schedule</h3>
        </div>
        <form action="{{ route('maintenances.store') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="date" value="{{ $year }}-{{ $month }}-{{ $day }}">
            <div>
                <label for="user_name" class="block text-sm font-semibold text-gray-700 mb-2">Select User</label>
                <div class="relative">
                    <select name="user_name" id="user_name" class="appearance-none w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white pr-10 transition duration-200" required>
                        <option value="">Choose a user</option>
                        @foreach($users as $user)
                            <option value="{{ $user }}">{{ $user }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none transition duration-200" placeholder="Enter maintenance description..."></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Schedule Maintenance
                </button>
            </div>
        </form>
    </div>

    <div class="flex justify-center gap-4 mt-8 w-full">
        <a href="{{ url('/dashboard') }}"
            class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-2xl text-sm font-semibold transition shadow hover:shadow-lg">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>
</div>
@endsection