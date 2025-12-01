@extends('layouts.app')

@section('title', 'Assets - One Track')

@section('content')

    <!-- Controls Card -->
    <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-200 space-y-6">

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Search -->
        <div>
          <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Assets</label>
          <div class="relative">
            <input type="text" id="search" placeholder="Search by name..."
              class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm" />
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 4a7 7 0 100 14 7 7 0 000-14z"></path>
              </svg>
            </div>
          </div>
        </div>

        <!-- Office Filter -->
        <div>
          <label for="office" class="block text-sm font-medium text-gray-700 mb-2">Office</label>
          <div class="relative">
            <select id="office"
              class="appearance-none w-full px-4 py-3 pr-10 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
              <option>All Offices</option>
              <option>Kaybiga</option>
              <option>Agency</option>
              <option>Operation</option>
            </select>
            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </div>
        </div>

        <!-- Condition Filter -->
        <div>
          <label for="condition" class="block text-sm font-medium text-gray-700 mb-2">Condition</label>
          <div class="relative">
            <select id="condition"
              class="appearance-none w-full px-4 py-3 pr-10 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
              <option>All Conditions</option>
              <option>Excellent</option>
              <option>Good</option>
              <option>Fair</option>
            </select>
            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </div>
        </div>

        <!-- Type Filter -->
        <div>
          <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
          <div class="relative">
            <select id="type"
              class="appearance-none w-full px-4 py-3 pr-10 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
              <option>All Types</option>
              <option>Laptop</option>
              <option>Desktop</option>
              <option>Monitor</option>
            </select>
            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </div>
        </div>

      </div>

      <!-- Add Button -->
      <div class="flex justify-end">
        <a href="{{ route('assets.create') }}"
          class="inline-flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-semibold shadow-md hover:shadow-xl transition transform hover:scale-[1.02]">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          Add Asset
        </a>
      </div>
    </div>

    <!-- Table Card -->

<div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-x-auto relative">
    <table class="min-w-full divide-y divide-gray-200 text-sm table-fixed">
        <thead class="bg-gray-50 text-gray-700 uppercase text-xs tracking-wider">
            <tr>
                <th class="px-4 py-3 text-center">No.</th>
                <th class="px-4 py-3 text-left">Office</th>
                <th class="px-4 py-3 text-left">User</th>
                <th class="px-4 py-3 text-left">Type</th>
                <th class="px-4 py-3 text-left">OS</th>
                <th class="px-4 py-3 text-left hidden md:table-cell">Processor</th>
                <th class="px-4 py-3 text-left hidden md:table-cell">RAM</th>
                <th class="px-4 py-3 text-left hidden lg:table-cell">GPU</th>
                <th class="px-4 py-3 text-left hidden lg:table-cell">UPS</th>
                <th class="px-4 py-3 text-left hidden lg:table-cell">AVR</th>
                <th class="px-4 py-3 text-left sticky right-16 bg-gray-50">Condition</th>
                <th class="px-4 py-3 text-center sticky right-0 bg-gray-50">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
            @forelse($assets as $asset)
            <tr class="hover:bg-blue-50 transition">
                <td class="px-4 py-3 text-center">{{ $assets->firstItem() + $loop->index }}</td>
                <td class="px-4 py-3 max-w-32 truncate">{{ $asset->office }}</td>
                <td class="px-4 py-3 max-w-32 truncate">{{ $asset->user ?? '-' }}</td>
                <td class="px-4 py-3 max-w-24 truncate">{{ $asset->type }}</td>
                <td class="px-4 py-3 max-w-24 truncate">{{ $asset->os ?? '-' }}</td>
                <td class="px-4 py-3 hidden md:table-cell max-w-40 truncate">{{ $asset->processor ?? '-' }}</td>
                <td class="px-4 py-3 hidden md:table-cell max-w-24 truncate">{{ $asset->ram ?? '-' }}</td>
                <td class="px-4 py-3 hidden lg:table-cell max-w-40 truncate">{{ $asset->gpu ?? '-' }}</td>
                <td class="px-4 py-3 hidden lg:table-cell max-w-40 truncate">{{ $asset->ups ?? '-' }}</td>
                <td class="px-4 py-3 hidden lg:table-cell max-w-40 truncate">{{ $asset->avr ?? '-' }}</td>
                <td class="px-4 py-3 sticky right-16 bg-white">
                    <span class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold rounded-full
                        {{ $asset->condition == 'Excellent' ? 'bg-green-100 text-green-800' : ($asset->condition == 'Good' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        @if($asset->condition == 'Excellent')
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        @elseif($asset->condition == 'Good')
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        @else
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                        {{ $asset->condition }}
                    </span>
                </td>
                <td class="px-4 py-3 sticky right-0 bg-white flex justify-center items-center space-x-2">
                    <a href="{{ route('assets.edit', $asset->id) }}"
                        class="p-3 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition shadow-sm inline-flex items-center justify-center"
                        title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </a>
                    <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this asset?')" class="p-3 rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition shadow-sm inline-flex items-center justify-center" title="Delete">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No assets found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($assets->hasPages())
<div class="mt-6 flex justify-center">
    {{ $assets->links() }}
</div>
@endif


@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const officeSelect = document.getElementById('office');
    const conditionSelect = document.getElementById('condition');
    const typeSelect = document.getElementById('type');
    const tableRows = document.querySelectorAll('tbody tr:not(.empty-row)');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedOffice = officeSelect.value;
        const selectedCondition = conditionSelect.value;
        const selectedType = typeSelect.value;

        tableRows.forEach(row => {
            if (row.cells.length <= 1) return; // Skip empty rows

            const office = row.cells[1].textContent.toLowerCase();
            const user = row.cells[2].textContent.toLowerCase();
            const type = row.cells[3].textContent.toLowerCase();
            const conditionCell = row.cells[10];
            const condition = conditionCell.textContent.trim().toLowerCase();

            const matchesSearch = searchTerm === '' ||
                office.includes(searchTerm) ||
                user.includes(searchTerm) ||
                type.includes(searchTerm);

            const matchesOffice = selectedOffice === 'All Offices' || office === selectedOffice.toLowerCase();
            const matchesCondition = selectedCondition === 'All Conditions' || condition.includes(selectedCondition.toLowerCase());
            const matchesType = selectedType === 'All Types' || type === selectedType.toLowerCase();

            if (matchesSearch && matchesOffice && matchesCondition && matchesType) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Update row numbers
        let visibleIndex = 1;
        tableRows.forEach(row => {
            if (row.style.display !== 'none' && row.cells.length > 1) {
                row.cells[0].textContent = visibleIndex++;
            }
        });
    }

    searchInput.addEventListener('input', filterTable);
    officeSelect.addEventListener('change', filterTable);
    conditionSelect.addEventListener('change', filterTable);
    typeSelect.addEventListener('change', filterTable);
});
</script>
