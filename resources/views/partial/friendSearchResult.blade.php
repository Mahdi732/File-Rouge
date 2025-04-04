<div id="fiend_add_response" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
@foreach ($users as $user)
<div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
    <div class="h-32 bg-orange-50 relative">
        <div class="absolute inset-0 bg-center bg-cover" 
        style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9zLLURPoXWGgSacq-v3HjFv0oHmEHVA8rFA&s')">
        </div>
       <div class="absolute top-2 right-2">
        <span class="px-2 py-1 bg-white rounded-full text-xs font-medium text-orange-600">87% Match</span>
    </div>
    </div>
    <div class="relative px-4 pt-12 pb-5">
    <div class="absolute -top-10 left-1/2 transform -translate-x-1/2">
        <div class="w-20 h-20 rounded-full border-4 border-white overflow-hidden">
        <img src="{{asset('storage/' . $user->profile_picture)}}" alt="{{$user->name}}" class="w-full h-full object-cover">
        </div>
    </div>
    <div class="text-center">
        <h3 class="font-semibold text-gray-800">{{$user->name}}</h3>
        <p class="text-sm text-gray-500">{{ '@' . $user->user_name}}</p>
        <p class="text-xs text-gray-500 mt-2">10 mutual friends</p>
        <div class="mt-4">
        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg transition-colors">
            <i class="fas fa-user-plus mr-2"></i> Add Friend
        </button>
        </div>
    </div>
    </div>
</div>
@endforeach
</div>