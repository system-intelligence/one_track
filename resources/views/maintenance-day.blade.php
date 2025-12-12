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
            @php
                $groupedMaintenances = $maintenances->groupBy('user_name');
            @endphp
            @foreach($groupedMaintenances as $userName => $group)
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <p class="font-semibold mb-4 text-blue-600">
                        @php
                            $names = explode(', ', $userName);
                        @endphp
                        @foreach($names as $name)
                            {{ $name }}<br>
                        @endforeach
                    </p>
                    <div class="text-sm text-gray-600 space-y-2">
                        @foreach($group as $maintenance)
                            <div class="bg-white p-2 rounded border-l-4 border-blue-400">
                                {{ $maintenance->description }}
                            </div>
                        @endforeach
                    </div>
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
                <label class="block text-sm font-semibold text-gray-700 mb-2">Select Employee</label>
                <div class="space-y-2 max-h-40 overflow-y-auto border border-gray-300 rounded-xl p-4 bg-white">
                    @foreach($users as $user)
                        <label class="flex items-center">
                            <input type="checkbox" name="user_names[]" value="{{ $user }}"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">{{ $user }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Maintenance Descriptions</label>
                <div id="maintenances-container">
                    <!-- Dynamic maintenance inputs will be added here -->
                </div>
                <button type="button" id="add-maintenance" class="mt-2 inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Maintenance Description
                </button>
            </div>
            <div class="flex justify-end">
                <button type="submit" id="submit-btn" disabled class="inline-flex items-center gap-2 bg-gray-400 text-white px-6 py-3 rounded-xl font-semibold shadow-lg cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Schedule Maintenance
                </button>
            </div>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let maintenanceIndex = 0;

        function createMaintenanceInput(index) {
            return `
                <div class="maintenance-item mb-2 p-2 border border-gray-200 rounded-xl bg-gray-50">
                    <div class="flex items-start gap-4">
                        <div class="flex-1">
                            <textarea name="descriptions[${index}]" rows="1" class="w-full px-3 py-1 border border-gray-300 rounded-lg focus:ring-0 focus:border-blue-500 focus:outline-none resize-none text-sm" placeholder="Enter maintenance description..."></textarea>
                        </div>
                        <button type="button" class="remove-maintenance text-red-600 hover:text-red-800 p-1 mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
`;
        }

        document.getElementById('add-maintenance').addEventListener('click', function() {
            const container = document.getElementById('maintenances-container');
            container.insertAdjacentHTML('beforeend', createMaintenanceInput(maintenanceIndex));
            maintenanceIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-maintenance')) {
                e.target.closest('.maintenance-item').remove();
            }
        });

        function updateSubmitButton() {
            const checkedBoxes = document.querySelectorAll('input[name="user_names[]"]:checked');
            const submitBtn = document.getElementById('submit-btn');
            if (checkedBoxes.length > 0) {
                submitBtn.disabled = false;
                submitBtn.className = 'inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition duration-200 transform hover:-translate-y-0.5';
            } else {
                submitBtn.disabled = true;
                submitBtn.className = 'inline-flex items-center gap-2 bg-gray-400 text-white px-6 py-3 rounded-xl font-semibold shadow-lg cursor-not-allowed';
            }
        }

        // Add event listeners to checkboxes
        document.addEventListener('change', function(e) {
            if (e.target.name === 'user_names[]') {
                updateSubmitButton();
            }
        });

        // Add one initial maintenance input
        document.getElementById('add-maintenance').click();
    });
    </script>

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