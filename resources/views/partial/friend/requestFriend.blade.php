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
        <span class="px-3 py-1 bg-orange-500/90 text-white rounded-full text-xs font-medium shadow-sm">3d ago</span>
      </div>
  
      <div class="mt-5 pl-2 border-l-2 border-orange-400">
        <p class="text-orange-50 italic">"{{$request->bio ? $request->bio : "there's no description for this user"}}"</p>
      </div>
  
      <div class="mt-6 flex space-x-3">
        <button class="flex-1 flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white py-2.5 rounded-lg transition-all duration-200 transform group-hover:scale-[1.02]">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
          </svg>
          Accept
        </button>
        <button class="flex-1 bg-transparent hover:bg-white/20 text-white py-2.5 rounded-lg transition-all border border-white/30">
          Decline
        </button>
      </div>
    </div>
  </div>
  @endforeach