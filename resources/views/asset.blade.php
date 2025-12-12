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
            <input type="text" id="search" placeholder="Search by asset number, employee, or office..."
              class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm" />
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 4a7 7 0 100 14 7 7 0 000-14z"></path>
              </svg>
            </div>
            <button type="button" id="clear-search" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
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
              <option>working</option>
              <option>needs repair</option>
              <option>broken</option>
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

    <!-- Grid Card -->

<div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($assets->isEmpty())
        <div class="col-span-full text-center py-8 text-gray-500">
            @if(request('search'))
                No assets found for search: "{{ request('search') }}"
            @else
                No assets found matching the current filters.
            @endif
        </div>
        @else
        @foreach($assets as $asset)
        <div class="asset-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 hover:border-blue-300 relative overflow-hidden">
            <div class="absolute top-4 right-4">
                <div class="text-sm font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">{{ $asset->id }}</div>
            </div>
            <div class="space-y-4 pr-16">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p><span class="text-sm font-medium text-gray-500">Employee's Name</span></p>
                        <p><span class="text-xl font-bold text-gray-900 truncate">{{ Str::limit($asset->user ?? '-', 20) }}</span></p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p><span class="text-xs font-medium text-gray-500">Type of Office</span></p>
                        <p><span class="text-sm font-medium text-gray-700">{{ $asset->office }}</span></p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p><span class="text-xs font-medium text-gray-500">Type</span></p>
                        <p><span class="text-sm font-medium text-gray-700">{{ $asset->type }}</span></p>
                    </div>
                </div>
                @php
                    $peripheralConditions = ['working' => 0, 'needs repair' => 0, 'broken' => 0];
                    if ($asset->peripherals) {
                        foreach ($asset->peripherals as $peripheral) {
                            $condition = $peripheral['condition'] ?? '';
                            if (isset($peripheralConditions[$condition])) {
                                $peripheralConditions[$condition]++;
                            }
                        }
                    }
                @endphp
                @if($asset->peripherals && count($asset->peripherals) > 0)
                <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                    <p class="text-xs font-medium text-gray-600 mb-2">Peripheral Conditions</p>
                    <div class="flex justify-between text-xs">
                        <span class="text-green-600">Working: {{ $peripheralConditions['working'] }}</span>
                        <span class="text-yellow-600">Needs repair: {{ $peripheralConditions['needs repair'] }}</span>
                        <span class="text-red-600">Broken: {{ $peripheralConditions['broken'] }}</span>
                    </div>
                </div>
                @endif
            </div>
            <div class="flex flex-col sm:flex-row justify-end sm:space-x-3 space-y-3 sm:space-y-0 mt-6 pt-4 border-t border-gray-100">
                <a href="{{ route('assets.edit', $asset->id) }}"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition-all duration-200 border border-blue-200 hover:border-blue-300 w-full sm:w-auto">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this asset?')" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition-all duration-200 border border-red-200 hover:border-red-300 w-full">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    <div id="no-results" class="col-span-full text-center py-8 text-gray-500 hidden">
        search not found
    </div>
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

    // Get current URL parameters
    const urlParams = new URLSearchParams(window.location.search);

    // Set initial values from URL parameters
    const searchParam = urlParams.get('search');
    const officeParam = urlParams.get('office');
    const conditionParam = urlParams.get('condition');
    const typeParam = urlParams.get('type');

    if (searchParam) {
        searchInput.value = searchParam;
    }
    if (officeParam) {
        officeSelect.value = officeParam;
    }
    if (conditionParam) {
        conditionSelect.value = conditionParam;
    }
    if (typeParam) {
        typeSelect.value = typeParam;
    }

    let searchTimeout;

    function updateFilters() {
        const params = new URLSearchParams();
        const search = searchInput.value.trim();
        const office = officeSelect.value;
        const condition = conditionSelect.value;
        const type = typeSelect.value;

        if (search) params.set('search', search);
        if (office !== 'All Offices') params.set('office', office);
        if (condition !== 'All Conditions') params.set('condition', condition);
        if (type !== 'All Types') params.set('type', type);

        const url = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
        window.location.href = url;
    }

    officeSelect.addEventListener('change', updateFilters);
    conditionSelect.addEventListener('change', updateFilters);
    typeSelect.addEventListener('change', updateFilters);

    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            updateFilters();
        }
    });

    document.getElementById('clear-search').addEventListener('click', function() {
        searchInput.value = '';
        updateFilters();
    });
});
</script>

