<div id="success-notification">
    <div class="mt-2 bg-green-50 border-l-4 border-green-500 text-green-700 p-3 rounded-r-lg">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="text-green-800 font-medium">Your profile has been successfully updated!</span>
        </div>
    </div>
</div>
<script>
    setTimeout(() => {
      document.getElementById('success-notification').innerHTML = '';
    }, 5000);
</script>