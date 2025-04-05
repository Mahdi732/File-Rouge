@if ($requests->isEmpty())
<div class="bg-white rounded-xl p-8 text-center border border-gray-100 hover:border-gray-200 transition-all duration-300">
    <!-- Minimalist SVG Icon (Thinner strokes, precise) -->
    <div class="mx-auto w-20 h-20 mb-5 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="text-gray-300/90 w-14 h-14">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2-4a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
        </svg>
    </div>
    
    <!-- Typography Hierarchy (Perfect contrast) -->
    <div class="space-y-2">
        <h3 class="text-xl font-semibold text-gray-900 tracking-tight">All Caught Up</h3>
        <p class="text-gray-500/90 text-sm max-w-[240px] mx-auto leading-snug">
            When someone sends a request, it’ll show up here.
        </p>
    </div>
</div>
@endif
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<div id="friend_request" class="fixed top-4 left-0 right-0 z-50 flex justify-center pointer-events-none"></div>
@foreach($requests as $request)
<div class="relative rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow duration-300">
    <!-- Background with gradient overlay -->
    <div 
      class="absolute inset-0 bg-[url('{{$request->background_image ? asset('storage/' . $request->background_image) : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9zLLURPoXWGgSacq-v3HjFv0oHmEHVA8rFA&s"}}')] bg-cover bg-center"
      style="filter: brightness(0.7)">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
    
    <!-- Content -->
    <div class="relative z-10 p-6 text-white">
      <div class="flex items-start justify-between">
        <div class="flex items-center">
          <div class="w-16 h-16 rounded-full overflow-hidden mr-4 border-4 border-white/80 shadow-lg">
            <img src="{{$request->profile_picture ? asset('storage/' . $request->profile_picture) : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"}}" alt="James Wilson" class="w-full h-full object-cover">
          </div>
          <div>
            <h3 class="font-bold text-xl">{{ $request->name}}</h3>
            <div class="flex items-center mt-1">
              <p class="text-orange-100 text-sm">{{ '@' .  $request->user_name }}</p>
            </div>
          </div>
        </div>
        <span class="px-3 py-1 bg-orange-500/90 text-white rounded-full text-xs font-medium shadow-sm">{{\Carbon\Carbon::parse($request->created_at)->diffForHumans()}}</span>
      </div>
  
      <div class="mt-5 pl-2 border-l-2 border-orange-400">
        <p class="text-orange-50 italic">"{{$request->bio ? $request->bio : "there's no description for this user"}}"</p>
      </div>
  
      <div class="mt-6 flex gap-3">
        <form 
          hx-post="{{ route('accept.request.friend', $request->request_id) }}"
          hx-target="#friend_request"
          class="flex-1"
        >
        @csrf
        @method('PATCH')
          <button class="w-full flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-medium py-2.5 px-4 rounded-lg transition-all duration-200 hover:shadow-md active:scale-[0.98]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Accept
          </button>
        </form>
        <form 
          hx-post="{{ route('reject.request.friend', $request->request_id) }}"
          hx-target="#friend_request"
          class="flex-1"
        >
        @csrf
        @method('DELETE')
          <button class="w-full py-2.5 px-4 rounded-lg border border-gray-300 bg-white text-gray-700 font-medium hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 active:scale-[0.98]">
            Decline
          </button>
        </form>
      </div>
    </div>
  </div>
  @endforeach
</div>