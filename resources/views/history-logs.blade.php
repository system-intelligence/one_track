@extends('layouts.app')

@section('title', 'History Logs - One Track')

@section('content')
<div class="bg-white shadow-xl rounded-3xl p-6 sm:p-8 border border-gray-200 max-w-7xl mx-auto">
    <div class="bg-gray-100 px-4 sm:px-6 border-b border-gray-200 mb-6 p-6 sm:pb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-1">History Logs</h2>
        <p class="text-gray-600">Complete audit trail of all system activities.</p>
    </div>

    <!-- Search and Filter Section -->
    <div class="mb-6 bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
        <form method="GET" action="{{ route('history.index') }}" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Search by description, model, or user..."
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="sm:w-48">
                <label for="action" class="block text-sm font-medium text-gray-700 mb-2">Action Type</label>
                <div class="relative">
                    <select name="action" id="action" onchange="this.form.submit()" class="block w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 appearance-none">
                        <option value="">All Actions</option>
                        <option value="CREATE" {{ request('action') == 'CREATE' ? 'selected' : '' }}>Create</option>
                        <option value="UPDATE" {{ request('action') == 'UPDATE' ? 'selected' : '' }}>Update</option>
                        <option value="DELETE" {{ request('action') == 'DELETE' ? 'selected' : '' }}>Delete</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
            @if(request('search') || request('action'))
                <div class="flex items-end">
                    <a href="{{ route('history.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg hover:bg-gray-600 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Clear
                    </a>
                </div>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left">Date & Time</th>
                    <th class="px-4 py-3 text-left">Action</th>
                    <th class="px-4 py-3 text-left">Model</th>
                    <th class="px-4 py-3 text-left">Record ID</th>
                    <th class="px-4 py-3 text-left">Description</th>
                    <th class="px-4 py-3 text-left">Changes</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($logs as $log)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-4 py-3 text-sm text-gray-900">
                        {{ $log->created_at->format('M d, Y H:i') }}
                    </td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold rounded-full
                            {{ $log->action == 'CREATE' ? 'bg-green-100 text-green-800' :
                               ($log->action == 'UPDATE' ? 'bg-blue-100 text-blue-800' :
                               'bg-red-100 text-red-800') }}">
                            @if($log->action == 'CREATE')
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            @elseif($log->action == 'UPDATE')
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            @else
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                            {{ $log->action }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-gray-900">
                        {{ $log->model_type }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600">
                        #{{ $log->model_id }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 max-w-xs truncate">
                        {{ $log->description }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600">
                        @if($log->old_values || $log->new_values)
                            <button onclick="showChanges(this)" data-log-id="{{ $log->id }}" data-action="{{ $log->action }}" data-created-at="{{ $log->created_at }}" data-old-values="{{ $log->old_values ? base64_encode(json_encode($log->old_values)) : '' }}" data-new-values="{{ $log->new_values ? base64_encode(json_encode($log->new_values)) : '' }}" class="text-blue-600 hover:text-blue-800 underline">
                                View Changes
                            </button>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        No history logs found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($logs->hasPages())
    <div class="mt-6">
        {{ $logs->links() }}
    </div>
    @endif
</div>

<!-- Modal for viewing changes -->
<div id="changesModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-5/6 lg:w-4/5 max-w-6xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Changes Details</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="changesContent" class="text-sm text-gray-600">
                <!-- Changes will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function showChanges(button) {
    const modal = document.getElementById('changesModal');
    const content = document.getElementById('changesContent');

    const logId = button.getAttribute('data-log-id');
    const action = button.getAttribute('data-action');
    const createdAt = button.getAttribute('data-created-at');
    const oldValuesEncoded = button.getAttribute('data-old-values');
    const newValuesEncoded = button.getAttribute('data-new-values');

    function decodeAndParse(encodedData) {
        if (!encodedData) return null;
        try {
            const jsonString = atob(encodedData);
            return JSON.parse(jsonString);
        } catch (e) {
            return null;
        }
    }

    function formatValues(values) {
        if (!values) return '<span class="text-gray-500 italic">No data available</span>';

        const formatDateTime = (dateString) => {
            if (!dateString) return dateString;
            try {
                const date = new Date(dateString);
                if (isNaN(date.getTime())) return dateString; // Invalid date
                return date.toLocaleString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true
                });
            } catch (e) {
                return dateString;
            }
        };

        let html = '<div class="space-y-1">';
        for (const [key, value] of Object.entries(values)) {
            // Skip excluded fields
            if (['previous_maintenance', 'last_maintenance'].includes(key.toLowerCase())) {
                continue;
            }

            let displayKey = key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());

            // Special handling for field names
            if (displayKey === 'User Name') {
                displayKey = 'Employees name';
            }

            const displayValue = formatFieldValue(value, displayKey);

            html += `<div class="flex justify-between py-1 border-b border-gray-100 last:border-b-0">
                <span class="font-medium text-gray-700 text-xs">${displayKey}:</span>
                <span class="text-gray-900 text-xs ml-2 break-all">${displayValue}</span>
            </div>`;
        }
        html += '</div>';
        return html;
    }

    function generateDiffView(oldValues, newValues, createdAt) {
        if (!oldValues && !newValues) return '<p class="text-gray-500">No data available</p>';
        if (!oldValues) return `<div class="text-xs bg-green-50 p-3 rounded border-l-4 border-green-400 text-green-800"><strong>Asset Created</strong><br>${formatValues(newValues)}</div>`;
        if (!newValues) return `<div class="text-xs bg-red-50 p-3 rounded border-l-4 border-red-400 text-red-800"><strong>Asset Deleted</strong><br>${formatValues(oldValues)}</div>`;

        const changes = [];
        const allKeys = new Set([...Object.keys(oldValues), ...Object.keys(newValues)]);

        // Fields to exclude from changes display
        const excludedFields = ['condition', 'previous_maintenance', 'last_maintenance'];

        // Group changes by category
        const categories = {
            'Hardware': ['type', 'processor', 'ram', 'gpu', 'surge_protector'],
            'Software': ['os'],
            'Assignment': ['office', 'user'],
            'Peripherals': ['peripherals']
        };

        const categorizedChanges = {};

        for (const key of allKeys) {
            if (excludedFields.includes(key.toLowerCase())) continue;

            const oldVal = oldValues[key];
            const newVal = newValues[key];

            if (JSON.stringify(oldVal) !== JSON.stringify(newVal)) {
                let displayKey = key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                if (displayKey === 'User Name') displayKey = 'Employee';

                // Find category
                let category = 'Other';
                for (const [cat, fields] of Object.entries(categories)) {
                    if (fields.includes(key.toLowerCase())) {
                        category = cat;
                        break;
                    }
                }

                if (!categorizedChanges[category]) {
                    categorizedChanges[category] = [];
                }

                if (oldVal === undefined) {
                    // Added
                    const displayValue = formatFieldValue(newVal, displayKey);
                    categorizedChanges[category].push(`<div class="flex items-start gap-2 text-xs">
                        <span class="text-green-600 font-medium min-w-[60px]">Added:</span>
                        <span class="text-green-800">${displayKey} → ${displayValue}</span>
                    </div>`);
                } else if (newVal === undefined) {
                    // Removed
                    const displayValue = formatFieldValue(oldVal, displayKey);
                    categorizedChanges[category].push(`<div class="flex items-start gap-2 text-xs">
                        <span class="text-red-600 font-medium min-w-[60px]">Removed:</span>
                        <span class="text-red-800">${displayKey} → ${displayValue}</span>
                    </div>`);
                } else {
                    // Special handling for peripherals - compare individual items
                    if (displayKey === 'Peripherals') {
                        const oldPeripherals = Array.isArray(oldVal) ? oldVal : (typeof oldVal === 'string' && oldVal.startsWith('[') ? JSON.parse(oldVal) : []);
                        const newPeripherals = Array.isArray(newVal) ? newVal : (typeof newVal === 'string' && newVal.startsWith('[') ? JSON.parse(newVal) : []);

                        // Find added peripherals
                        const added = newPeripherals.filter(newP => {
                            return !oldPeripherals.some(oldP =>
                                oldP.type === newP.type &&
                                oldP.details === newP.details
                            );
                        });

                        // Find removed peripherals
                        const removed = oldPeripherals.filter(oldP => {
                            return !newPeripherals.some(newP =>
                                oldP.type === newP.type &&
                                oldP.details === newP.details &&
                                oldP.condition === newP.condition
                            );
                        });

                        // Add individual peripheral changes
                        added.forEach(peripheral => {
                            const displayValue = formatFieldValue([peripheral], 'Peripherals');
                            categorizedChanges[category].push(`<div class="text-xs">
                                <span class="text-green-600 font-medium">Added:</span>
                                <span class="text-green-800 ml-2">${displayValue}</span>
                            </div>`);
                        });

                        removed.forEach(peripheral => {
                            const displayValue = formatFieldValue([peripheral], 'Peripherals');
                            categorizedChanges[category].push(`<div class="text-xs">
                                <span class="text-red-600 font-medium">Removed:</span>
                                <span class="text-red-800 ml-2">${displayValue}</span>
                            </div>`);
                        });
                    } else {
                        // Modified - regular fields
                        const displayOldVal = formatFieldValue(oldVal, displayKey);
                        const displayNewVal = formatFieldValue(newVal, displayKey);

                        // Only show if values are actually different when formatted
                        if (displayOldVal !== displayNewVal) {
                            // Format the modification timestamp
                            const modTime = new Date(createdAt).toLocaleString('en-US', {
                                month: 'short',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                            categorizedChanges[category].push(`<div class="text-xs">
                                <span class="text-blue-600 font-medium">Modified:</span>
                                <span class="text-blue-800 ml-2">${displayKey}</span>
                                <span class="text-gray-500 text-xs ml-4">(${modTime})</span>
                            </div>`);
                        }
                    }
                }
            }
        }

        // Build categorized output
        const categoryOrder = ['Assignment', 'Hardware', 'Software', 'Peripherals', 'Other'];
        let output = '';

        for (const category of categoryOrder) {
            if (categorizedChanges[category] && categorizedChanges[category].length > 0) {
                output += `<div class="mb-3">
                    <div class="text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">${category}</div>
                    <div class="space-y-1 pl-2 border-l-2 border-gray-200">
                        ${categorizedChanges[category].join('')}
                    </div>
                </div>`;
            }
        }

        if (output === '') {
            return '<p class="text-gray-500 text-xs">No meaningful changes detected</p>';
        }

        return `<div class="space-y-3">${output}</div>`;
    }

    function formatFieldValue(value, fieldName) {
        if (value === null || value === '') return '<span class="italic">Empty</span>';

        // Special handling for employee names - display on separate lines
        if (fieldName === 'Employees name' && typeof value === 'string') {
            return value.split(', ').join('<br>');
        }

        // Special handling for peripherals
        if (fieldName === 'Peripherals') {
            if (Array.isArray(value)) {
                return value.map(peripheral => {
                    if (typeof peripheral === 'object' && peripheral !== null) {
                        const parts = [];
                        if (peripheral.type) parts.push(`${peripheral.type}`);
                        if (peripheral.details) parts.push(`${peripheral.details}`);
                        return parts.join(' - ') || '[Empty Peripheral]';
                    }
                    return String(peripheral);
                }).join('<br>');
            } else if (typeof value === 'string' && value.startsWith('[')) {
                try {
                    const parsed = JSON.parse(value);
                    if (Array.isArray(parsed)) {
                        return parsed.map(peripheral => {
                            if (typeof peripheral === 'object' && peripheral !== null) {
                                const parts = [];
                                if (peripheral.type) parts.push(`${peripheral.type}`);
                                if (peripheral.details) parts.push(`${peripheral.details}`);
                                return parts.join(' - ') || '[Empty Peripheral]';
                            }
                            return String(peripheral);
                        }).join('<br>');
                    }
                } catch (e) {
                    return value;
                }
            }
        }

        // Format dates if this is a date/time field
        if (fieldName.toLowerCase().includes('date') || fieldName.toLowerCase().includes('time') ||
            fieldName.toLowerCase().includes('created') || fieldName.toLowerCase().includes('updated')) {
            if (value) {
                try {
                    const date = new Date(value);
                    if (!isNaN(date.getTime())) {
                        return date.toLocaleString('en-US', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                            hour12: true
                        });
                    }
                } catch (e) {
                    // Return as is if formatting fails
                }
            }
        }

        return value;
    }

    const oldValues = decodeAndParse(oldValuesEncoded);
    const newValues = decodeAndParse(newValuesEncoded);

    content.innerHTML = `
        <div class="space-y-6">
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <h4 class="font-semibold text-blue-800 mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    What Changed
                    <span class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold rounded-full
                        ${action == 'CREATE' ? 'bg-green-100 text-green-800' :
                          action == 'UPDATE' ? 'bg-blue-100 text-blue-800' :
                          'bg-red-100 text-red-800'}">
                        ${action == 'CREATE' ? '<svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>' :
                          action == 'UPDATE' ? '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>' :
                          '<svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>'}
                        ${action}
                    </span>
                </h4>
                <div class="space-y-2">
                    ${generateDiffView(oldValues, newValues, createdAt)}
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                    <h4 class="font-semibold text-red-800 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        Before Changes
                    </h4>
                    <div class="bg-white p-3 rounded border max-h-60 overflow-y-auto">
                        ${formatValues(oldValues)}
                    </div>
                </div>
                <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                    <h4 class="font-semibold text-green-800 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        After Changes
                    </h4>
                    <div class="bg-white p-3 rounded border max-h-60 overflow-y-auto">
                        ${formatValues(newValues)}
                    </div>
                </div>
            </div>
        </div>
    `;

    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('changesModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('changesModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection