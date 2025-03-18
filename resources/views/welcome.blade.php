<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookNShare - Discover & Share Delicious Recipes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-section {
            background-color: #FFF9F0;
        }
        .feature-card {
            background-color: #FFF9F0;
        }
        .container-section {
            background-color: #E6F7F2;
        }
        .orange-button {
            background-color: #FF6B35;
        }
        .outline-button {
            border: 1px solid #FF6B35;
            color: #FF6B35;
        }
        .recipe-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .veg-tag {
            background-color: #4CAF50;
        }
        .spicy-tag {
            background-color: #FF5252;
        }
        .protein-tag {
            background-color: #FFC107;
        }
    </style>
</head>
<body class="bg-white">
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
            <a href="#" class="text-gray-600 hover:text-orange-500">Home</a>
            <a href="#" class="text-gray-600 hover:text-orange-500">Recipes</a>
            <a href="#" class="text-gray-600 hover:text-orange-500">Shop</a>
            <a href="#" class="text-gray-600 hover:text-orange-500">Community</a>
        </nav>
        <div class="flex space-x-2">
            <button class="orange-button text-white px-4 py-1 rounded-lg"><a href="/login">Log In</a></button>
            <button class="orange-button text-white px-4 py-1 rounded-lg">Sign Up</button>
        </div>
    </div>
</header>
@else
<header class="py-4 px-8 flex justify-between items-center">
    <div class="flex items-center">
        <span class="text-orange-500 text-2xl mr-1"><i class="fas fa-utensils"></i></span>
        <h1 class="text-xl font-bold">CookNShare</h1>
    </div>
    <div class="flex gap-4">
        <nav class="hidden md:flex space-x-6">
            <a href="#" class="text-gray-600 hover:text-orange-500">Home</a>
            <a href="#" class="text-gray-600 hover:text-orange-500">Recipes</a>
            <a href="#" class="text-gray-600 hover:text-orange-500">Shop</a>
            <a href="#" class="text-gray-600 hover:text-orange-500">Community</a>
        </nav>
        <div class="flex items-center">
            <div class="relative group">
                <button class="flex items-center focus:outline-none">
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-orange-500 hover:border-orange-600 transition-all">
                        <img src="/api/placeholder/200/200" alt="Profile" class="w-full h-full object-cover" />
                    </div>
                </button>
                <!-- Dropdown Menu -->
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-20 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-orange-100">My Profile</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-orange-100">My Recipes</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-orange-100">Saved Items</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-orange-100">Settings</a>
                    <div class="border-t border-gray-200 my-1"></div>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-orange-100">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</header>
@endif
<!-- Hero Section -->
<section class="bg-[#FEFCE8] py-16 px-8">
    <div class="container mx-auto flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 mb-8 md:mb-0">
            <h2 class="text-3xl font-bold mb-2">Discover & Share<br><span class="text-orange-500">Delicious Recipes</span></h2>
            <p class="mb-6 text-gray-700">Join our community of food lovers. Explore recipes, culinary partners, and get inspired to cook delicious meals in your kitchen.</p>
            <div class="flex space-x-4">
                <button class="orange-button text-white px-6 py-2 rounded">Get Started</button>
                <button class="outline-button bg-transparent px-6 py-2 rounded">Browse Recipes</button>
            </div>
        </div>
        <div class="md:w-1/2">
            <img src="{{ asset('picture/Daco_5897880.png') }}" alt="People cooking together" class="">
            <div class="flex items-center justify-center mt-2 bg-white rounded-lg w-[9.5rem] h-[3rem]">
                <span class="text-orange-500 p-1 rounded-full mr-2 font-bold"><i class="fas fa-user"></i></span>
                <span class="text-sm text-gray-600 font-bold">5k+ Active Users</span>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Section -->
<section class="py-12 px-8 hero-section">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold text-center mb-2">Why Choose CookNShare?</h2>
        <p class="text-center text-gray-600 mb-10">Everything you need to explore the world of cooking</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-6 rounded-lg">
                <div class="bg-orange-100 p-3 rounded-lg inline-block mb-4">
                    <span class="text-orange-500 text-xl"><i class="fas fa-book-open"></i></span>
                </div>
                <h3 class="font-bold mb-2">Customize Recipes</h3>
                <p class="text-gray-600">Add your personal touch to recipes to match your dietary needs.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-6 rounded-lg">
                <div class="bg-orange-100 p-3 rounded-lg inline-block mb-4">
                    <span class="text-orange-500 text-xl"><i class="fas fa-shopping-basket"></i></span>
                </div>
                <h3 class="font-bold mb-2">Shop Ingredients</h3>
                <p class="text-gray-600">Get fresh ingredients delivered right to your door.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-6 rounded-lg">
                <div class="bg-orange-100 p-3 rounded-lg inline-block mb-4">
                    <span class="text-orange-500 text-xl"><i class="fas fa-video"></i></span>
                </div>
                <h3 class="font-bold mb-2">Video Tutorials</h3>
                <p class="text-gray-600">Learn with step-by-step video instructions.</p>
            </div>
        </div>
    </div>
</section>

<!-- Popular Recipes Section -->
<section class="py-12 px-8 hero-section">
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold">Popular Recipes</h2>
            <a href="#" class="text-orange-500 hover:underline">View All</a>
        </div>

        <div class="max-w-6xl mx-auto relative flex justify-center">

            <!-- Recipe Cards Container -->
            <div class="items-center md:flex md:flex-row flex flex-col space-x-6">
                <!-- Card 1 -->
                <div class="w-72 hero-section rounded-lg overflow-hidden ">
                    <!-- Image -->
                    <div class="h-[24rem] overflow-hidden">
                        <img src="{{ asset('picture/loli.png')}}" alt="Pumpkin Oats" class="w-full h-full object-cover">
                    </div>

                    <!-- Icons -->
                    <div class="flex justify-center space-x-4 py-1">
                        <img class="w-8 h-8" src="{{asset ('picture/Group 4625.png')}}" alt="">
                        <img class="w-8 h-8" src="{{asset ('picture/Group 4625.png')}}" alt="">
                        <img class="w-8 h-8" src="{{asset ('picture/Group 4625.png')}}" alt="">
                    </div>
                    <div class="flex justify-center gap-10">
                        <!-- Time -->
                        <div class="text-xs text-black font-semibold">45 mins</div>

                        <!-- Difficulty -->
                        <div class="text-xs text-black mb-2 font-semibold">Beginner</div>
                    </div>


                    <!-- Title -->
                    <h3 class="text-gray-800 font-bold text-center py-6 px-4 pb-4">Pumpkin Oats with Toasted Almonds</h3>
                </div>

                <!-- Card 2 -->
                <div class="w-72 hero-section rounded-lg overflow-hidden ">
                    <!-- Image -->
                    <div class="h-[24rem] overflow-hidden">
                        <img src="{{ asset('picture/loli.png')}}" alt="Pumpkin Oats" class="w-full h-full object-cover">
                    </div>

                    <!-- Icons -->
                    <div class="flex justify-center space-x-4 py-1">
                        <img class="w-8 h-8" src="{{asset ('picture/Group 4625.png')}}" alt="">
                        <img class="w-8 h-8" src="{{asset ('picture/Group 4625.png')}}" alt="">
                        <img class="w-8 h-8" src="{{asset ('picture/Group 4625.png')}}" alt="">
                    </div>
                    <div class="flex justify-center gap-10">
                        <!-- Time -->
                        <div class="text-xs text-black font-semibold">45 mins</div>

                        <!-- Difficulty -->
                        <div class="text-xs text-black mb-2 font-semibold">Beginner</div>
                    </div>


                    <!-- Title -->
                    <h3 class="text-gray-800 font-bold text-center py-6 px-4 pb-4">Pumpkin Oats with Toasted Almonds</h3>
                </div>

                <!-- Card 3 -->
                <div class="w-72 hero-section rounded-lg overflow-hidden ">
                    <!-- Image -->
                    <div class="h-[24rem] overflow-hidden">
                        <img src="{{ asset('picture/loli.png')}}" alt="Pumpkin Oats" class="w-full h-full object-cover">
                    </div>

                    <!-- Icons -->
                    <div class="flex justify-center space-x-4 py-1">
                        <img class="w-8 h-8" src="{{asset ('picture/Group 4625.png')}}" alt="">
                        <img class="w-8 h-8" src="{{asset ('picture/Group 4625.png')}}" alt="">
                        <img class="w-8 h-8" src="{{asset ('picture/Group 4625.png')}}" alt="">
                    </div>
                    <div class="flex justify-center gap-10">
                        <!-- Time -->
                        <div class="text-xs text-black font-semibold">45 mins</div>

                        <!-- Difficulty -->
                        <div class="text-xs text-black mb-2 font-semibold">Beginner</div>
                    </div>


                    <!-- Title -->
                    <h3 class="text-gray-800 font-bold text-center py-6 px-4 pb-4">Pumpkin Oats with Toasted Almonds</h3>
                </div>
            </div>
        </div>
</section>

<!-- Container Section -->
<section class="bg-green-400">
    <div class="bg-green-700">
        <div class="grid grid-cols-4 md:grid-cols-7">
            <img src="{{asset ('picture/mm.png')}}" alt="FAQ" class="hidden md:flex w-full h-full object-cover">
            <img src="{{asset ('picture/mm.png')}}" alt="FAQ" class="hidden md:flex w-full h-full object-cover">
            <img src="{{asset ('picture/mm.png')}}" alt="FAQ" class="hidden md:flex w-full h-full object-cover">
            <img src="{{asset ('picture/mm.png')}}" alt="FAQ" class="w-full h-full object-cover">
            <img src="{{asset ('picture/mm.png')}}" alt="FAQ" class="w-full h-full object-cover">
            <img src="{{asset ('picture/mm.png')}}" alt="FAQ" class="w-full h-full object-cover">
            <img src="{{asset ('picture/mm.png')}}" alt="FAQ" class="w-full h-full object-cover">
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-12 px-8 bg-[#389A61] text-center">
    <div class="container mx-auto">
        <h2 class="text-2xl text-white font-bold mb-2">Ready to Start Cooking?</h2>
        <p class="text-white mb-6">Join our community today and discover amazing recipes!</p>
        <button class="bg-white text-orange-500 px-8 py-3 rounded-lg">Get Started Now</button>
    </div>
</section>

<footer>

</footer>
</body>
</html>
