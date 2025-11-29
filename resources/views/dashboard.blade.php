@extends('layouts.app')

@section('title', 'One Track Dashboard')

@section('content')
<div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 mb-8 border border-blue-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome back, {{ Auth::user()->name }}!</h2>
    <p class="text-gray-600">{{ Auth::user()->email }}</p>
</div>

<!-- Dashboard Summary -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 text-center hover:shadow-xl transition">
        <div class="flex items-center justify-center mb-4">
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Assets</h3>
        <p class="text-4xl font-bold text-blue-600 mb-1">{{ \App\Models\Asset::count() }}</p>
        <p class="text-sm text-gray-500">All registered assets</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 text-center hover:shadow-xl transition">
        <div class="flex items-center justify-center mb-4">
            <div class="bg-green-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Excellent Condition</h3>
        <p class="text-4xl font-bold text-green-600 mb-1">{{ \App\Models\Asset::where('condition', 'Excellent')->count() }}</p>
        <p class="text-sm text-gray-500">In excellent condition</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 text-center hover:shadow-xl transition">
        <div class="flex items-center justify-center mb-4">
            <div class="bg-yellow-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Needs Attention</h3>
        <p class="text-4xl font-bold text-yellow-600 mb-1">{{ \App\Models\Asset::where('condition', '!=', 'Excellent')->count() }}</p>
        <p class="text-sm text-gray-500">Needs attention</p>
    </div>
</div>

        <!-- Recently Added Assets -->
        <section class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Recently Added Assets
            </h3>
            <ul class="space-y-4">
                @forelse(\App\Models\Asset::latest()->take(5)->get() as $asset)
                <li class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                    <div class="flex items-center space-x-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                            {{ $asset->type == 'Laptop' ? 'bg-blue-100 text-blue-800' : ($asset->type == 'Desktop' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                            {{ $asset->type }}
                        </span>
                        <div>
                            <p class="font-medium text-gray-900">{{ $asset->user ?? 'Unassigned' }}</p>
                            <p class="text-sm text-gray-500">{{ $asset->office }}</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500">{{ $asset->created_at->diffForHumans() }}</span>
                </li>
                @empty
                <li class="p-4 text-center text-gray-500 bg-gray-50 rounded-xl">No assets found.</li>
                @endforelse
            </ul>
        </section>
        <!-- Upcoming Maintenance -->
        @include('dashboard-upcoming-maintenance', compact('assets_with_maintenance'))
@endsection
