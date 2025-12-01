@extends('layouts.app')

@section('title', 'History Logs - One Track')

@section('content')
<div class="bg-white shadow-xl rounded-3xl p-6 sm:p-8 border border-gray-200 max-w-7xl mx-auto">
    <div class="bg-gray-100 px-4 sm:px-6 border-b border-gray-200 mb-6 p-6 sm:pb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-1">History Logs</h2>
        <p class="text-gray-600">Complete audit trail of all system activities.</p>
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
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11 5H9a1 1 0 00-1 1v3H6a1 1 0 00-1 1v3a1 1 0 001 1h3v3a1 1 0 001 1h2a1 1 0 001-1v-3h3a1 1 0 001-1V9a1 1 0 00-1-1h-3V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
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
                            <button onclick="showChanges(this)" data-log-id="{{ $log->id }}" data-old-values="{{ $log->old_values ? base64_encode(json_encode($log->old_values)) : '' }}" data-new-values="{{ $log->new_values ? base64_encode(json_encode($log->new_values)) : '' }}" class="text-blue-600 hover:text-blue-800 underline">
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
        if (!values) return 'No data available';
        return JSON.stringify(values, null, 2);
    }

    function generateDiffView(oldValues, newValues) {
        if (!oldValues && !newValues) return '<p class="text-gray-500">No data available</p>';
        if (!oldValues) return `<pre class="text-xs bg-green-50 p-3 rounded border-l-4 border-green-400 text-green-800">${formatValues(newValues)}</pre>`;
        if (!newValues) return `<pre class="text-xs bg-red-50 p-3 rounded border-l-4 border-red-400 text-red-800">${formatValues(oldValues)}</pre>`;

        const changes = [];
        const allKeys = new Set([...Object.keys(oldValues), ...Object.keys(newValues)]);

        for (const key of allKeys) {
            const oldVal = oldValues[key];
            const newVal = newValues[key];

            if (JSON.stringify(oldVal) !== JSON.stringify(newVal)) {
                if (oldVal === undefined) {
                    // Added
                    changes.push(`<div class="mb-2 p-2 bg-green-50 border-l-4 border-green-400 rounded">
                        <span class="text-green-800 font-semibold text-xs">ADDED:</span>
                        <span class="text-green-700 font-medium">${key}:</span>
                        <span class="text-green-600">${JSON.stringify(newVal)}</span>
                    </div>`);
                } else if (newVal === undefined) {
                    // Removed
                    changes.push(`<div class="mb-2 p-2 bg-red-50 border-l-4 border-red-400 rounded">
                        <span class="text-red-800 font-semibold text-xs">REMOVED:</span>
                        <span class="text-red-700 font-medium">${key}:</span>
                        <span class="text-red-600">${JSON.stringify(oldVal)}</span>
                    </div>`);
                } else {
                    // Changed
                    changes.push(`<div class="mb-2 p-2 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                        <span class="text-yellow-800 font-semibold text-xs">CHANGED:</span>
                        <span class="text-yellow-700 font-medium">${key}</span>
                        <div class="mt-1 text-xs">
                            <div class="text-red-600">From: ${JSON.stringify(oldVal)}</div>
                            <div class="text-green-600">To: ${JSON.stringify(newVal)}</div>
                        </div>
                    </div>`);
                }
            }
        }

        if (changes.length === 0) {
            return '<p class="text-gray-500">No changes detected</p>';
        }

        return changes.join('');
    }

    const oldValues = decodeAndParse(oldValuesEncoded);
    const newValues = decodeAndParse(newValuesEncoded);

    content.innerHTML = `
        <div class="space-y-4">
            <div class="bg-gray-50 p-4 rounded border-l-4 border-gray-400">
                <h4 class="font-semibold text-gray-800 mb-3">Changes Summary:</h4>
                <div class="space-y-2">
                    ${generateDiffView(oldValues, newValues)}
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-red-50 p-4 rounded border-l-4 border-red-400">
                    <h4 class="font-semibold text-red-800 mb-2">Before:</h4>
                    <pre class="text-xs bg-white p-3 rounded border overflow-x-auto text-gray-800 max-h-40 overflow-y-auto">${formatValues(oldValues)}</pre>
                </div>
                <div class="bg-green-50 p-4 rounded border-l-4 border-green-400">
                    <h4 class="font-semibold text-green-800 mb-2">After:</h4>
                    <pre class="text-xs bg-white p-3 rounded border overflow-x-auto text-gray-800 max-h-40 overflow-y-auto">${formatValues(newValues)}</pre>
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