    @extends('layouts.app')

@section('title', 'Create Asset - One Track')

@section('content')
<div class="bg-white shadow-xl rounded-3xl p-6 sm:p-8 border border-gray-200 max-w-3xl mx-auto">
    <div class="bg-gray-100 px-4 sm:px-6 border-b border-gray-200 mb-6 p-6 sm:pb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-1">Create New Asset</h2>
        <p class="text-gray-600">Fill in the details to add a new asset to the system.</p>
    </div>
    <form action="{{ route('assets.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Office</label>
                <input type="text" name="office"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Employee</label>
                <input type="text" name="user"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Type</label>
                <div class="relative">
                    <select name="type" class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400 bg-white appearance-none">
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
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Operating System</label>
                <input type="text" name="os"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Processor</label>
                <input type="text" name="processor"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">RAM</label>
                <input type="text" name="ram"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">GPU</label>
                <input type="text" name="gpu"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Surge Protector</label>
                <div class="relative">
                    <select name="surge_protector" class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out hover:border-gray-400 bg-white appearance-none">
                        <option value="">None</option>
                        <option>UPS</option>
                        <option>AVR</option>
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
        </div>

        <!-- Peripherals Section -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-4">Peripherals</label>
            <div id="peripherals-container">
                <!-- Dynamic peripheral inputs will be added here -->
            </div>
            <button type="button" id="add-peripheral" class="mt-2 inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Peripheral
            </button>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create Asset
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let peripheralIndex = 0;

    function createPeripheralInput(index) {
        return `
            <div class="peripheral-item flex gap-4 items-end mb-4 p-4 border border-gray-200 rounded-xl bg-gray-50">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                    <select name="peripherals[${index}][type]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Type</option>
                        <option value="Printer">Printer</option>
                        <option value="Mouse">Mouse</option>
                        <option value="Keyboard">Keyboard</option>
                        <option value="Speaker">Speaker</option>
                        <option value="Headset">Headset</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Details</label>
                    <input type="text" name="peripherals[${index}][details]" placeholder="Model/Serial/Description"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Condition</label>
                    <select name="peripherals[${index}][condition]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Condition</option>
                        <option value="working">Working</option>
                        <option value="needs repair">Needs Repair</option>
                        <option value="broken">Broken</option>
                    </select>
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

    // Add one initial peripheral input
    document.getElementById('add-peripheral').click();
});
</script>
@endsection