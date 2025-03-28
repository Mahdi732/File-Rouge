<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CookNShare - Discover, Cook, Share</title>
  <script src="https://cdn.tailwindcss.com"></script>
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
  <!-- Header -->
  @if (View::exists('partial.nav'))
  @include('partial.nav')
  @endif
  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <section class="bg-orange-50 rounded-xl p-8 mb-12 flex flex-col md:flex-row items-center">
      <div class="md:w-1/2 mb-6 md:mb-0 md:pr-8">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Discover, Cook, Share</h2>
        <p class="text-gray-600 mb-6">Connect with food lovers, explore new recipes, and share your culinary adventures with the world.</p>
        <div class="flex space-x-4">
          <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg transition-colors pulse-hover">
            Explore Recipes
          </a>
          <a href="#" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg transition-colors">
            Join Community
          </a>
        </div>
      </div>
      <div class="md:w-1/2">
        <img src="{{asset('picture/main.png')}}" alt="Cooking Community" class="w-full rounded-lg ">
      </div>
    </section>
    
    <!-- Featured Recipes -->
    <section class="mb-12">
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">Featured Recipes</h3>
        <a href="#" class="text-orange-500 hover:text-orange-600 transition-colors">View All</a>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Recipe Card 1 -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
          <img src="{{asset('picture/pizza.webp')}}" alt="Recipe" class="w-full h-48 object-cover">
          <div class="p-4">
            <h4 class="font-semibold text-gray-800 mb-2">Spicy Thai Noodles</h4>
            <div class="flex items-center text-sm text-gray-600 mb-2">
              <i class="fas fa-clock mr-2"></i>
              45 mins
              <span class="mx-2">•</span>
              <i class="fas fa-fire mr-2"></i>
              Medium
            </div>
            <div class="flex items-center">
              <img src="{{asset('picture/pizza.webp')}}" alt="Chef" class="w-8 h-8 rounded-full mr-2">
              <span class="text-sm text-gray-700">Sarah Johnson</span>
            </div>
          </div>
        </div>
        
        <!-- Recipe Card 2 -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
          <img src="{{asset('picture/pizza.webp')}}" alt="Recipe" class="w-full h-48 object-cover">
          <div class="p-4">
            <h4 class="font-semibold text-gray-800 mb-2">Classic Beef Burger</h4>
            <div class="flex items-center text-sm text-gray-600 mb-2">
              <i class="fas fa-clock mr-2"></i>
              30 mins
              <span class="mx-2">•</span>
              <i class="fas fa-fire mr-2"></i>
              Easy
            </div>
            <div class="flex items-center">
              <img src="{{asset('picture/pizza.webp')}}" alt="Chef" class="w-8 h-8 rounded-full mr-2">
              <span class="text-sm text-gray-700">Michael Chen</span>
            </div>
          </div>
        </div>
        
        <!-- Recipe Card 3 -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
          <img src="{{asset('picture/pizza.webp')}}" alt="Recipe" class="w-full h-48 object-cover">
          <div class="p-4">
            <h4 class="font-semibold text-gray-800 mb-2">Vegan Buddha Bowl</h4>
            <div class="flex items-center text-sm text-gray-600 mb-2">
              <i class="fas fa-clock mr-2"></i>
              60 mins
              <span class="mx-2">•</span>
              <i class="fas fa-fire mr-2"></i>
              Challenging
            </div>
            <div class="flex items-center">
              <img src="{{asset('picture/pizza.webp')}}" alt="Chef" class="w-8 h-8 rounded-full mr-2">
              <span class="text-sm text-gray-700">Emma Rodriguez</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Community Highlights -->
    <section>
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">Community Highlights</h3>
        <a href="#" class="text-orange-500 hover:text-orange-600 transition-colors">Explore Community</a>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Community Card 1 -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
          <div class="relative">
            <img src="{{asset('picture/pizza.webp')}}" alt="Community Event" class="w-full h-40 object-cover">
            <div class="absolute top-2 right-2 bg-orange-500 text-white px-2 py-1 rounded-full text-xs">
              Upcoming
            </div>
          </div>
          <div class="p-4">
            <h4 class="font-semibold text-gray-800 mb-2">Summer BBQ Meetup</h4>
            <div class="flex items-center text-sm text-gray-600 mb-2">
              <i class="fas fa-calendar mr-2"></i>
              July 15, 2024
            </div>
            <div class="flex items-center">
              <i class="fas fa-map-marker-alt mr-2 text-orange-500"></i>
              <span class="text-sm text-gray-700">Houston, TX</span>
            </div>
          </div>
        </div>
        
        <!-- Community Card 2 -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
          <div class="relative">
            <img src="{{asset('picture/pizza.webp')}}" alt="Community Challenge" class="w-full h-40 object-cover">
            <div class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded-full text-xs">
              Active
            </div>
          </div>
          <div class="p-4">
            <h4 class="font-semibold text-gray-800 mb-2">Vegan Recipe Challenge</h4>
            <div class="flex items-center text-sm text-gray-600 mb-2">
              <i class="fas fa-trophy mr-2"></i>
              Top Prize: $500
            </div>
            <div class="flex items-center">
              <i class="fas fa-users mr-2 text-orange-500"></i>
              <span class="text-sm text-gray-700">125 Participants</span>
            </div>
          </div>
        </div>
        
        <!-- Community Card 3 -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
          <div class="relative">
            <img src="{{asset('picture/pizza.webp')}}" alt="Community Workshop" class="w-full h-40 object-cover">
            <div class="absolute top-2 right-2 bg-blue-500 text-white px-2 py-1 rounded-full text-xs">
              Ongoing
            </div>
          </div>
          <div class="p-4">
            <h4 class="font-semibold text-gray-800 mb-2">Pastry Masterclass</h4>
            <div class="flex items-center text-sm text-gray-600 mb-2">
              <i class="fas fa-chalkboard-teacher mr-2"></i>
              Online Workshop
            </div>
            <div class="flex items-center">
              <i class="fas fa-user-tie mr-2 text-orange-500"></i>
              <span class="text-sm text-gray-700">Chef Sarah Johnson</span>
            </div>
          </div>
        </div>
        
        <!-- Community Card 4 -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
          <div class="relative">
            <img src="{{asset('picture/pizza.webp')}}" alt="Community Group" class="w-full h-40 object-cover">
            <div class="absolute top-2 right-2 bg-purple-500 text-white px-2 py-1 rounded-full text-xs">
              Growing
            </div>
          </div>
          <div class="p-4">
            <h4 class="font-semibold text-gray-800 mb-2">Global Cuisine Group</h4>
            <div class="flex items-center text-sm text-gray-600 mb-2">
              <i class="fas fa-globe mr-2"></i>
              International Cooking
            </div>
            <div class="flex items-center">
              <i class="fas fa-users mr-2 text-orange-500"></i>
              <span class="text-sm text-gray-700">3,500 Members</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  
  <!-- Footer -->
  @if (View::exists('partial.fotter'))
  @include('partial.fotter')
  @endif
</body>
</html>