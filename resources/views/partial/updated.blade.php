<div id="success-notification" class="fixed top-4 left-0 right-0 z-50 flex justify-center pointer-events-none">
    <div class="animate-fade-in-up bg-white shadow-lg rounded-lg border border-green-100 overflow-hidden w-full max-w-md">
        <div class="flex items-start p-4">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            <div class="ml-3 flex-1 pt-0.5">
                <p class="text-sm font-medium text-gray-900">Success!</p>
                @if (isset($update))
                <p class="mt-1 text-sm text-gray-500">{{ $update }}</p>
                @endif
            </div>
            <div class="ml-4 flex-shrink-0 flex">
                <button onclick="document.getElementById('success-notification').remove()" class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="bg-green-500 h-1 w-full"></div>
    </div>
</div>

<script>
    setTimeout(() => {
        const notification = document.getElementById('success-notification');
        if (notification) {
            notification.classList.add('animate-fade-out');
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
</script>

<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.3s ease-out forwards;
    }
    .animate-fade-out {
        animation: fadeOut 0.3s ease-out forwards;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
</style>