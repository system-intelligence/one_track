@extends('layouts.app')

@section('title', 'Edit Asset - One Track')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-3xl border border-gray-200 overflow-hidden">
        <div class="bg-gray-100 px-6 sm:px-8 border-b border-gray-200 py-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Edit Asset</h2>
            <p class="text-gray-600">Update the details of the asset below.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
            <!-- Main Form Section -->
            <div class="lg:col-span-2 p-6 sm:p-8 border-r border-gray-200 lg:border-r-gray-200">
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
                <label class="block text-sm font-medium text-gray-700 mb-4">Employee</label>
                <input type="text" name="user" value="{{ $asset->user }}"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Type</label>
                <div class="relative">
                    <select name="type" class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400 bg-white appearance-none">
                        <option {{ $asset->type == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                        <option {{ $asset->type == 'Desktop' ? 'selected' : '' }}>Desktop</option>
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
                <label class="block text-sm font-medium text-gray-700 mb-4">Surge Protector</label>
                <div class="relative">
                    <select name="surge_protector" class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400 bg-white appearance-none">
                        <option value="" {{ $asset->surge_protector == '' ? 'selected' : '' }}>None</option>
                        <option {{ $asset->surge_protector == 'UPS' ? 'selected' : '' }}>UPS</option>
                        <option {{ $asset->surge_protector == 'AVR' ? 'selected' : '' }}>AVR</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">System Unit Condition</label>
                <div class="relative">
                    <select name="condition" class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400 bg-white appearance-none">
                        <option {{ $asset->condition == 'working' ? 'selected' : '' }}>working</option>
                        <option {{ $asset->condition == 'needs repair' ? 'selected' : '' }}>needs repair</option>
                        <option {{ $asset->condition == 'broken' ? 'selected' : '' }}>broken</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peripherals Section - Moved to the end -->
        <div class="mt-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Peripherals</label>
                <div id="peripherals-container">
                    @if($asset->peripherals)
                        @foreach($asset->peripherals as $index => $peripheral)
                            <div class="peripheral-item flex gap-4 items-end mb-4 p-4 border border-gray-200 rounded-xl bg-gray-50">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                                    <div class="relative">
                                        <select name="peripherals[{{ $index }}][type]" class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 appearance-none">
                                            <option value="">Select Type</option>
                                            <option value="Printer" {{ $peripheral['type'] == 'Printer' ? 'selected' : '' }}>Printer</option>
                                            <option value="Mouse" {{ $peripheral['type'] == 'Mouse' ? 'selected' : '' }}>Mouse</option>
                                            <option value="Keyboard" {{ $peripheral['type'] == 'Keyboard' ? 'selected' : '' }}>Keyboard</option>
                                            <option value="Speaker" {{ $peripheral['type'] == 'Speaker' ? 'selected' : '' }}>Speaker</option>
                                            <option value="Headset" {{ $peripheral['type'] == 'Headset' ? 'selected' : '' }}>Headset</option>
                                            <option value="Other" {{ $peripheral['type'] == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Details</label>
                                    <input type="text" name="peripherals[{{ $index }}][details]" value="{{ $peripheral['details'] ?? '' }}" placeholder="Model/Serial/Description"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Condition</label>
                                    <div class="relative">
                                        <select name="peripherals[{{ $index }}][condition]" class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 appearance-none">
                                            <option value="">Select Condition</option>
                                            <option value="working" {{ ($peripheral['condition'] ?? '') == 'working' ? 'selected' : '' }}>working</option>
                                            <option value="needs repair" {{ ($peripheral['condition'] ?? '') == 'needs repair' ? 'selected' : '' }}>needs repair</option>
                                            <option value="broken" {{ ($peripheral['condition'] ?? '') == 'broken' ? 'selected' : '' }}>broken</option>
                                        </select>
                                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="remove-peripheral text-red-600 hover:text-red-800 p-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" id="add-peripheral" class="mt-2 inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Peripheral
                </button>
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

            <!-- Maintenance History Sidebar -->
            <div class="lg:col-span-1 p-6 sm:p-8 bg-gray-50">
                <div class="sticky top-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                        </svg>
                        Maintenance History
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">Personal record for {{ $asset->user }}</p>

                    @php
                        $employeeMaintenances = \App\Models\Maintenance::where('user_name', $asset->user)->orderBy('date', 'desc')->take(5)->get();
                    @endphp

                    @if($employeeMaintenances->count() > 0)
                        <div class="space-y-3">
                            @foreach($employeeMaintenances as $maintenance)
                                <div class="p-3 border border-gray-200 rounded-lg bg-white shadow-sm">
                                    <div class="flex justify-between items-start mb-2">
                                        <p class="text-xs font-medium text-gray-800">{{ $maintenance->date->format('M d, Y') }}</p>
                                        @if($maintenance->asset_id)
                                            <span class="text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded">Asset #{{ $maintenance->asset_id }}</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-600 line-clamp-2">{{ $maintenance->description ?: 'No description' }}</p>
                                </div>
                            @endforeach
                        </div>
                        @if($employeeMaintenances->count() >= 5)
                            <p class="text-xs text-gray-500 mt-3 text-center">Showing latest 5 records</p>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-sm text-gray-500">No maintenance history</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let peripheralIndex = {{ count($asset->peripherals ?? []) }};

    function createPeripheralInput(index, type = '', details = '', condition = '') {
        return `
            <div class="peripheral-item flex gap-4 items-end mb-4 p-4 border border-gray-200 rounded-xl bg-gray-50">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                    <div class="relative">
                        <select name="peripherals[${index}][type]" class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 appearance-none">
                            <option value="">Select Type</option>
                            <option value="Printer" ${type === 'Printer' ? 'selected' : ''}>Printer</option>
                            <option value="Mouse" ${type === 'Mouse' ? 'selected' : ''}>Mouse</option>
                            <option value="Keyboard" ${type === 'Keyboard' ? 'selected' : ''}>Keyboard</option>
                            <option value="Speaker" ${type === 'Speaker' ? 'selected' : ''}>Speaker</option>
                            <option value="Headset" ${type === 'Headset' ? 'selected' : ''}>Headset</option>
                            <option value="Other" ${type === 'Other' ? 'selected' : ''}>Other</option>
                        </select>
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Details</label>
                    <input type="text" name="peripherals[${index}][details]" value="${details}" placeholder="Model/Serial/Description"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Condition</label>
                    <div class="relative">
                        <select name="peripherals[${index}][condition]" class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 appearance-none">
                            <option value="">Select Condition</option>
                            <option value="working" ${condition === 'working' ? 'selected' : ''}>working</option>
                            <option value="needs repair" ${condition === 'needs repair' ? 'selected' : ''}>needs repair</option>
                            <option value="broken" ${condition === 'broken' ? 'selected' : ''}>broken</option>
                        </select>
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <button type="button" class="remove-peripheral text-red-600 hover:text-red-800 p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        `;
    }

    document.getElementById('add-peripheral').addEventListener('click', function() {
        const container = document.getElementById('peripherals-container');
        container.insertAdjacentHTML('beforeend', createPeripheralInput(peripheralIndex));
        peripheralIndex++;
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-peripheral')) {
            e.target.closest('.peripheral-item').remove();
        }
    });
});
</script>
@endsection