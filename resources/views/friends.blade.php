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
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Friend Request Card 1 -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
          <div class="p-5">
            <div class="flex items-start justify-between">
              <div class="flex items-center">
                <div class="w-14 h-14 rounded-full overflow-hidden mr-4">
                  <img src="/api/placeholder/200/200" alt="Sarah Johnson" class="w-full h-full object-cover">
                </div>
                <div>
                  <h3 class="font-semibold text-gray-800">Sarah Johnson</h3>
                  <p class="text-sm text-gray-500">Pastry Chef • New York</p>
                  <p class="text-xs text-gray-500 mt-1">5 mutual friends</p>
                </div>
              </div>
              <div class="flex flex-col space-y-2">
                <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs">2d ago</span>
              </div>
            </div>
            <div class="mt-4">
              <p class="text-sm text-gray-600">Sarah specializes in French pastry and has 10+ popular dessert recipes.</p>
            </div>
            <div class="mt-4 flex space-x-2">
              <button class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg transition-colors pulse-hover">Accept</button>
              <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg transition-colors">Decline</button>
            </div>
          </div>
        </div>
        
        <!-- Friend Request Card 2 -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
          <div class="p-5">
            <div class="flex items-start justify-between">
              <div class="flex items-center">
                <div class="w-14 h-14 rounded-full overflow-hidden mr-4">
                  <img src="/api/placeholder/200/200" alt="Michael Chen" class="w-full h-full object-cover">
                </div>
                <div>
                  <h3 class="font-semibold text-gray-800">Michael Chen</h3>
                  <p class="text-sm text-gray-500">Home Cook • San Francisco</p>
                  <p class="text-xs text-gray-500 mt-1">3 mutual friends</p>
                </div>
              </div>
              <div class="flex flex-col space-y-2">
                <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs">5h ago</span>
              </div>
            </div>
            <div class="mt-4">
              <p class="text-sm text-gray-600">Michael loves Asian fusion cuisine and shares weekly recipe videos.</p>
            </div>
            <div class="mt-4 flex space-x-2">
              <button class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg transition-colors pulse-hover">Accept</button>
              <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg transition-colors">Decline</button>
            </div>
          </div>
        </div>
        
        <!-- Friend Request Card 3 -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
          <div class="p-5">
            <div class="flex items-start justify-between">
              <div class="flex items-center">
                <div class="w-14 h-14 rounded-full overflow-hidden mr-4">
                  <img src="/api/placeholder/200/200" alt="Emma Rodriguez" class="w-full h-full object-cover">
                </div>
                <div>
                  <h3 class="font-semibold text-gray-800">Emma Rodriguez</h3>
                  <p class="text-sm text-gray-500">Food Blogger • Miami</p>
                  <p class="text-xs text-gray-500 mt-1">7 mutual friends</p>
                </div>
              </div>
              <div class="flex flex-col space-y-2">
                <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs">1d ago</span>
              </div>
            </div>
            <div class="mt-4">
              <p class="text-sm text-gray-600">Emma creates healthy Mediterranean dishes with a Latin twist.</p>
            </div>
            <div class="mt-4 flex space-x-2">
              <button class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg transition-colors pulse-hover">Accept</button>
              <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg transition-colors">Decline</button>
            </div>
          </div>
        </div>
        
        <!-- Friend Request Card 4 -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
          <div class="p-5">
            <div class="flex items-start justify-between">
              <div class="flex items-center">
                <div class="w-14 h-14 rounded-full overflow-hidden mr-4">
                  <img src="/api/placeholder/200/200" alt="James Wilson" class="w-full h-full object-cover">
                </div>
                <div>
                  <h3 class="font-semibold text-gray-800">James Wilson</h3>
                  <p class="text-sm text-gray-500">BBQ Enthusiast • Austin</p>
                  <p class="text-xs text-gray-500 mt-1">2 mutual friends</p>
                </div>
              </div>
              <div class="flex flex-col space-y-2">
                <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs">3d ago</span>
              </div>
            </div>
            <div class="mt-4">
              <p class="text-sm text-gray-600">James is known for his smoked meat recipes and homemade BBQ sauces.</p>
            </div>
            <div class="mt-4 flex space-x-2">
              <button class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg transition-colors pulse-hover">Accept</button>
              <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg transition-colors">Decline</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- People You May Know Tab -->
    <div x-show="activeTab === 'suggestions'" class="space-y-6">
      <!-- Search and Filter -->
      <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h2 class="text-xl font-semibold text-gray-800">People You May Know</h2>
        <div class="flex flex-col sm:flex-row gap-3">
            <form 
            hx-get="{{ route('search.friend') }}"
            hx-target="#fiend_add_response"
            hx-swap="innerHTML"
            hx-trigger="keyup changed delay:200ms"
            >
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
                <div class="absolute inset-0 opacity-50 bg-center bg-cover" style="background-image: url('https://img.uhdpaper.com/wallpaper/anime-girl-fantasy-art-635@0@f-thumb.jpg?dl')"></div>
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
          <!-- Friend Card 1 -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
            <div class="p-5">
              <div class="flex items-start justify-between">
                <div class="flex items-center">
                  <div class="w-14 h-14 rounded-full overflow-hidden mr-4">
                    <img src="/api/placeholder/200/200" alt="Thomas Wright" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <h3 class="font-semibold text-gray-800">Thomas Wright</h3>
                    <p class="text-sm text-gray-500">Sous Chef • Boston</p>
                    <div class="flex space-x-1 mt-1">
                      <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded-full text-xs">Seafood</span>
                    </div>
                  </div>
                </div>
                <div class="relative" x-data="{ open: false }">
                  <button @click="open = !open" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-ellipsis-v"></i>
                  </button>
                  <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-10">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-100">View Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-100">Send Message</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-100">Unfriend</a>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <p class="text-sm text-gray-600">Active 5 hours ago</p>
              </div>
              <div class="mt-4 flex space-x-2">
                <button class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg transition-colors">
                  <i class="fas fa-envelope mr-2"></i> Message
                </button>
                <button class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center transition-colors">
                  <i class="fas fa-user-tag text-gray-600"></i>
                </button>
              </div>
            </div>
          </div>
          
          <!-- Friend Card 2 -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
            <div class="p-5">
              <div class="flex items-start justify-between">
                <div class="flex items-center">
                  <div class="w-14 h-14 rounded-full overflow-hidden mr-4 relative">
                    <img src="/api/placeholder/200/200" alt="Rachel Green" class="w-full h-full object-cover">
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                  </div>
                  <div>
                    <h3 class="font-semibold text-gray-800">Rachel Green</h3>
                    <p class="text-sm text-gray-500">Pastry Chef • Denver</p>
                    <div class="flex space-x-1 mt-1">
                      <span class="px-2 py-0.5 bg-yellow-100 text-yellow-800 rounded-full text-xs">Baking</span>
                    </div>
                  </div>
                </div>
                <div class="relative" x-data="{ open: false }">
                  <button @click="open = !open" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-ellipsis-v"></i>
                  </button>
                  <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-10">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-100">View Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-100">Send Message</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-100">Unfriend</a>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <p class="text-sm text-gray-600">Currently online</p>
              </div>
              <div class="mt-4 flex space-x-2">
                <button class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg transition-colors">
                  <i class="fas fa-envelope mr-2"></i> Message
                </button>
                <button class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center transition-colors">
                  <i class="fas fa-user-tag text-gray-600"></i>
                </button>
              </div>
            </div>
          </div>
          
          <!-- Friend Card 3 -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
            <div class="p-5">
              <div class="flex items-start justify-between">
                <div class="flex items-center">
                  <div class="w-14 h-14 rounded-full overflow-hidden mr-4">
                    <img src="/api/placeholder/200/200" alt="Hiroshi Tanaka" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <h3 class="font-semibold text-gray-800">Hiroshi Tanaka</h3>
                    <p class="text-sm text-gray-500">Sushi Chef • Tokyo</p>
                    <div class="flex space-x-1 mt-1">
                      <span class="px-2 py-0.5 bg-purple-100 text-purple-800 rounded-full text-xs">Japanese</span>
                    </div>
                  </div>
                </div>
                <div class="relative" x-data="{ open: false }">
                  <button @click="open = !open" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-ellipsis-v"></i>
                  </button>
                  <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-10">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-100">View Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-100">Send Message</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-100">Unfriend</a>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <p class="text-sm text-gray-600">Active 2 days ago</p>
              </div>
              <div class="mt-4 flex space-x-2">
                <button class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg transition-colors">
                  <i class="fas fa-envelope mr-2"></i> Message
                </button>
                <button class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center transition-colors">
                  <i class="fas fa-user-tag text-gray-600"></i>
                </button>
              </div>
            </div>
          </div>
          
          <!-- Friend Card 4 -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
            <div class="p-5">
              <div class="flex items-start justify-between">
                <div class="flex items-center">
                  <div class="w-14 h-14 rounded-full overflow-hidden mr-4 relative">
                    <img src="/api/placeholder/200/200" alt="Maria Garcia" class="w-full h-full object-cover">
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                  </div>
                  <div>
                    <h3 class="font-semibold text-gray-800">Maria Garcia</h3>
                    <p class="text-sm text-gray-500">Chocolatier • Barcelona</p>
                    <div class="flex space-x-1 mt-1">
                      <span class="px-2 py-0.5 bg-pink-100 text-pink-800 rounded-full text-xs">Desserts</span>
                    </div>
                  </div>
                </div>
                <div class="relative" x-data="{ open: false }">
                  <button @click="open = !open" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-ellipsis-v"></i>
                  </button>
                  <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-10">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-100">View Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-100">Send Message</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-100">Unfriend</a>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <p class="text-sm text-gray-600">Currently online</p>
              </div>
              <div class="mt-4 flex space-x-2">
                <button class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg transition-colors">
                  <i class="fas fa-envelope mr-2"></i> Message
                </button>
                <button class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center transition-colors">
                  <i class="fas fa-user-tag text-gray-600"></i>
                </button>
              </div>
            </div>
          </div>
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