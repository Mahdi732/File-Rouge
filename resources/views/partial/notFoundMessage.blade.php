<div id="fiend_add_response" id="no-results" class="text-center py-12 px-4">
    <!-- Illustration -->
    <div class="max-w-xs mx-auto mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-full h-auto text-gray-300">
            <path fill="currentColor" d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0c.41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z"/>
            <path fill="currentColor" d="M12 10h-2v2H9v-2H7V9h2V7h1v2h2v1z" class="text-red-400"/>
        </svg>
    </div>
    
    <!-- Message -->
    <h3 class="text-xl font-medium text-gray-700 mb-2">No results found</h3>
    @if (isset($message))
    <p class="text-gray-500 mb-6">{{$message}}</p>
    @endif
    <!-- Suggestions -->
    <div class="max-w-md mx-auto">
        <p class="text-sm text-gray-500 mb-3">Try searching for:</p>
        <div class="flex flex-wrap justify-center gap-2">
            <button class="px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full transition-colors">Popular items</button>
            <button class="px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full transition-colors">Trending</button>
            <button class="px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full transition-colors">New arrivals</button>
        </div>
    </div>
</div>