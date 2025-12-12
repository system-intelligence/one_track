@if(session('success'))
<div class="alert-notification bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 flex items-center justify-between opacity-100 transform translate-y-0 transition-all duration-500 ease-out" role="alert">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    <button class="alert-close ml-4 text-green-600 hover:text-green-800 transition-colors duration-200" aria-label="Close">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>
@endif

@if(session('warning'))
<div class="alert-notification bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded-xl mb-4 flex items-center justify-between opacity-100 transform translate-y-0 transition-all duration-500 ease-out" role="alert">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
        </svg>
        <span class="block sm:inline">{{ session('warning') }}</span>
    </div>
    <button class="alert-close ml-4 text-orange-600 hover:text-orange-800 transition-colors duration-200" aria-label="Close">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert-notification bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4 flex items-center justify-between opacity-100 transform translate-y-0 transition-all duration-500 ease-out" role="alert">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
        </svg>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    <button class="alert-close ml-4 text-red-600 hover:text-red-800 transition-colors duration-200" aria-label="Close">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert-notification');

    function hideAlert(alert) {
        alert.classList.remove('opacity-100', 'translate-y-0');
        alert.classList.add('opacity-0', '-translate-y-2');
        setTimeout(function() {
            alert.style.display = 'none';
        }, 500);
    }

    alerts.forEach(function(alert) {
        // Auto-hide after 3 seconds
        setTimeout(function() {
            hideAlert(alert);
        }, 3000);

        // Close button functionality
        const closeBtn = alert.querySelector('.alert-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                hideAlert(alert);
            });
        }
    });
});
</script>