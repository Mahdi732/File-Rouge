<div id="error-notification">
    <div class="mt-2 bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded-r-lg">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            @if(isset($error))
            <span class="text-red-800 font-medium">{{ $error }}</span>
            @endif
        </div>
    </div>
</div>
<script>
    setTimeout(() => {
      document.getElementById('error-notification').innerHTML = '';
    }, 5000);
</script>