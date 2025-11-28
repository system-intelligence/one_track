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

<div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50 text-gray-700 uppercase text-xs tracking-wider">
            <tr>
                <th class="px-4 py-3 text-center">No.</th>
                <th class="px-4 py-3 text-left">Last Maintenance</th>
                <th class="px-4 py-3 text-left">Office</th>
                <th class="px-4 py-3 text-left">User</th>
                <th class="px-4 py-3 text-left">Type</th>
                <th class="px-4 py-3 text-left">OS</th>
                <th class="px-4 py-3 text-left hidden md:table-cell">Processor</th>
                <th class="px-4 py-3 text-left hidden md:table-cell">RAM</th>
                <th class="px-4 py-3 text-left hidden lg:table-cell">GPU</th>
                <th class="px-4 py-3 text-left sticky right-16 bg-gray-50">Condition</th>
                <th class="px-4 py-3 text-center sticky right-0 bg-gray-50">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
            @forelse($assets as $asset)
            <tr class="hover:bg-blue-50 transition">
                <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
                <td class="px-4 py-3 max-w-32 truncate">{{ $asset->last_maintenance ? $asset->last_maintenance->format('M d, Y') : '-' }}</td>
                <td class="px-4 py-3 max-w-32 truncate">{{ $asset->office }}</td>
                <td class="px-4 py-3 max-w-32 truncate">{{ $asset->user ?? '-' }}</td>
                <td class="px-4 py-3 max-w-24 truncate">{{ $asset->type }}</td>
                <td class="px-4 py-3 max-w-24 truncate">{{ $asset->os ?? '-' }}</td>
                <td class="px-4 py-3 hidden md:table-cell max-w-40 truncate">{{ $asset->processor ?? '-' }}</td>
                <td class="px-4 py-3 hidden md:table-cell max-w-24 truncate">{{ $asset->ram ?? '-' }}</td>
                <td class="px-4 py-3 hidden lg:table-cell max-w-40 truncate">{{ $asset->gpu ?? '-' }}</td>
                <td class="px-4 py-3 sticky right-16 bg-white">
                    <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold
                        {{ $asset->condition == 'Excellent' ? 'text-green-700 bg-green-100' : ($asset->condition == 'Good' ? 'text-yellow-700 bg-yellow-100' : 'text-red-700 bg-red-100') }}
                        rounded-full">
                        {{ $asset->condition == 'Excellent' ? '✔' : '' }} {{ $asset->condition }}
                    </span>
                </td>
                <td class="px-4 py-3 text-center space-x-2 sticky right-0 bg-white">
                    <a href="{{ route('assets.edit', $asset->id) }}"
                        class="p-2 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition shadow-sm"
                        title="Edit">✏️</a>
                    <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this asset?')" class="p-2 rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition shadow-sm" title="Delete">🗑️</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="px-4 py-4 text-center text-gray-500">No assets found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection
