<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CookNShare - Friend Requests</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/htmx.org@2.0.4"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.0/cdn.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.05);
      }
    }
    
    .pulse-hover:hover {
      animation: pulse 1s infinite;
    }
    
    .card-hover {
      transition: all 0.3s ease;
    }
    
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen" x-data="{ mobileMenu: false }">
  @if (View::exists('partial.nav'))
    @include('partial.nav')
  @endif
  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ activeTab: 'requests' }">
    <!-- Page Title -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-800">Find Friends</h1>
      <p class="text-gray-600 mt-2">Connect with other food enthusiasts and expand your culinary network</p>
    </div>
    
    <!-- Tabs -->
    <div class="border-b border-gray-200 mb-6">
      <nav class="flex space-x-8">
        <button 
          @click="activeTab = 'requests'" 
          class="px-1 py-4 text-center border-b-2 transition-colors font-medium text-sm"
          :class="activeTab === 'requests' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
        >
          Friend Requests
          <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-orange-100 text-orange-800">4</span>
        </button>
        <button 
          @click="activeTab = 'suggestions'" 
          class="px-1 py-4 text-center border-b-2 transition-colors font-medium text-sm"
          :class="activeTab === 'suggestions' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
        >
          People You May Know
        </button>
        <button 
          @click="activeTab = 'friends'" 
          class="px-1 py-4 text-center border-b-2 transition-colors font-medium text-sm"
          :class="activeTab === 'friends' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
        >
          Your Friends
        </button>
      </nav>
    </div>
    
    <!-- Friend Requests Tab -->
    <div x-show="activeTab === 'requests'" class="space-y-6">
      <!-- Search Section -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Friend Requests</h2>
        <div class="relative">
          <input type="text" placeholder="Search requests..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
          <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
      </div>
      
      <!-- Friend Request List -->
        @if (View::exists('partial.friend.requestFriend'))
        @include('partial.friend.requestFriend')
       @endif
    </div>
    
    <!-- People You May Know Tab -->
    <div x-show="activeTab === 'suggestions'" class="space-y-6">
      <!-- Search and Filter -->
      <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h2 class="text-xl font-semibold text-gray-800">People You May Know</h2>
        <div class="flex flex-col sm:flex-row gap-3">
            <form 
            hx-post="{{ route('search.friend') }}"
            hx-target="#fiend_add_response"
            hx-swap="outerHTML"
            hx-trigger="keyup changed delay:200ms"
            >
            @csrf
              <div class="relative">
              <input name="search_for_friend_input" type="text" placeholder="Search people..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
              <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            </form>
          <select class="pl-4 pr-8 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none appearance-none bg-white">
            <option>All Interests</option>
            <option>Baking</option>
            <option>Grilling</option>
            <option>Vegan</option>
            <option>International</option>
          </select>
        </div>
      </div>
      
      <!-- Suggestions Grid -->
      <div id="fiend_add_response" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Suggestion Card  -->
        @foreach ($users as $user)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
                <div class="h-32 bg-orange-50 relative">
                  <div class="absolute inset-0 bg-center bg-cover" 
                  style="background-image: url('{{ $user->background_image ? asset('storage/' . $user->background_image) : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9zLLURPoXWGgSacq-v3HjFv0oHmEHVA8rFA&s" }}');">
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
                      <form 
                      hx-post="{{ route('addFriend.friend', $user->id)}}"
                      hx-target="#send_request">
                      @csrf
                        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg transition-colors">
                          <i class="fas fa-user-plus mr-2"></i> Add Friend
                      </button>
                      </form>
                      <div id="send_request" class="fixed top-4 left-0 right-0 z-50 flex justify-center pointer-events-none"></div>
                    </div>
                </div>
                </div>
          </div>
        @endforeach
      </div>
    </div>
    <div x-show="activeTab === 'friends'" class="space-y-6">
        <!-- Search and Filter -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
          <h2 class="text-xl font-semibold text-gray-800">Your Friends</h2>
          <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative">
              <input type="text" placeholder="Search friends..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
              <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <select class="pl-4 pr-8 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none appearance-none bg-white">
              <option>All Friends</option>
              <option>Recent Activity</option>
              <option>Newest Friends</option>
              <option>Alphabetical</option>
            </select>
          </div>
        </div>
        
        <!-- Friends List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
          <!-- Friend Card  -->
          @foreach ($friends as $friend)
          <div class="relative h-[15rem] rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow duration-300">
            <!-- Background with gradient overlay -->
            <div 
              class="absolute inset-0 bg-[url('{{$friend->background_image ? asset('storage/' . $friend->background_image) : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9zLLURPoXWGgSacq-v3HjFv0oHmEHVA8rFA&s"}}')] bg-cover bg-center"
              style="filter: brightness(0.7)">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            
            <!-- Content -->
            <div class="relative z-10 p-6 text-white">
              <div class="flex items-start justify-between">
                <div class="flex items-center">
                  <div class="w-16 h-16 rounded-full overflow-hidden mr-4 border-4 border-white/80 shadow-lg">
                    <img src="{{$friend->profile_picture ? asset('storage/' . $friend->profile_picture) : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"}}" alt="Profile Picture" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <h3 class="font-bold text-xl">{{ $friend->name}}</h3>
                    <div class="flex items-center mt-1">
                      <p class="text-orange-100 text-sm">{{ '@' .  $friend->user_name }}</p>
                    </div>
                  </div>
                </div>
                <span class="px-3 py-1 bg-orange-500/90 text-white rounded-full text-xs font-medium shadow-sm">{{\Carbon\Carbon::parse($friend->created_at)->diffForHumans()}}</span>
              </div>
          
              <div class="mt-5 pl-2 border-l-2 border-orange-400">
                <p class="text-orange-50 italic">"{{$friend->bio ? $friend->bio : "there's no description for this user"}}"</p>
              </div>

            </div>
          </div>
          @endforeach
        </div>
        
        <!-- Load More Button -->
        <div class="mt-6 text-center">
          <button class="px-6 py-3 bg-white border border-orange-500 text-orange-500 rounded-lg hover:bg-orange-50 transition-colors">
            View All Friends
          </button>
        </div>
      </div>
    </main>
    @if (View::exists('partial.fotter'))
    @include('partial.fotter')
    @endif
  </body>
  </html>