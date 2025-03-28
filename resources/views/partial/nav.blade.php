<section class="py-2 bg-gray-200 bg-opacity-30 px-8 flex justify-between">
  <p class="text-gray-100">.</p>
  <p class="text-gray-400">ey449751@gmail.com</p>
</section>

<!-- Header -->
@if(!Auth::check())
<header class="py-4 px-8 flex justify-between items-center">
  <div class="flex items-center">
      <span class="text-orange-500 text-2xl mr-1"><i class="fas fa-utensils"></i></span>
      <h1 class="text-xl font-bold">CookNShare</h1>
  </div>
  <div class="flex gap-4">
      <nav class="hidden md:flex space-x-6">
          <a href="/" class="text-gray-600 hover:text-orange-500">Home</a>
          <a href="/recipe" class="text-gray-600 hover:text-orange-500">Recipes</a>
          <a href="/Market" class="text-gray-600 hover:text-orange-500">Shop</a>
          <a href="Media" class="text-gray-600 hover:text-orange-500">Community</a>
          <a href="/friend" class="text-gray-600 hover:text-orange-500">Friend</a>
      </nav>
      <div class="flex space-x-2">
        <button class="hidden md:block bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition">
            <a href="/login">Sign In</a>
        </button>
        <button class="hidden md:block bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition">
            <a href="/login">Sign Up</a>
        </button>
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
              <a href="/home" class="text-gray-600 hover:text-orange-500 transition-colors">Home</a>
              <a href="/recipe" class="text-gray-600 hover:text-orange-500 transition-colors">Recipes</a>
              <a href="/Market" class="text-gray-600 hover:text-orange-500 transition-colors">Shop</a>
              <a href="/Media" class="text-gray-600 hover:text-orange-500 transition-colors">Community</a>
              <a href="/friend" class="text-gray-600 hover:text-orange-500">Friend</a>
          </nav>

          <!-- User Menu -->
          <div class="flex items-center space-x-4">
              <!-- Notifications -->
              <div class="relative">
                  <button class="text-gray-600 hover:text-orange-500 transition-colors">
                      <i class="fas fa-bell text-xl"></i>
                      <span class="absolute -top-1 -right-1 bg-orange-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs">3</span>
                  </button>
              </div>

              <!-- Messages -->
              <div class="relative">
                  <button class="text-gray-600 hover:text-orange-500 transition-colors">
                      <i class="fas fa-envelope text-xl"></i>
                      <span class="absolute -top-1 -right-1 bg-orange-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs">5</span>
                  </button>
              </div>

              <!-- Profile -->
              <div class="relative" x-data="{ open: false }">
                  <button @click="open = !open" class="flex items-center focus:outline-none">
                      <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-orange-500">
                          <img src="/api/placeholder/200/200" alt="Profile" class="w-full h-full object-cover">
                      </div>
                  </button>

                  <!-- Dropdown -->
                  <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-10">
                      <a href="/profile" class="block px-4 py-2 text-gray-800 hover:bg-orange-100">My Profile</a>
                      <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-orange-100">My Recipes</a>
                      <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-orange-100">Settings</a>
                      <div class="border-t border-gray-200 my-1"></div>
                      <form action="{{ route('logOut')}}" method="POST">
                          <button type="submit"><a href="/login" class="block px-4 py-2 text-gray-800 hover:bg-orange-100">Log Out</a></button>
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

  <!-- Mobile menu -->
  <div x-show="mobileMenu" class="md:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t">
          <a href="/home" class="block px-3 py-2 text-gray-600 hover:bg-orange-100 rounded-md">Home</a>
          <a href="/recipe" class="block px-3 py-2 text-gray-600 hover:bg-orange-100 rounded-md">Recipes</a>
          <a href="/Market" class="block px-3 py-2 text-gray-600 hover:bg-orange-100 rounded-md">Shop</a>
          <a href="/Media" class="block px-3 py-2 text-gray-600 hover:bg-orange-100 rounded-md">Community</a>
          <a href="/friend" class="block px-3 py-2 text-gray-600 hover:bg-orange-100 rounded-md">Friend</a>
      </div>
  </div>
</header>
@endif