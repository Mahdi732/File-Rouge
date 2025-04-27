<section class="py-2 bg-gray-200 bg-opacity-30 px-8 flex justify-between">
  <p class="text-gray-100">.</p>
  <p class="text-gray-400">ey449751@gmail.com</p>
</section>

<!-- Header -->
@if(!Auth::check())
<header 
  class="py-4 px-4 sm:px-8 flex justify-between items-center bg-white shadow-sm"
  x-data="{ mobileMenuOpen: false }"
>
  <!-- Logo -->
  <div class="flex items-center">
    <span class="text-orange-500 text-2xl mr-1"><i class="fas fa-utensils"></i></span>
    <h1 class="text-xl font-bold">CookNShare</h1>
  </div>

  <!-- Desktop Navigation -->
  <div class="hidden md:flex items-center gap-6">
    <nav class="flex space-x-6">
      <a href="{{route('home')}}" class="text-gray-600 hover:text-orange-500 transition">Home</a>
      <a href="{{ route('library.recipe') }}" class="text-gray-600 hover:text-orange-500 transition">Library</a>
      <a href="#" class="text-gray-600 hover:text-orange-500 transition">Shop</a>
      <a href="{{ route('post.media') }}" class="text-gray-600 hover:text-orange-500 transition">Community</a>
      <a href="{{ route('friends') }}" class="text-gray-600 hover:text-orange-500 transition">Friends</a>
    </nav>
    <div class="flex space-x-2 ml-4">
      <a href="{{route('login.auth')}}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition">Sign In</a>
      <a href="{{route('login.auth')}}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition">Sign Up</a>
    </div>
  </div>

  <!-- Mobile Menu Button -->
  <button 
    @click="mobileMenuOpen = !mobileMenuOpen"
    class="md:hidden text-gray-600 hover:text-orange-500 focus:outline-none"
    aria-label="Toggle menu"
  >
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path 
        x-show="!mobileMenuOpen"
        stroke-linecap="round" 
        stroke-linejoin="round" 
        stroke-width="2" 
        d="M4 6h16M4 12h16M4 18h16"
      ></path>
      <path 
        x-show="mobileMenuOpen"
        stroke-linecap="round" 
        stroke-linejoin="round" 
        stroke-width="2" 
        d="M6 18L18 6M6 6l12 12"
        class="hidden"
      ></path>
    </svg>
  </button>

  <!-- Mobile Menu -->
  <div 
    x-show="mobileMenuOpen"
    @click.away="mobileMenuOpen = false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="md:hidden absolute top-16 left-0 right-0 bg-white shadow-lg py-2 px-4 z-50"
    style="display: none;"
  >
    <div class="flex flex-col space-y-3">
      <a href="{{route('home')}}" class="text-gray-600 hover:text-orange-500 py-2 border-b">Home</a>
      <a href="{{ route('library.recipe') }}" class="text-gray-600 hover:text-orange-500 py-2 border-b">Library</a>
      <a href="#" class="text-gray-600 hover:text-orange-500 py-2 border-b">Shop</a>
      <a href="{{ route('post.media') }}" class="text-gray-600 hover:text-orange-500 py-2 border-b">Community</a>
      <a href="{{ route('friends') }}" class="text-gray-600 hover:text-orange-500 py-2 border-b">Friends</a>
      <div class="flex flex-col space-y-2 pt-2">
        <a href="{{route('login.auth')}}" class="bg-orange-500 hover:bg-orange-600 text-white text-center py-2 rounded-lg transition">Sign In</a>
        <a href="{{route('login.auth')}}" class="bg-orange-500 hover:bg-orange-600 text-white text-center py-2 rounded-lg transition">Sign Up</a>
      </div>
    </div>
  </div>
</header>
@else
<header class="bg-white shadow-sm" x-data="{ mobileMenu: false }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="py-4 flex justify-between items-center">
          <div class="flex items-center">
              <span class="text-orange-500 text-2xl mr-2"><i class="fas fa-utensils"></i></span>
              <h1 class="text-xl font-bold">CookNShare</h1>
          </div>

          <!-- Desktop Navigation -->
          <nav class="hidden md:flex space-x-8">
            <a href="{{route('home')}}" class="text-gray-600 hover:text-orange-500">Home</a>
            <a href="{{ route('library.recipe') }}" class="text-gray-600 hover:text-orange-500">Biblio</a>
            <a href="{{ route('post.media') }}" class="text-gray-600 hover:text-orange-500">Community</a>
            <a href="{{ route('friends') }}" class="text-gray-600 hover:text-orange-500">Friend</a>
          </nav>

          <!-- User Menu -->
          <div class="flex items-center space-x-4">
              <!-- Messages -->
              <div class="relative">
                  <button class="text-gray-600 hover:text-orange-500 transition-colors">
                      <i class="fas fa-envelope text-xl"></i>
                  </button>
              </div>

              <!-- Profile -->
              <div class="relative" x-data="{ open: false }">
                  <button @click="open = !open" class="flex items-center focus:outline-none">
                      <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-orange-500">
                          <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile" class="w-full h-full object-cover">
                      </div>
                  </button>

                  <!-- Dropdown -->
                  <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-10">
                      <a href="{{ route('profile')}}" class="block px-4 py-2 text-gray-800 hover:bg-orange-100">My Profile</a>
                      <div class="border-t border-gray-200 my-1"></div>
                      <form action="{{ route('logout')}}" method="POST">
                        @csrf
                          <button type="submit" class="block px-4 py-2 text-gray-800 hover:bg-orange-100">Log Out</button>
                      </form>
                  </div>
              </div>

              <!-- Mobile menu button -->
              <button @click="mobileMenu = !mobileMenu" class="md:hidden text-gray-600">
                  <i class="fas fa-bars text-xl"></i>
              </button>
          </div>
      </div>
  </div>

  <div x-show="mobileMenu" class="md:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t">
          <a href="{{route('home')}}" class="block px-3 py-2 text-gray-600 hover:bg-orange-100 rounded-md">Home</a>
          <a href="{{ route('library.recipe') }}" class="block px-3 py-2 text-gray-600 hover:bg-orange-100 rounded-md">Biblio</a>
          <a href="{{ route('post.media') }}" class="block px-3 py-2 text-gray-600 hover:bg-orange-100 rounded-md">Community</a>
          <a href="{{ route('friends') }}" class="block px-3 py-2 text-gray-600 hover:bg-orange-100 rounded-md">Friend</a>
          <form action="{{ route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="block px-4 py-2 text-gray-800 hover:bg-orange-100">Log Out</button>
        </form>
      </div>
  </div>
</header>
@endif