@extends('layouts.app')

@section('title', 'Edit Asset - One Track')

@section('content')
<div class="bg-white shadow-xl rounded-3xl p-6 sm:p-8 border border-gray-200 max-w-3xl mx-auto">
    <div class="bg-gray-100 px-4 sm:px-6 border-b border-gray-200 mb-6 p-6 sm:pb-6"> 
        <h2 class="text-2xl font-bold text-gray-800 mb-1">Edit Asset</h2>
        <p class="text-gray-600">Update the details of the asset below.</p>
    </div>
    <form action="{{ route('assets.update', $asset->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Office</label>
                <input type="text" name="office" value="{{ $asset->office }}"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">User</label>
                <input type="text" name="user" value="{{ $asset->user }}"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Type</label>
                <div class="relative">
                    <select name="type" class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400 bg-white appearance-none">
                        <option {{ $asset->type == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                        <option {{ $asset->type == 'Desktop' ? 'selected' : '' }}>Desktop</option>
                        <option {{ $asset->type == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Operating System</label>
                <input type="text" name="os" value="{{ $asset->os }}"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Processor</label>
                <input type="text" name="processor" value="{{ $asset->processor }}"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">RAM</label>
                <input type="text" name="ram" value="{{ $asset->ram }}"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">GPU</label>
                <input type="text" name="gpu" value="{{ $asset->gpu }}"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">UPS</label>
                <input type="text" name="ups" value="{{ $asset->ups }}"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">AVR</label>
                <input type="text" name="avr" value="{{ $asset->avr }}"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Condition</label>
                <div class="relative">
                    <select name="condition" class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400 bg-white appearance-none">
                        <option {{ $asset->condition == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                        <option {{ $asset->condition == 'Good' ? 'selected' : '' }}>Good</option>
                        <option {{ $asset->condition == 'Fair' ? 'selected' : '' }}>Fair</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ url('/asset') }}" 
                class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-2xl text-sm font-semibold transition shadow hover:shadow-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Cancel
            </a>
            <button type="submit" 
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl text-sm font-semibold transition shadow hover:shadow-lg transform hover:scale-[1.03]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update Asset
            </button>
        </div>
    </form>
</div>

@endsection